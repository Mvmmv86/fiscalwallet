<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Exception;

class LLMService
{
    private string $primaryProvider = 'anthropic';
    private string $fallbackProvider = 'openai';

    /**
     * Envia mensagem para o LLM (Claude principal, OpenAI fallback)
     *
     * @param string $systemPrompt Instruções do sistema
     * @param array $messages Histórico de mensagens [['role' => 'user|assistant', 'content' => '...']]
     * @param array $options Opções adicionais (max_tokens, temperature, etc)
     * @return array ['success' => bool, 'content' => string, 'provider' => string, 'error' => string|null]
     */
    public function chat(string $systemPrompt, array $messages, array $options = []): array
    {
        // Tenta primeiro com Claude
        $result = $this->callClaude($systemPrompt, $messages, $options);

        if ($result['success']) {
            return $result;
        }

        Log::warning('LLMService: Claude falhou, tentando fallback OpenAI', [
            'error' => $result['error'],
        ]);

        // Fallback para OpenAI
        $result = $this->callOpenAI($systemPrompt, $messages, $options);

        if (!$result['success']) {
            Log::error('LLMService: Ambos providers falharam', [
                'error' => $result['error'],
            ]);
        }

        return $result;
    }

    /**
     * Chama a API do Claude (Anthropic)
     */
    private function callClaude(string $systemPrompt, array $messages, array $options = []): array
    {
        $apiKey = config('services.anthropic.api_key');

        if (empty($apiKey)) {
            return [
                'success' => false,
                'content' => '',
                'provider' => 'anthropic',
                'error' => 'ANTHROPIC_API_KEY não configurada',
            ];
        }

        try {
            $http = Http::withHeaders([
                'x-api-key' => $apiKey,
                'anthropic-version' => '2023-06-01',
                'Content-Type' => 'application/json',
            ])->timeout(config('services.anthropic.timeout', 60));

            // Em ambiente local, desabilitar verificação SSL (Windows sem certificados CA)
            if (app()->environment('local')) {
                $http = $http->withoutVerifying();
            }

            $response = $http->post(config('services.anthropic.base_url') . '/v1/messages', [
                'model' => $options['model'] ?? config('services.anthropic.model'),
                'max_tokens' => $options['max_tokens'] ?? config('services.anthropic.max_tokens', 2048),
                'system' => $systemPrompt,
                'messages' => $this->formatMessagesForClaude($messages),
                'temperature' => $options['temperature'] ?? 0.7,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $content = $data['content'][0]['text'] ?? '';

                // Log de uso para controle de custos
                $this->logUsage('anthropic', $data['usage'] ?? []);

                return [
                    'success' => true,
                    'content' => $content,
                    'provider' => 'anthropic',
                    'error' => null,
                    'usage' => $data['usage'] ?? null,
                ];
            }

            return [
                'success' => false,
                'content' => '',
                'provider' => 'anthropic',
                'error' => 'Claude API error: ' . $response->status() . ' - ' . $response->body(),
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'content' => '',
                'provider' => 'anthropic',
                'error' => 'Claude exception: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Chama a API do OpenAI (Fallback)
     */
    private function callOpenAI(string $systemPrompt, array $messages, array $options = []): array
    {
        $apiKey = config('services.openai.api_key');

        if (empty($apiKey)) {
            return [
                'success' => false,
                'content' => '',
                'provider' => 'openai',
                'error' => 'OPENAI_API_KEY não configurada',
            ];
        }

        try {
            $formattedMessages = $this->formatMessagesForOpenAI($systemPrompt, $messages);

            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(config('services.openai.timeout', 60));

            // Em ambiente local, desabilitar verificação SSL (Windows sem certificados CA)
            if (app()->environment('local')) {
                $http = $http->withoutVerifying();
            }

            $response = $http->post(config('services.openai.base_url') . '/v1/chat/completions', [
                'model' => $options['model'] ?? config('services.openai.model'),
                'max_tokens' => $options['max_tokens'] ?? config('services.openai.max_tokens', 2048),
                'messages' => $formattedMessages,
                'temperature' => $options['temperature'] ?? 0.7,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $content = $data['choices'][0]['message']['content'] ?? '';

                // Log de uso para controle de custos
                $this->logUsage('openai', $data['usage'] ?? []);

                return [
                    'success' => true,
                    'content' => $content,
                    'provider' => 'openai',
                    'error' => null,
                    'usage' => $data['usage'] ?? null,
                ];
            }

            return [
                'success' => false,
                'content' => '',
                'provider' => 'openai',
                'error' => 'OpenAI API error: ' . $response->status() . ' - ' . $response->body(),
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'content' => '',
                'provider' => 'openai',
                'error' => 'OpenAI exception: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Formata mensagens para o formato do Claude
     */
    private function formatMessagesForClaude(array $messages): array
    {
        return array_map(function ($msg) {
            return [
                'role' => $msg['role'] === 'assistant' ? 'assistant' : 'user',
                'content' => $msg['content'],
            ];
        }, $messages);
    }

    /**
     * Formata mensagens para o formato do OpenAI
     */
    private function formatMessagesForOpenAI(string $systemPrompt, array $messages): array
    {
        $formatted = [
            ['role' => 'system', 'content' => $systemPrompt],
        ];

        foreach ($messages as $msg) {
            $formatted[] = [
                'role' => $msg['role'],
                'content' => $msg['content'],
            ];
        }

        return $formatted;
    }

    /**
     * Log de uso para controle de custos
     */
    private function logUsage(string $provider, array $usage): void
    {
        if (empty($usage)) {
            return;
        }

        // Incrementa contadores diários no cache
        $dateKey = now()->format('Y-m-d');
        $cacheKey = "llm_usage:{$provider}:{$dateKey}";

        $current = Cache::get($cacheKey, [
            'requests' => 0,
            'input_tokens' => 0,
            'output_tokens' => 0,
        ]);

        $inputTokens = $usage['input_tokens'] ?? $usage['prompt_tokens'] ?? 0;
        $outputTokens = $usage['output_tokens'] ?? $usage['completion_tokens'] ?? 0;

        Cache::put($cacheKey, [
            'requests' => $current['requests'] + 1,
            'input_tokens' => $current['input_tokens'] + $inputTokens,
            'output_tokens' => $current['output_tokens'] + $outputTokens,
        ], now()->endOfDay());

        Log::info("LLMService: Uso registrado", [
            'provider' => $provider,
            'input_tokens' => $inputTokens,
            'output_tokens' => $outputTokens,
        ]);
    }

    /**
     * Retorna estatísticas de uso do dia
     */
    public function getDailyUsage(?string $date = null): array
    {
        $dateKey = $date ?? now()->format('Y-m-d');

        return [
            'anthropic' => Cache::get("llm_usage:anthropic:{$dateKey}", [
                'requests' => 0,
                'input_tokens' => 0,
                'output_tokens' => 0,
            ]),
            'openai' => Cache::get("llm_usage:openai:{$dateKey}", [
                'requests' => 0,
                'input_tokens' => 0,
                'output_tokens' => 0,
            ]),
        ];
    }

    /**
     * Verifica se os serviços estão configurados
     */
    public function checkConfiguration(): array
    {
        return [
            'anthropic' => [
                'configured' => !empty(config('services.anthropic.api_key')),
                'model' => config('services.anthropic.model'),
            ],
            'openai' => [
                'configured' => !empty(config('services.openai.api_key')),
                'model' => config('services.openai.model'),
            ],
        ];
    }

    /**
     * Método simples para uma única pergunta (sem histórico)
     */
    public function ask(string $systemPrompt, string $question, array $options = []): array
    {
        return $this->chat($systemPrompt, [
            ['role' => 'user', 'content' => $question],
        ], $options);
    }

    /**
     * Analisa conteúdo e retorna JSON estruturado
     */
    public function analyzeAsJson(string $systemPrompt, string $content, array $options = []): ?array
    {
        $result = $this->ask(
            $systemPrompt . "\n\nIMPORTANTE: Responda APENAS com JSON válido, sem markdown ou texto adicional.",
            $content,
            $options
        );

        if (!$result['success']) {
            return null;
        }

        // Tenta extrair JSON da resposta
        $jsonContent = $result['content'];

        // Remove possíveis blocos de código markdown
        if (preg_match('/```(?:json)?\s*([\s\S]*?)\s*```/', $jsonContent, $matches)) {
            $jsonContent = $matches[1];
        }

        $decoded = json_decode(trim($jsonContent), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::warning('LLMService: Falha ao decodificar JSON', [
                'content' => $result['content'],
                'error' => json_last_error_msg(),
            ]);
            return null;
        }

        return $decoded;
    }
}
