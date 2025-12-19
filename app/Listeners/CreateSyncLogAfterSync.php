<?php

namespace App\Listeners;

use App\Events\WalletSyncCompleted;
use App\Models\SyncLog;
use Illuminate\Support\Facades\Log;

class CreateSyncLogAfterSync
{
    /**
     * Handle the event.
     */
    public function handle(WalletSyncCompleted $event): void
    {
        Log::info('Wallet sync completed successfully', [
            'wallet_id' => $event->wallet->id,
            'wallet_name' => $event->wallet->name,
            'imported_count' => $event->importedCount,
        ]);

        // Registrar no sync_logs se a tabela existir
        if (class_exists(SyncLog::class)) {
            try {
                SyncLog::create([
                    'wallet_id' => $event->wallet->id,
                    'status' => 'success',
                    'message' => "Sincronização concluída. {$event->importedCount} operações importadas.",
                    'operations_imported' => $event->importedCount,
                    'started_at' => now(),
                    'finished_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Ignora se a tabela não existir
            }
        }
    }
}
