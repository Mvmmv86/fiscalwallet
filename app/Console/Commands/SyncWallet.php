<?php

namespace App\Console\Commands;

use App\Models\Wallet;
use App\Services\WalletSyncService;
use Illuminate\Console\Command;

class SyncWallet extends Command
{
    protected $signature = 'wallet:sync {id? : ID da carteira (ou "all" para todas)}';

    protected $description = 'Sincroniza uma carteira ou todas com a exchange';

    public function handle(WalletSyncService $syncService): int
    {
        $id = $this->argument('id');

        if ($id === 'all' || $id === null) {
            $wallets = Wallet::whereNotNull('api_key')->get();
            $this->info("Sincronizando {$wallets->count()} carteiras...");

            foreach ($wallets as $wallet) {
                $this->syncWallet($wallet, $syncService);
            }
        } else {
            $wallet = Wallet::find($id);

            if (!$wallet) {
                $this->error("Carteira #{$id} não encontrada.");
                return 1;
            }

            $this->syncWallet($wallet, $syncService);
        }

        return 0;
    }

    protected function syncWallet(Wallet $wallet, WalletSyncService $syncService): void
    {
        $this->info("Sincronizando carteira #{$wallet->id} ({$wallet->name})...");

        $result = $syncService->syncWallet($wallet, true);

        if ($result['success']) {
            $this->info("  -> Sucesso! {$result['imported']} operações importadas.");
        } else {
            $this->error("  -> Erro: {$result['error']}");
        }
    }
}
