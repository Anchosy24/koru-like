<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Donation;
use App\Mail\ConfirmMail;

class TronController extends Controller
{
    private $tronGridUrl;
    private $walletAddress;
    private $usdtContract;

    public function __construct()
    {
        $this->tronGridUrl = env('TRON_GRID_URL');
        $this->walletAddress = env('TRON_WALLET_ADDRESS');
        $this->usdtContract = env('USDT_CONTRACT');
    }

    public function checkTransaction($txHash): JsonResponse
    {
        try {
            $response = Http::timeout(30)->get("{$this->tronGridUrl}/wallet/gettransactionbyid", [
                'value' => $txHash
            ]);

            if ($response->successful() && $response->json()) {
                $transaction = $response->json();
                
                $isConfirmed = isset($transaction['ret'][0]['contractRet']) 
                    && $transaction['ret'][0]['contractRet'] === 'SUCCESS';
                
                return response()->json([
                    'success' => true,
                    'confirmed' => $isConfirmed,
                    'block_number' => $transaction['blockNumber'] ?? null,
                    'timestamp' => $transaction['raw_data']['timestamp'] ?? null,
                    'transaction' => $transaction
                ]);
            }

            return response()->json([
                'success' => false, 
                'message' => 'Transaction not found'
            ]);
        } catch (\Exception $e) {
            Log::error('TRON Transaction Check Error: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => $e->getMessage()
            ]);
        }
    }

    public function verifyAndConfirmDonation($donationId, $txHash): JsonResponse
    {
        try {
            $donation = Donation::findOrFail($donationId);

            if ($donation->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Donation already processed'
                ]);
            }

            // Fetch TRON transaction
            $response = Http::timeout(30)->get("{$this->tronGridUrl}/wallet/gettransactionbyid", [
                'value' => $txHash
            ]);

            if (!$response->successful() || !$response->json()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid transaction or transaction not found'
                ]);
            }

            $transaction = $response->json();
            Log::info('TRON Transaction Data:', $transaction);

            // Validate transaction
            $validationResult = $this->validateTronTransaction($transaction, $donation->amount);
            if (!$validationResult['valid']) {
                return response()->json([
                    'success' => false,
                    'message' => $validationResult['error']
                ]);
            }

            // Update donation
            $donation->update([
                'transaction_hash' => $txHash,
                'wallet_address' => $this->walletAddress,
                'status' => 'completed',
                'confirmed_at' => now(),
            ]);

            // Try to send confirmation email (non-blocking for success)
            try {
                Mail::to($donation->email)->send(new ConfirmMail($donation));
                Log::info('Confirmation email sent to: ' . $donation->email);
            } catch (\Throwable $e) {
                Log::warning('Email send failed: ' . $e->getMessage());
            }

            // ✅ Only ONE success response — no duplication alerts
            return response()->json([
                'success' => true,
                'message' => 'Donation confirmed successfully.',
                'donation' => $donation->fresh(),
            ]);

        } catch (\Throwable $e) {
            Log::error('TRON Verification Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Verification error: ' . $e->getMessage()
            ]);
        }
    }

    private function validateTronTransaction($transaction, $expectedAmount): array
    {
        try {
            // Check if transaction was successful
            if (!isset($transaction['ret'][0]['contractRet']) 
                || $transaction['ret'][0]['contractRet'] !== 'SUCCESS') {
                return [
                    'valid' => false, 
                    'error' => 'Transaction failed on blockchain'
                ];
            }

            // Check if transaction has contracts
            if (!isset($transaction['raw_data']['contract'][0])) {
                return [
                    'valid' => false, 
                    'error' => 'Invalid transaction structure'
                ];
            }

            $contract = $transaction['raw_data']['contract'][0];
            
            // Check if it's a TriggerSmartContract (TRC-20 transfer)
            if ($contract['type'] !== 'TriggerSmartContract') {
                return [
                    'valid' => false, 
                    'error' => 'Not a TRC-20 token transfer'
                ];
            }

            $parameter = $contract['parameter']['value'];

            // Get contract address and convert to Base58
            $contractAddressHex = $parameter['contract_address'];
            $contractAddress = $this->convertHexToBase58($contractAddressHex);
            
            Log::info("Contract Address: {$contractAddress}, Expected: {$this->usdtContract}");

            // Verify it's calling the USDT contract
            if (strtolower($contractAddress) !== strtolower($this->usdtContract)) {
                return [
                    'valid' => false, 
                    'error' => 'Not a USDT transfer. Contract: ' . $contractAddress
                ];
            }

            // Decode the transfer data
            $data = $parameter['data'];
            
            // First 8 characters are the method signature (transfer: a9059cbb)
            if (substr($data, 0, 8) !== 'a9059cbb') {
                return [
                    'valid' => false, 
                    'error' => 'Not a transfer transaction'
                ];
            }

            // Next 64 characters are the recipient address (padded)
            $toAddressHex = substr($data, 8, 64);
            $toAddressHexClean = '41' . substr($toAddressHex, 24); // Remove padding, add TRON prefix
            $toAddress = $this->convertHexToBase58($toAddressHexClean);
            
            Log::info("To Address: {$toAddress}, Expected: {$this->walletAddress}");
            
            if (strtolower($toAddress) !== strtolower($this->walletAddress)) {
                return [
                    'valid' => false, 
                    'error' => 'Transaction not sent to our wallet. Sent to: ' . $toAddress
                ];
            }

            // Next 64 characters are the amount (in smallest unit)
            $amountHex = substr($data, 72, 64);
            $amountInSmallestUnit = hexdec($amountHex);
            
            // USDT has 6 decimals
            $actualAmount = $amountInSmallestUnit / 1000000;
            
            Log::info("Amount validation - Expected: {$expectedAmount} USDT, Actual: {$actualAmount} USDT");

            // Allow small difference due to floating point
            if (abs($actualAmount - (float)$expectedAmount) > 0.01) {
                return [
                    'valid' => false, 
                    'error' => "Amount mismatch. Expected: {$expectedAmount} USDT, Got: {$actualAmount} USDT"
                ];
            }

            return ['valid' => true];

        } catch (\Exception $e) {
            Log::error('Transaction Validation Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return [
                'valid' => false, 
                'error' => 'Validation error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Convert TRON hex address to Base58 format
     */
    private function convertHexToBase58($hexAddress): string
    {
        // Remove 0x prefix if present
        $hexAddress = str_replace('0x', '', $hexAddress);
        
        // Ensure address starts with 41 (TRON mainnet/testnet prefix)
        if (substr($hexAddress, 0, 2) !== '41') {
            $hexAddress = '41' . $hexAddress;
        }
        
        try {
            // Convert hex string to binary
            $addressBytes = hex2bin($hexAddress);
            
            // Calculate checksum using double SHA256
            $hash1 = hash('sha256', $addressBytes, true);
            $hash2 = hash('sha256', $hash1, true);
            $checksum = substr($hash2, 0, 4);
            
            // Combine address bytes with checksum
            $addressWithChecksum = $addressBytes . $checksum;
            
            // Encode to Base58
            return $this->encodeBase58($addressWithChecksum);
            
        } catch (\Exception $e) {
            Log::error('Address conversion error: ' . $e->getMessage());
            return '';
        }
    }

    /**
     * Encode binary data to Base58 format using BCMath (works without GMP extension)
     */
    private function encodeBase58($data): string
    {
        $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        
        // Convert binary to decimal string using bcmath
        $num = '0';
        for ($i = 0; $i < strlen($data); $i++) {
            $num = bcadd(bcmul($num, '256'), ord($data[$i]));
        }
        
        // Convert to base58
        $encoded = '';
        while (bccomp($num, '0') > 0) {
            $remainder = bcmod($num, '58');
            $num = bcdiv($num, '58', 0);
            $encoded = $alphabet[(int)$remainder] . $encoded;
        }
        
        // Add leading '1' characters for each leading null byte
        for ($i = 0; $i < strlen($data) && $data[$i] === "\0"; $i++) {
            $encoded = '1' . $encoded;
        }
        
        return $encoded;
    }

    public function getPendingTransactions(): JsonResponse
    {
        try {
            $response = Http::timeout(30)->get("{$this->tronGridUrl}/v1/accounts/{$this->walletAddress}/transactions/trc20", [
                'limit' => 200,
                'contract_address' => $this->usdtContract
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true, 
                    'data' => $response->json()['data'] ?? []
                ]);
            }

            return response()->json([
                'success' => false, 
                'message' => 'Failed to fetch transactions'
            ]);
        } catch (\Exception $e) {
            Log::error('Get Transactions Error: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => $e->getMessage()
            ]);
        }
    }
}