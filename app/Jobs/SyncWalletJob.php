<?php

namespace App\Jobs;

use App\Events\WalletSyncCompleted;
use App\Events\WalletSyncFailed;
use App\Models\Wallet;
use App\Services\WalletSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncWalletJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     */
    public int $timeout = 600; // 10 minutes

    /**
     * The number of seconds to wait before retrying the job.
     */
    public int $backoff = 60;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Wallet $wallet,
        public bool $fullSync = false
    ) {}

    /**
     * Execute the job.
     */
    public function handle(WalletSyncService $syncService): void
    {
        Log::info('SyncWalletJob started', [
            'wallet_id' => $this->wallet->id,
            'wallet_name' => $this->wallet->name,
            'full_sync' => $this->fullSync,
        ]);

        try {
            $result = $syncService->syncWallet($this->wallet, $this->fullSync);

            if ($result['success']) {
                Log::info('SyncWalletJob completed successfully', [
                    'wallet_id' => $this->wallet->id,
                    'imported' => $result['imported'] ?? 0,
                ]);

                event(new WalletSyncCompleted(
                    $this->wallet,
                    $result['imported'] ?? 0
                ));
            } else {
                Log::warning('SyncWalletJob completed with failure', [
                    'wallet_id' => $this->wallet->id,
                    'error' => $result['error'] ?? 'Unknown error',
                ]);

                event(new WalletSyncFailed(
                    $this->wallet,
                    $result['error'] ?? 'Unknown error'
                ));
            }

        } catch (\Exception $e) {
            Log::error('SyncWalletJob exception', [
                'wallet_id' => $this->wallet->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            $this->wallet->update([
                'status' => 'error',
                'sync_error' => $e->getMessage(),
            ]);

            event(new WalletSyncFailed($this->wallet, $e->getMessage()));

            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('SyncWalletJob failed permanently', [
            'wallet_id' => $this->wallet->id,
            'error' => $exception->getMessage(),
        ]);

        $this->wallet->update([
            'status' => 'error',
            'sync_error' => 'Sincronização falhou após várias tentativas: ' . $exception->getMessage(),
        ]);

        event(new WalletSyncFailed($this->wallet, $exception->getMessage()));
    }
}
