<?php

use App\Http\Controllers\Api\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Rotas da API do Fiscal Wallet.
| Todas as rotas aqui são prefixadas com /api
|
*/

// Rota de status da API
Route::get('/status', function () {
    return response()->json([
        'status' => 'online',
        'version' => '1.0.0',
        'timestamp' => now()->toIso8601String(),
    ]);
});

// Rotas autenticadas (usando sessão web)
Route::middleware(['web', 'auth'])->group(function () {

    // Retorna o usuário autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // ========================================
    // CHAT / ASSISTENTE FISCAL IA
    // ========================================
    Route::prefix('chat')->group(function () {
        // Enviar mensagem para o assistente
        Route::post('/', [ChatController::class, 'sendMessage']);

        // Histórico de conversas
        Route::get('/history', [ChatController::class, 'getHistory']);

        // Limpar histórico
        Route::delete('/history', [ChatController::class, 'clearHistory']);

        // Verificar atualizações de leis (para badge de notificação)
        Route::get('/law-updates', [ChatController::class, 'getLawUpdates']);

        // Marcar atualizações como lidas
        Route::post('/law-updates/mark-read', [ChatController::class, 'markLawUpdatesRead']);

        // Quick actions contextuais (baseado na situação fiscal do usuário)
        Route::get('/quick-actions', [ChatController::class, 'getQuickActions']);
    });
});

// Rotas públicas (sem autenticação) - apenas para testes
Route::prefix('chat')->group(function () {
    // Verificar configuração do LLM
    Route::get('/config-check', [ChatController::class, 'checkConfig']);
});
