<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FiscalLawSearchService
{
    /**
     * Palavras-chave para busca de leis fiscais relacionadas a criptoativos
     */
    protected array $keywords = [
        'criptomoeda',
        'criptoativo',
        'criptoativos',
        'bitcoin',
        'blockchain',
        'ativo digital',
        'ativos digitais',
        'ativo virtual',
        'moeda virtual',
        'exchange',
        'IN 1888',
        'instrução normativa criptoativos',
        'ganho capital digital',
        'tributação cripto',
        'GCAP crypto',
    ];

    /**
     * Fontes oficiais para busca
     */
    protected array $sources = [
        'receita_federal' => [
            'name' => 'Receita Federal',
            'base_url' => 'https://normas.receita.fazenda.gov.br',
            'rss_url' => null, // Sem RSS público
        ],
        'dou' => [
            'name' => 'Diário Oficial da União',
            'base_url' => 'https://www.in.gov.br',
            'rss_url' => 'https://www.in.gov.br/rss/materia/-/rss/diario-oficial-da-uniao',
        ],
        'planalto' => [
            'name' => 'Planalto - Legislação',
            'base_url' => 'https://www.planalto.gov.br',
            'rss_url' => null,
        ],
        'cvm' => [
            'name' => 'CVM',
            'base_url' => 'https://www.gov.br/cvm',
            'rss_url' => null,
        ],
    ];

    protected LLMService $llmService;
    protected PromptBuilderService $promptBuilder;

    public function __construct(LLMService $llmService, PromptBuilderService $promptBuilder)
    {
        $this->llmService = $llmService;
        $this->promptBuilder = $promptBuilder;
    }

    /**
     * Busca em todas as fontes configuradas
     */
    public function searchAllSources(): array
    {
        $findings = [];

        // 1. Buscar no RSS do DOU (mais confiável)
        $douFindings = $this->searchDOU();
        $findings = array_merge($findings, $douFindings);

        // 2. Buscar via web (fallback/complementar)
        // Nota: Em produção, considerar usar Google Custom Search API
        $webFindings = $this->searchWeb();
        $findings = array_merge($findings, $webFindings);

        Log::info('FiscalLawSearchService: Busca concluída', [
            'total_findings' => count($findings),
        ]);

        return $findings;
    }

    /**
     * Busca no RSS do Diário Oficial da União
     */
    protected function searchDOU(): array
    {
        $findings = [];

        try {
            $rssUrl = $this->sources['dou']['rss_url'];

            if (!$rssUrl) {
                return [];
            }

            $response = Http::timeout(30)->get($rssUrl);

            if (!$response->successful()) {
                Log::warning('FiscalLawSearchService: Falha ao acessar RSS do DOU', [
                    'status' => $response->status(),
                ]);
                return [];
            }

            $xml = simplexml_load_string($response->body());

            if (!$xml || !isset($xml->channel->item)) {
                return [];
            }

            foreach ($xml->channel->item as $item) {
                $title = (string) $item->title;
                $description = (string) $item->description;
                $link = (string) $item->link;
                $pubDate = (string) $item->pubDate;

                // Verificar se é relevante
                if ($this->isRelevant($title . ' ' . $description)) {
                    $findings[] = [
                        'source' => 'dou',
                        'source_name' => 'Diário Oficial da União',
                        'title' => $title,
                        'content' => $description,
                        'url' => $link,
                        'published_at' => $pubDate ? date('Y-m-d H:i:s', strtotime($pubDate)) : null,
                        'discovered_at' => now()->toDateTimeString(),
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::error('FiscalLawSearchService: Erro ao buscar no DOU', [
                'error' => $e->getMessage(),
            ]);
        }

        return $findings;
    }

    /**
     * Busca via web scraping (simplificado)
     */
    protected function searchWeb(): array
    {
        $findings = [];

        // URLs de páginas de notícias/atualizações da Receita Federal
        $urls = [
            [
                'url' => 'https://www.gov.br/receitafederal/pt-br/assuntos/noticias',
                'source' => 'receita_federal',
                'source_name' => 'Receita Federal - Notícias',
            ],
        ];

        foreach ($urls as $source) {
            try {
                $response = Http::timeout(30)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (compatible; FiscalWallet/1.0)',
                    ])
                    ->get($source['url']);

                if (!$response->successful()) {
                    continue;
                }

                $html = $response->body();

                // Extrair títulos e links (simplificado)
                // Em produção, usar parser HTML adequado
                preg_match_all('/<a[^>]*href="([^"]*)"[^>]*>([^<]*cripto[^<]*)<\/a>/i', $html, $matches, PREG_SET_ORDER);

                foreach ($matches as $match) {
                    $link = $match[1];
                    $title = strip_tags($match[2]);

                    // Normalizar URL
                    if (!str_starts_with($link, 'http')) {
                        $link = rtrim($source['url'], '/') . '/' . ltrim($link, '/');
                    }

                    $findings[] = [
                        'source' => $source['source'],
                        'source_name' => $source['source_name'],
                        'title' => $title,
                        'content' => '',
                        'url' => $link,
                        'published_at' => null,
                        'discovered_at' => now()->toDateTimeString(),
                    ];
                }
            } catch (\Exception $e) {
                Log::warning('FiscalLawSearchService: Erro ao buscar na web', [
                    'url' => $source['url'],
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return $findings;
    }

    /**
     * Verifica se um texto é relevante baseado nas palavras-chave
     */
    protected function isRelevant(string $text): bool
    {
        $lowerText = mb_strtolower($text);

        foreach ($this->keywords as $keyword) {
            if (str_contains($lowerText, mb_strtolower($keyword))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Analisa um achado usando IA para determinar relevância e impacto
     */
    public function analyzeWithAI(array $finding): ?array
    {
        $prompt = $this->promptBuilder->buildLawAnalysisPrompt();

        $content = "Título: {$finding['title']}\n";
        $content .= "Fonte: {$finding['source_name']}\n";
        $content .= "URL: {$finding['url']}\n";

        if (!empty($finding['content'])) {
            $content .= "Conteúdo: {$finding['content']}\n";
        }

        $result = $this->llmService->analyzeAsJson($prompt, $content);

        if (!$result) {
            Log::warning('FiscalLawSearchService: Falha na análise com IA', [
                'finding' => $finding['title'],
            ]);
            return null;
        }

        return $result;
    }

    /**
     * Busca o conteúdo completo de uma URL
     */
    public function fetchFullContent(string $url): ?string
    {
        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (compatible; FiscalWallet/1.0)',
                ])
                ->get($url);

            if (!$response->successful()) {
                return null;
            }

            $html = $response->body();

            // Extrair texto principal (simplificado)
            // Remove scripts, styles e tags HTML
            $text = preg_replace('/<script[^>]*>.*?<\/script>/is', '', $html);
            $text = preg_replace('/<style[^>]*>.*?<\/style>/is', '', $text);
            $text = strip_tags($text);
            $text = preg_replace('/\s+/', ' ', $text);
            $text = trim($text);

            // Limitar tamanho
            if (strlen($text) > 10000) {
                $text = substr($text, 0, 10000) . '...';
            }

            return $text;
        } catch (\Exception $e) {
            Log::warning('FiscalLawSearchService: Erro ao buscar conteúdo', [
                'url' => $url,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Retorna as palavras-chave configuradas
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * Retorna as fontes configuradas
     */
    public function getSources(): array
    {
        return $this->sources;
    }
}
