<?php

namespace App\Listeners;

use App\Events\WalletSyncFailed;
use App\Models\SyncLog;
use Illuminate\Support\Facades\Log;

class LogWalletSyncFailure
{
    /**
     * Handle the event.
     */
    public function handle(WalletSyncFailed $event): void
    {
        Log::error('Wallet sync failed', [
            'wallet_id' => $event->wallet->id,
            'wallet_name' => $event->wallet->name,
            'user_id' => $event->wallet->user_id,
            'error' => $event->errorMessage,
        ]);

        // Registrar no sync_logs se a tabela existir
        if (class_exists(SyncLog::class)) {
            try {
                SyncLog::create([
                    'wallet_id' => $event->wallet->id,
                    'status' => 'failed',
                    'message' => $event->errorMessage,
                    'started_at' => now(),
                    'finished_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Ignora se a tabela não existir
            }
        }
    }
}
