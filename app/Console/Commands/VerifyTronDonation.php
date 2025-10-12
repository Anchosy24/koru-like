<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Donation;
use App\Http\Controllers\TronController;
use Illuminate\Support\Facades\Http;

class VerifyTronDonations extends Command
{
    protected $signature = 'donations:verify-tron';
    protected $description = 'Verify pending TRON USDT donations and auto-confirm them';
    private $tronGridUrl;
    private $walletAddress;
    private $usdtContract;

    public function __construct()
    {
        $this->tronGridUrl = env('TRON_GRID_URL');
        $this->walletAddress = env('TRON_WALLET_ADDRESS');
        $this->usdtContract = env('USDT_CONTRACT');
    }

    public function handle()
    {
        $pendingDonations = Donation::where('status', 'pending')->get();

        foreach ($pendingDonations as $donation) {
            try {
                $tronController = new TronController();
                $this->verifyDonationOnChain($donation);
            } catch (\Exception $e) {
                $this->error("Error verifying donation {$donation->id}: {$e->getMessage()}");
            }
        }

        $this->info('Donation verification complete');
    }

    private function verifyDonationOnChain($donation)
    {
        $response = Http::get("{$tronGridUrl}/v1/accounts/{$walletAddress}/transactions/trc20");

        if ($response->successful() && isset($response['data'])) {
            foreach ($response['data'] as $tx) {
                if ($this->matchesDonation($tx, $donation)) {
                    $donation->update([
                        'transaction_hash' => $tx['transaction_id'],
                        'status' => 'completed',
                        'confirmed_at' => now(),
                    ]);

                    $this->info("Donation {$donation->id} confirmed!");
                }
            }
        }
    }

    private function matchesDonation($transaction, $donation): bool
    {
        // Match transaction amount with donation amount (USDT has 6 decimals)
        $txAmount = $transaction['value'] ? $transaction['value'] / 1000000 : 0;
        
        return abs($txAmount - (float)$donation->amount) < 0.01;
    }
}