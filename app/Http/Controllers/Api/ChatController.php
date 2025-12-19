<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FiscalLawUpdate;
use App\Services\FiscalAIService;
use App\Services\LLMService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    protected FiscalAIService $fiscalAIService;
    protected LLMService $llmService;

    public function __construct(FiscalAIService $fiscalAIService, LLMService $llmService)
    {
        $this->fiscalAIService = $fiscalAIService;
        $this->llmService = $llmService;
    }

    /**
     * Envia uma mensagem para o assistente fiscal
     *
     * POST /api/chat
     */
    public function sendMessage(Request $request): JsonResponse
    {
        // Aumentar tempo de execução para chamadas à API de IA
        set_time_limit(180);

        $request->validate([
            'message' => 'required|string|max:2000',
            'session_id' => 'nullable|string|max:100',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'error' => 'Usuário não autenticado.',
            ], 401);
        }

        $message = $request->input('message');
        $sessionId = $request->input('session_id');

        try {
            $result = $this->fiscalAIService->chat($user, $message, $sessionId);

            if (!$result['success']) {
                return response()->json([
                    'success' => false,
                    'error' => $result['message'],
                ], 500);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'message' => $result['message'],
                    'message_id' => $result['message_id'],
                    'session_id' => $result['session_id'],
                    'provider' => $result['provider'],
                ],
            ]);
        } catch (\Exception $e) {
            \Log::error('ChatController: Erro ao enviar mensagem', [
                'user_id' => $user->id,
                'message' => $message,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Desculpe, ocorreu um erro ao processar sua mensagem. Tente novamente.',
            ], 500);
        }
    }

    /**
     * Retorna histórico de conversas
     *
     * GET /api/chat/history
     */
    public function getHistory(Request $request): JsonResponse
    {
        $request->validate([
            'session_id' => 'nullable|string|max:100',
            'limit' => 'nullable|integer|min:1|max:100',
        ]);

        $user = Auth::user();
        $sessionId = $request->input('session_id');
        $limit = $request->input('limit', 50);

        $history = $this->fiscalAIService->getHistory($user, $sessionId, $limit);

        return response()->json([
            'success' => true,
            'data' => $history,
        ]);
    }

    /**
     * Limpa histórico de conversas
     *
     * DELETE /api/chat/history
     */
    public function clearHistory(Request $request): JsonResponse
    {
        $request->validate([
            'session_id' => 'nullable|string|max:100',
        ]);

        $user = Auth::user();
        $sessionId = $request->input('session_id');

        $deletedCount = $this->fiscalAIService->clearHistory($user, $sessionId);

        return response()->json([
            'success' => true,
            'data' => [
                'deleted_count' => $deletedCount,
            ],
        ]);
    }

    /**
     * Retorna atualizações de leis fiscais não lidas
     *
     * GET /api/chat/law-updates
     */
    public function getLawUpdates(Request $request): JsonResponse
    {
        $request->validate([
            'days' => 'nullable|integer|min:1|max:90',
        ]);

        $days = $request->input('days', 30);

        $updates = FiscalLawUpdate::query()
            ->recent($days)
            ->orderByDesc('discovered_at')
            ->limit(10)
            ->get()
            ->map(function ($update) {
                return [
                    'id' => $update->id,
                    'title' => $update->title,
                    'type' => $update->change_type,
                    'type_label' => $update->getTypeLabel(),
                    'type_icon' => $update->getTypeIcon(),
                    'impact_level' => $update->impact_level,
                    'impact_color' => $update->getImpactColor(),
                    'summary' => $update->change_summary,
                    'affected_areas' => $update->affected_areas,
                    'source_url' => $update->source_url,
                    'source_name' => $update->source_name,
                    'discovered_at' => $update->discovered_at?->toISOString(),
                    'published_at' => $update->published_at?->toISOString(),
                ];
            });

        $unreadCount = FiscalLawUpdate::notNotified()
            ->recent($days)
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'updates' => $updates,
                'unread_count' => $unreadCount,
            ],
        ]);
    }

    /**
     * Marca atualizações de leis como lidas
     *
     * POST /api/chat/law-updates/mark-read
     */
    public function markLawUpdatesRead(Request $request): JsonResponse
    {
        $request->validate([
            'update_ids' => 'nullable|array',
            'update_ids.*' => 'integer|exists:fiscal_law_updates,id',
        ]);

        $updateIds = $request->input('update_ids');

        $query = FiscalLawUpdate::notNotified();

        if (!empty($updateIds)) {
            $query->whereIn('id', $updateIds);
        }

        $updated = $query->update([
            'users_notified' => true,
            'notified_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'marked_count' => $updated,
            ],
        ]);
    }

    /**
     * Retorna quick actions contextuais
     *
     * GET /api/chat/quick-actions
     */
    public function getQuickActions(): JsonResponse
    {
        // Aumentar tempo de execução
        set_time_limit(60);

        $user = Auth::user();

        if (!$user) {
            // Retornar ações padrão para usuários não autenticados
            return response()->json([
                'success' => true,
                'data' => [
                    ['label' => 'Limite de isenção', 'message' => 'Qual é o limite de isenção para criptomoedas?', 'priority' => 1],
                    ['label' => 'O que é IN1888?', 'message' => 'O que é a IN 1888 e quando preciso declarar?', 'priority' => 2],
                    ['label' => 'Como pagar DARF?', 'message' => 'Como faço para pagar um DARF de criptomoedas?', 'priority' => 3],
                ],
            ]);
        }

        try {
            $actions = $this->fiscalAIService->getQuickActions($user);

            return response()->json([
                'success' => true,
                'data' => $actions,
            ]);
        } catch (\Exception $e) {
            \Log::warning('ChatController: Erro ao buscar quick actions', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            // Retornar ações padrão em caso de erro
            return response()->json([
                'success' => true,
                'data' => [
                    ['label' => 'Resumo do mês', 'message' => 'Me dê um resumo da minha situação fiscal este mês', 'priority' => 1],
                    ['label' => 'Limite de isenção', 'message' => 'Qual é o limite de isenção para criptomoedas?', 'priority' => 2],
                    ['label' => 'O que é IN1888?', 'message' => 'O que é a IN 1888 e quando preciso declarar?', 'priority' => 3],
                    ['label' => 'Como pagar DARF?', 'message' => 'Como faço para pagar um DARF de criptomoedas?', 'priority' => 4],
                ],
            ]);
        }
    }

    /**
     * Verifica configuração do LLM (rota pública para debug)
     *
     * GET /api/chat/config-check
     */
    public function checkConfig(): JsonResponse
    {
        $config = $this->llmService->checkConfiguration();
        $usage = $this->llmService->getDailyUsage();

        return response()->json([
            'success' => true,
            'data' => [
                'providers' => $config,
                'daily_usage' => $usage,
                'timestamp' => now()->toISOString(),
            ],
        ]);
    }

    /**
     * Submete feedback sobre uma resposta
     *
     * POST /api/chat/feedback
     */
    public function submitFeedback(Request $request): JsonResponse
    {
        $request->validate([
            'message_id' => 'required|integer',
            'was_helpful' => 'required|boolean',
            'feedback' => 'nullable|string|max:500',
        ]);

        $success = $this->fiscalAIService->submitFeedback(
            $request->input('message_id'),
            $request->input('was_helpful'),
            $request->input('feedback')
        );

        return response()->json([
            'success' => $success,
        ]);
    }
}
