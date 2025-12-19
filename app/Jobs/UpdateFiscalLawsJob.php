<?php

namespace App\Jobs;

use App\Models\FiscalLaw;
use App\Models\FiscalLawUpdate;
use App\Services\FiscalKnowledgeBase;
use App\Services\FiscalLawSearchService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateFiscalLawsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Número de tentativas
     */
    public int $tries = 3;

    /**
     * Timeout em segundos
     */
    public int $timeout = 600; // 10 minutos

    /**
     * Backoff entre tentativas (segundos)
     */
    public int $backoff = 60;

    /**
     * Execute o job
     */
    public function handle(
        FiscalLawSearchService $searchService,
        FiscalKnowledgeBase $knowledgeBase
    ): void {
        Log::info('UpdateFiscalLawsJob: Iniciando busca por atualizações de leis fiscais');

        try {
            // 1. Buscar em todas as fontes
            $findings = $searchService->searchAllSources();

            Log::info('UpdateFiscalLawsJob: Achados encontrados', [
                'count' => count($findings),
            ]);

            if (empty($findings)) {
                Log::info('UpdateFiscalLawsJob: Nenhum achado relevante encontrado');
                return;
            }

            $newUpdates = 0;
            $skipped = 0;

            // 2. Processar cada achado
            foreach ($findings as $finding) {
                // Verificar se já foi processado (evitar duplicatas)
                $exists = FiscalLawUpdate::where('source_url', $finding['url'])
                    ->exists();

                if ($exists) {
                    $skipped++;
                    continue;
                }

                // 3. Buscar conteúdo completo se necessário
                if (empty($finding['content'])) {
                    $fullContent = $searchService->fetchFullContent($finding['url']);
                    if ($fullContent) {
                        $finding['content'] = $fullContent;
                    }
                }

                // 4. Analisar com IA
                $analysis = $searchService->analyzeWithAI($finding);

                if (!$analysis || !$analysis['is_relevant']) {
                    Log::debug('UpdateFiscalLawsJob: Achado não relevante', [
                        'title' => $finding['title'],
                    ]);
                    continue;
                }

                // 5. Criar registro no banco
                $update = $this->createLawUpdate($finding, $analysis);

                if ($update) {
                    $newUpdates++;

                    Log::info('UpdateFiscalLawsJob: Nova atualização registrada', [
                        'id' => $update->id,
                        'title' => $update->title,
                        'impact' => $update->impact_level,
                    ]);
                }
            }

            // 6. Limpar cache do knowledge base para incluir novas informações
            if ($newUpdates > 0) {
                $knowledgeBase->clearCache();
            }

            Log::info('UpdateFiscalLawsJob: Processamento concluído', [
                'new_updates' => $newUpdates,
                'skipped' => $skipped,
            ]);

        } catch (\Exception $e) {
            Log::error('UpdateFiscalLawsJob: Erro no processamento', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e; // Propaga para retry
        }
    }

    /**
     * Cria registro de atualização de lei
     */
    protected function createLawUpdate(array $finding, array $analysis): ?FiscalLawUpdate
    {
        try {
            // Tentar associar a uma lei existente
            $fiscalLawId = null;
            if (!empty($analysis['affected_areas'])) {
                $law = FiscalLaw::whereIn('code', $analysis['affected_areas'])->first();
                $fiscalLawId = $law?->id;
            }

            return FiscalLawUpdate::create([
                'fiscal_law_id' => $fiscalLawId,
                'title' => $finding['title'],
                'change_summary' => $analysis['summary'] ?? 'Atualização detectada automaticamente.',
                'change_type' => $analysis['change_type'] ?? 'clarification',
                'impact_level' => $analysis['impact_level'] ?? 'low',
                'affected_areas' => $analysis['affected_areas'] ?? [],
                'full_content' => $finding['content'] ?? null,
                'source_url' => $finding['url'],
                'source_name' => $finding['source_name'],
                'published_at' => $finding['published_at'] ? \Carbon\Carbon::parse($finding['published_at']) : null,
                'discovered_at' => now(),
                'users_notified' => false,
            ]);

        } catch (\Exception $e) {
            Log::error('UpdateFiscalLawsJob: Erro ao criar registro', [
                'finding' => $finding['title'],
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Handle job failure
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('UpdateFiscalLawsJob: Job falhou após todas as tentativas', [
            'error' => $exception->getMessage(),
        ]);

        // Aqui poderia notificar administradores
    }
}
