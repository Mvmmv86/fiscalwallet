<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TwoFactorAuthController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

// Página inicial redireciona para login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rotas protegidas por autenticação
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Carteiras
    Route::get('/carteiras', [WalletController::class, 'index'])->name('carteiras');
    Route::post('/carteiras', [WalletController::class, 'store'])->name('carteiras.store');
    Route::get('/carteiras/{wallet}', [WalletController::class, 'show'])->name('carteiras.show');
    Route::post('/carteiras/{wallet}/sync', [WalletController::class, 'sync'])->name('carteiras.sync');
    Route::delete('/carteiras/{wallet}', [WalletController::class, 'destroy'])->name('carteiras.destroy');
    Route::post('/carteiras/sync-all', [WalletController::class, 'syncAll'])->name('carteiras.sync-all');

    // Operações
    Route::get('/operacoes', [App\Http\Controllers\OperationController::class, 'index'])->name('operacoes');
    Route::get('/api/operacoes', [App\Http\Controllers\OperationController::class, 'apiList'])->name('operacoes.api');

    // Declarações
    Route::get('/declaracoes', function () {
        return view('declaracoes');
    })->name('declaracoes');

    // Relatórios
    Route::get('/relatorios', function () {
        return view('relatorios');
    })->name('relatorios');

    // Pendências
    Route::get('/pendencias', function () {
        return view('pendencias');
    })->name('pendencias');

    // Perfil - Rotas com Controllers
    Route::prefix('perfil')->name('perfil.')->group(function () {
        Route::get('/', [PerfilController::class, 'index'])->name('index');
        Route::get('/dados-pessoais', [PerfilController::class, 'dadosPessoais'])->name('dados-pessoais');
        Route::put('/dados-pessoais', [PerfilController::class, 'updatePersonalData'])->name('update-dados');
        Route::put('/senha', [PerfilController::class, 'updatePassword'])->name('update-senha');
        Route::get('/seguranca', [PerfilController::class, 'seguranca'])->name('seguranca');
        Route::get('/notificacoes', [PerfilController::class, 'notificacoes'])->name('notificacoes');
        Route::put('/notificacoes', [PerfilController::class, 'updateNotifications'])->name('update-notificacoes');
        Route::get('/planos', [PerfilController::class, 'planos'])->name('planos');
        Route::get('/sessoes', [PerfilController::class, 'sessoes'])->name('sessoes');
    });

    // Rota legada para compatibilidade
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');

    // Sessões - Gerenciamento de dispositivos
    Route::delete('/sessoes/{id}', [SessionController::class, 'destroy'])->name('sessoes.destroy');
    Route::delete('/sessoes', [SessionController::class, 'destroyAll'])->name('sessoes.destroy-all');

    // Profile (Breeze) - mantido para compatibilidade
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Onboarding
    Route::get('/onboarding', function () {
        return view('onboarding.welcome');
    })->name('onboarding');

    // 2FA
    Route::get('/two-factor', [TwoFactorAuthController::class, 'show'])->name('two-factor.show');
    Route::post('/two-factor/enable', [TwoFactorAuthController::class, 'enable'])->name('two-factor.enable');
    Route::post('/two-factor/disable', [TwoFactorAuthController::class, 'disable'])->name('two-factor.disable');
});

// 2FA Challenge (sem middleware auth completo)
Route::middleware('guest')->group(function () {
    Route::get('/two-factor/challenge', [TwoFactorAuthController::class, 'challenge'])->name('two-factor.challenge');
    Route::post('/two-factor/verify', [TwoFactorAuthController::class, 'verify'])->name('two-factor.verify');
});

require __DIR__.'/auth.php';
