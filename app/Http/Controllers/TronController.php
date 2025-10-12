<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use App\Models\Donation;

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
            $response = Http::get("{$this->tronGridUrl}/#/transaction/{$txHash}");

            if ($response->successful() && isset($response['transaction'])) {
                $transaction = $response['transaction'];
                $isConfirmed = $transaction['ret'][0]['contractRet'] === 'SUCCESS';
                $blockNumber = $transaction['blockNumber'] ?? null;

                return response()->json([
                    'success' => true,
                    'confirmed' => $isConfirmed,
                    'block_number' => $blockNumber,
                    'timestamp' => $transaction['block_timestamp'] ?? null,
                ]);
            }

            return response()->json(['success' => false, 'message' => 'Transaction not found']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function verifyAndConfirmDonation($donationId, $txHash): JsonResponse
    {
        try {
            $donation = Donation::findOrFail($donationId);

            if ($donation->status !== 'pending') {
                return response()->json(['success' => false, 'message' => 'Donation already processed']);
            }

            // Verify transaction on TRON
            $transactionResponse = Http::get("{$this->tronGridUrl}/#/transaction/{$txHash}");

            if (!$transactionResponse->successful()) {
                return response()->json(['success' => false, 'message' => 'Invalid transaction']);
            }

            $transaction = $transactionResponse['transaction'];
            
            // Validate transaction details
            if (!$this->validateTronTransaction($transaction, $donation->amount)) {
                return response()->json(['success' => false, 'message' => 'Transaction details do not match']);
            }

            // Update donation record
            $donation->update([
                'transaction_hash' => $txHash,
                'wallet_address' => $this->walletAddress,
                'status' => 'completed',
                'confirmed_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Donation confirmed successfully',
                'donation' => $donation
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function validateTronTransaction($transaction, $expectedAmount): bool
    {
        try {
            if (!isset($transaction['transaction']['contract'])) {
                return false;
            }

            $contract = $transaction['transaction']['contract'][0];
            
            if ($contract['type'] !== 'TriggerSmartContract') {
                return false;
            }

            $parameter = $contract['parameter']['value'];

            // Check if it's to our wallet
            $toAddress = $parameter['to_address'] ?? null;
            if ($toAddress && $this->hexToTron($toAddress) !== $this->walletAddress) {
                return false;
            }

            // Verify amount (USDT has 6 decimals)
            $amount = isset($parameter['amount']) ? $parameter['amount'] / 1000000 : 0;
            
            return abs($amount - (float)$expectedAmount) < 0.01;

        } catch (\Exception $e) {
            return false;
        }
    }

    private function hexToTron($hex): string
    {
        // Convert hex address to TRON address
        $decoded = hex2bin(str_replace('0x', '', $hex));
        return \TronOne\TronOne::publicKeyToAddress($decoded);
    }

    public function getPendingTransactions(): JsonResponse
    {
        try {
            $response = Http::get("{$this->tronGridUrl}/v1/accounts/{$this->walletAddress}/transactions/trc20");

            if ($response->successful()) {
                return response()->json(['success' => true, 'data' => $response['data'] ?? []]);
            }

            return response()->json(['success' => false, 'message' => 'Failed to fetch transactions']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}