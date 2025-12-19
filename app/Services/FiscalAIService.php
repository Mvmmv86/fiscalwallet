<?php

namespace App\Services;

use App\Models\ChatbotMessage;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class FiscalAIService
{
    protected LLMService $llmService;
    protected PromptBuilderService $promptBuilder;
    protected UserFiscalDataService $userFiscalDataService;

    public function __construct(
        LLMService $llmService,
        PromptBuilderService $promptBuilder,
        UserFiscalDataService $userFiscalDataService
    ) {
        $this->llmService = $llmService;
        $this->promptBuilder = $promptBuilder;
        $this->userFiscalDataService = $userFiscalDataService;
    }

    /**
     * Processa uma mensagem do usuário e retorna a resposta da IA
     */
    public function chat(User $user, string $message, ?string $sessionId = null): array
    {
        $sessionId = $sessionId ?? $this->generateSessionId($user);

        try {
            // 1. Salvar mensagem do usuário
            $userMessage = $this->saveMessage($user, 'user', $message, $sessionId);

            // 2. Buscar histórico da conversa
            $history = $this->getConversationHistory($user, $sessionId);

            // 3. Construir system prompt com contexto do usuário
            $systemPrompt = $this->promptBuilder->buildSystemPrompt($user);

            // 4. Preparar mensagens para o LLM
            $messages = $this->prepareMessages($history);

            // 5. Chamar o LLM
            $result = $this->llmService->chat($systemPrompt, $messages);

            if (!$result['success']) {
                Log::error('FiscalAIService: Erro ao chamar LLM', [
                    'user_id' => $user->id,
                    'error' => $result['error'],
                ]);

                return [
                    'success' => false,
                    'message' => 'Desculpe, estou com dificuldades técnicas no momento. Tente novamente em alguns instantes.',
                    'error' => $result['error'],
                ];
            }

            // 6. Salvar resposta do assistente
            $assistantMessage = $this->saveMessage(
                $user,
                'assistant',
                $result['content'],
                $sessionId,
                ['provider' => $result['provider'], 'usage' => $result['usage'] ?? null]
            );

            // 7. Limpar cache de contexto se a conversa pode ter alterado dados
            if ($this->messageRequiresContextRefresh($message)) {
                $this->userFiscalDataService->clearCache($user);
            }

            return [
                'success' => true,
                'message' => $result['content'],
                'message_id' => $assistantMessage->id,
                'session_id' => $sessionId,
                'provider' => $result['provider'],
            ];

        } catch (\Exception $e) {
            Log::error('FiscalAIService: Exceção não tratada', [
                'user_id' => $user->id,
                'message' => $message,
                'exception' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Ocorreu um erro inesperado. Nossa equipe foi notificada.',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Salva uma mensagem no banco de dados
     */
    protected function saveMessage(
        User $user,
        string $role,
        string $content,
        string $sessionId,
        array $context = []
    ): ChatbotMessage {
        return ChatbotMessage::create([
            'user_id' => $user->id,
            'session_id' => $sessionId,
            'role' => $role,
            'content' => $content,
            'context' => !empty($context) ? $context : null,
        ]);
    }

    /**
     * Busca histórico da conversa atual
     */
    protected function getConversationHistory(User $user, string $sessionId, int $limit = 20): array
    {
        return ChatbotMessage::where('user_id', $user->id)
            ->where('session_id', $sessionId)
            ->orderBy('created_at', 'asc')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * Prepara mensagens no formato esperado pelo LLM
     */
    protected function prepareMessages(array $history): array
    {
        return array_map(function ($msg) {
            return [
                'role' => $msg['role'],
                'content' => $msg['content'],
            ];
        }, $history);
    }

    /**
     * Gera ID de sessão único
     */
    protected function generateSessionId(User $user): string
    {
        return 'session_' . $user->id . '_' . now()->format('Ymd_His') . '_' . substr(md5(uniqid()), 0, 8);
    }

    /**
     * Verifica se a mensagem pode ter alterado dados que requerem refresh do contexto
     */
    protected function messageRequiresContextRefresh(string $message): bool
    {
        $triggerWords = [
            'sincronizar', 'sincronizei', 'sync',
            'vendi', 'comprei', 'transferi',
            'adicionei', 'removi', 'deletei',
            'importei', 'importar',
        ];

        $lowerMessage = mb_strtolower($message);

        foreach ($triggerWords as $word) {
            if (str_contains($lowerMessage, $word)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Retorna histórico completo de conversas do usuário
     */
    public function getHistory(User $user, ?string $sessionId = null, int $limit = 50): array
    {
        $query = ChatbotMessage::where('user_id', $user->id)
            ->orderBy('created_at', 'desc');

        if ($sessionId) {
            $query->where('session_id', $sessionId);
        }

        $messages = $query->limit($limit)->get();

        // Agrupar por sessão
        $grouped = $messages->groupBy('session_id');

        return $grouped->map(function ($sessionMessages, $sessionId) {
            $firstMessage = $sessionMessages->last();
            $lastMessage = $sessionMessages->first();

            return [
                'session_id' => $sessionId,
                'started_at' => $firstMessage->created_at->toISOString(),
                'last_message_at' => $lastMessage->created_at->toISOString(),
                'messages_count' => $sessionMessages->count(),
                'messages' => $sessionMessages->sortBy('created_at')->values()->map(function ($msg) {
                    return [
                        'id' => $msg->id,
                        'role' => $msg->role,
                        'content' => $msg->content,
                        'created_at' => $msg->created_at->toISOString(),
                    ];
                })->toArray(),
            ];
        })->values()->toArray();
    }

    /**
     * Limpa histórico de conversas
     */
    public function clearHistory(User $user, ?string $sessionId = null): int
    {
        $query = ChatbotMessage::where('user_id', $user->id);

        if ($sessionId) {
            $query->where('session_id', $sessionId);
        }

        return $query->delete();
    }

    /**
     * Gera quick actions contextuais para o usuário
     * Versão simplificada para evitar queries pesadas
     */
    public function getQuickActions(User $user): array
    {
        // Ações padrão que sempre funcionam - sem consultas pesadas ao banco
        $actions = [
            [
                'label' => 'Resumo do mês',
                'message' => 'Me dê um resumo da minha situação fiscal este mês',
                'priority' => 1,
            ],
            [
                'label' => 'Limite de isenção',
                'message' => 'Quanto ainda posso vender este mês mantendo a isenção de R$ 35.000?',
                'priority' => 2,
            ],
            [
                'label' => 'O que é IN1888?',
                'message' => 'O que é a IN 1888 e quando preciso declarar?',
                'priority' => 3,
            ],
            [
                'label' => 'Como pagar DARF?',
                'message' => 'Como faço para pagar um DARF de criptomoedas?',
                'priority' => 4,
            ],
        ];

        try {
            // Verificação rápida: apenas conta de carteiras (query simples)
            $walletsCount = $user->wallets()->count();

            if ($walletsCount === 0) {
                // Usuário sem carteiras - sugerir adicionar
                array_unshift($actions, [
                    'label' => '📥 Conectar carteira',
                    'message' => 'Como faço para conectar minha exchange ou carteira?',
                    'priority' => 0,
                ]);
            }

            return array_slice($actions, 0, 4);

        } catch (\Exception $e) {
            Log::warning('FiscalAIService: Erro ao buscar quick actions', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return $actions;
        }
    }

    /**
     * Registra feedback sobre uma resposta
     */
    public function submitFeedback(int $messageId, bool $wasHelpful, ?string $feedback = null): bool
    {
        $message = ChatbotMessage::find($messageId);

        if (!$message) {
            return false;
        }

        $message->update([
            'was_helpful' => $wasHelpful,
            'feedback' => $feedback,
        ]);

        return true;
    }

    /**
     * Retorna estatísticas de uso do chat
     */
    public function getUsageStats(User $user): array
    {
        $totalMessages = ChatbotMessage::where('user_id', $user->id)->count();
        $totalSessions = ChatbotMessage::where('user_id', $user->id)
            ->distinct('session_id')
            ->count('session_id');
        $helpfulResponses = ChatbotMessage::where('user_id', $user->id)
            ->where('role', 'assistant')
            ->where('was_helpful', true)
            ->count();

        return [
            'total_messages' => $totalMessages,
            'total_sessions' => $totalSessions,
            'helpful_responses' => $helpfulResponses,
        ];
    }
}
