<?php

use App\Jobs\SyncWalletJob;
use App\Jobs\UpdateFiscalLawsJob;
use App\Models\Wallet;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

/*
|--------------------------------------------------------------------------
| Scheduled Jobs
|--------------------------------------------------------------------------
|
| Agendamento de tarefas automáticas do sistema.
| Para funcionar, adicione ao crontab:
| * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
|
*/

// Atualização de leis fiscais - 2x ao dia (6h e 14h - horário de Brasília)
Schedule::job(new UpdateFiscalLawsJob())
    ->twiceDaily(6, 14)
    ->timezone('America/Sao_Paulo')
    ->withoutOverlapping()
    ->onOneServer()
    ->name('update-fiscal-laws')
    ->description('Busca atualizações de leis fiscais de criptoativos');

// Sincronização automática de carteiras - a cada 4 horas
Schedule::call(function () {
    $wallets = Wallet::where('status', 'active')
        ->whereNotNull('api_key')
        ->whereNotNull('api_secret')
        ->get();

    $count = 0;
    foreach ($wallets as $wallet) {
        SyncWalletJob::dispatch($wallet);
        $count++;
    }

    Log::info('Schedule: Sincronização automática de carteiras disparada', [
        'wallets_count' => $count,
    ]);
})
    ->everyFourHours()
    ->timezone('America/Sao_Paulo')
    ->name('sync-all-wallets')
    ->description('Sincroniza todas as carteiras ativas a cada 4 horas')
    ->withoutOverlapping();

// Comando manual para forçar atualização de leis
Artisan::command('fiscal:update-laws', function () {
    $this->info('Disparando job de atualização de leis fiscais...');
    UpdateFiscalLawsJob::dispatch();
    $this->info('Job adicionado à fila. Verifique os logs para acompanhar.');
})->purpose('Força a execução do job de atualização de leis fiscais');

// Comando manual para sincronizar todas as carteiras
Artisan::command('wallet:sync-all', function () {
    $wallets = Wallet::where('status', '!=', 'syncing')
        ->whereNotNull('api_key')
        ->whereNotNull('api_secret')
        ->get();

    if ($wallets->isEmpty()) {
        $this->warn('Nenhuma carteira encontrada para sincronizar.');
        return;
    }

    $this->info("Disparando sincronização para {$wallets->count()} carteira(s)...");

    foreach ($wallets as $wallet) {
        SyncWalletJob::dispatch($wallet);
        $this->line(" - {$wallet->name} (ID: {$wallet->id})");
    }

    $this->info('Jobs adicionados à fila. Verifique os logs para acompanhar.');
})->purpose('Força a sincronização de todas as carteiras');

// Comando manual para sincronizar uma carteira específica
Artisan::command('wallet:sync {wallet_id}', function (int $wallet_id) {
    $wallet = Wallet::find($wallet_id);

    if (!$wallet) {
        $this->error("Carteira ID {$wallet_id} não encontrada.");
        return;
    }

    if (!$wallet->api_key || !$wallet->api_secret) {
        $this->error("Carteira {$wallet->name} não tem credenciais de API configuradas.");
        return;
    }

    $this->info("Disparando sincronização para: {$wallet->name}");
    SyncWalletJob::dispatch($wallet);
    $this->info('Job adicionado à fila. Verifique os logs para acompanhar.');
})->purpose('Força a sincronização de uma carteira específica');
