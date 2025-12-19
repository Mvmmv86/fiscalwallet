<?php

namespace App\Services\Clients;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CoinMarketCapClient
{
    protected string $apiKey;
    protected string $baseUrl;
    protected int $timeout;

    protected bool $verifySSL;

    public function __construct()
    {
        $this->apiKey = config('services.coinmarketcap.api_key', '');
        $this->baseUrl = config('services.coinmarketcap.base_url', 'https://pro-api.coinmarketcap.com');
        $this->timeout = config('services.coinmarketcap.timeout', 30);
        $this->verifySSL = config('app.env') !== 'local';
    }

    /**
     * Cria uma requisição HTTP configurada
     */
    protected function http(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $this->apiKey,
            'Accept' => 'application/json',
        ])->timeout($this->timeout)->withOptions(['verify' => $this->verifySSL]);
    }

    /**
     * Busca cotação atual de um símbolo
     */
    public function getLatestQuote(string $symbol, string $convert = 'BRL'): ?array
    {
        try {
            $response = $this->http()
                ->get("{$this->baseUrl}/v1/cryptocurrency/quotes/latest", [
                    'symbol' => strtoupper($symbol),
                    'convert' => $convert,
                ]);

            if (!$response->successful()) {
                Log::error('CoinMarketCap API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return null;
            }

            $data = $response->json();
            $symbolData = $data['data'][strtoupper($symbol)] ?? null;

            if (!$symbolData) {
                return null;
            }

            $quote = $symbolData['quote'][$convert] ?? null;

            return [
                'symbol' => $symbol,
                'name' => $symbolData['name'],
                'price' => $quote['price'] ?? 0,
                'volume_24h' => $quote['volume_24h'] ?? 0,
                'percent_change_24h' => $quote['percent_change_24h'] ?? 0,
                'market_cap' => $quote['market_cap'] ?? 0,
                'last_updated' => $quote['last_updated'] ?? now()->toISOString(),
            ];
        } catch (\Exception $e) {
            Log::error('CoinMarketCap getLatestQuote error', [
                'symbol' => $symbol,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Busca cotação histórica de um símbolo
     * Requer plano Startup ($79/mês) ou superior
     */
    public function getHistoricalQuote(string $symbol, Carbon $date, string $convert = 'BRL'): ?array
    {
        try {
            $response = $this->http()
                ->get("{$this->baseUrl}/v2/cryptocurrency/quotes/historical", [
                    'symbol' => strtoupper($symbol),
                    'convert' => $convert,
                    'time_start' => $date->startOfDay()->toISOString(),
                    'time_end' => $date->endOfDay()->toISOString(),
                    'count' => 1,
                    'interval' => 'daily',
                ]);

            if (!$response->successful()) {
                Log::warning('CoinMarketCap historical API error', [
                    'status' => $response->status(),
                    'symbol' => $symbol,
                    'date' => $date->format('Y-m-d'),
                ]);
                return null;
            }

            $data = $response->json();
            $symbolData = $data['data'][strtoupper($symbol)] ?? null;

            if (!$symbolData || empty($symbolData['quotes'])) {
                return null;
            }

            $quote = $symbolData['quotes'][0]['quote'][$convert] ?? null;

            if (!$quote) {
                return null;
            }

            return [
                'symbol' => $symbol,
                'name' => $symbolData['name'] ?? $symbol,
                'date' => $date->format('Y-m-d'),
                'price_open' => $quote['open'] ?? $quote['price'] ?? 0,
                'price_high' => $quote['high'] ?? $quote['price'] ?? 0,
                'price_low' => $quote['low'] ?? $quote['price'] ?? 0,
                'price_close' => $quote['close'] ?? $quote['price'] ?? 0,
                'volume' => $quote['volume'] ?? 0,
            ];
        } catch (\Exception $e) {
            Log::error('CoinMarketCap getHistoricalQuote error', [
                'symbol' => $symbol,
                'date' => $date->format('Y-m-d'),
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Busca cotações históricas para um range de datas
     * Requer plano Startup ($79/mês) ou superior
     */
    public function getHistoricalQuoteRange(
        string $symbol,
        Carbon $startDate,
        Carbon $endDate,
        string $convert = 'BRL'
    ): array {
        try {
            $response = $this->http()
                ->get("{$this->baseUrl}/v2/cryptocurrency/quotes/historical", [
                    'symbol' => strtoupper($symbol),
                    'convert' => $convert,
                    'time_start' => $startDate->startOfDay()->toISOString(),
                    'time_end' => $endDate->endOfDay()->toISOString(),
                    'interval' => 'daily',
                ]);

            if (!$response->successful()) {
                Log::warning('CoinMarketCap historical range API error', [
                    'status' => $response->status(),
                    'symbol' => $symbol,
                ]);
                return [];
            }

            $data = $response->json();
            $symbolData = $data['data'][strtoupper($symbol)] ?? null;

            if (!$symbolData || empty($symbolData['quotes'])) {
                return [];
            }

            $prices = [];
            foreach ($symbolData['quotes'] as $quoteData) {
                $quote = $quoteData['quote'][$convert] ?? null;
                if ($quote) {
                    $timestamp = Carbon::parse($quoteData['timestamp']);
                    $prices[$timestamp->format('Y-m-d')] = [
                        'price_open' => $quote['open'] ?? $quote['price'] ?? 0,
                        'price_high' => $quote['high'] ?? $quote['price'] ?? 0,
                        'price_low' => $quote['low'] ?? $quote['price'] ?? 0,
                        'price_close' => $quote['close'] ?? $quote['price'] ?? 0,
                        'volume' => $quote['volume'] ?? 0,
                    ];
                }
            }

            return $prices;
        } catch (\Exception $e) {
            Log::error('CoinMarketCap getHistoricalQuoteRange error', [
                'symbol' => $symbol,
                'error' => $e->getMessage(),
            ]);
            return [];
        }
    }

    /**
     * Busca cotações de múltiplos símbolos de uma vez
     */
    public function getLatestQuotes(array $symbols, string $convert = 'BRL'): array
    {
        try {
            $response = $this->http()
                ->get("{$this->baseUrl}/v1/cryptocurrency/quotes/latest", [
                    'symbol' => implode(',', array_map('strtoupper', $symbols)),
                    'convert' => $convert,
                ]);

            if (!$response->successful()) {
                Log::error('CoinMarketCap batch API error', [
                    'status' => $response->status(),
                ]);
                return [];
            }

            $data = $response->json();
            $quotes = [];

            foreach ($symbols as $symbol) {
                $symbolUpper = strtoupper($symbol);
                $symbolData = $data['data'][$symbolUpper] ?? null;

                if ($symbolData) {
                    $quote = $symbolData['quote'][$convert] ?? null;
                    $quotes[$symbolUpper] = [
                        'symbol' => $symbolUpper,
                        'name' => $symbolData['name'],
                        'price' => $quote['price'] ?? 0,
                        'volume_24h' => $quote['volume_24h'] ?? 0,
                        'last_updated' => $quote['last_updated'] ?? now()->toISOString(),
                    ];
                }
            }

            return $quotes;
        } catch (\Exception $e) {
            Log::error('CoinMarketCap getLatestQuotes error', [
                'symbols' => $symbols,
                'error' => $e->getMessage(),
            ]);
            return [];
        }
    }

    /**
     * Busca a cotação USD/BRL atual
     */
    public function getUsdBrlRate(): ?float
    {
        try {
            $response = $this->http()
                ->get("{$this->baseUrl}/v1/tools/price-conversion", [
                    'amount' => 1,
                    'symbol' => 'USD',
                    'convert' => 'BRL',
                ]);

            if (!$response->successful()) {
                return null;
            }

            $data = $response->json();
            return $data['data']['quote']['BRL']['price'] ?? null;
        } catch (\Exception $e) {
            Log::error('CoinMarketCap getUsdBrlRate error', [
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Verifica se a API está funcionando
     */
    public function healthCheck(): bool
    {
        try {
            $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => $this->apiKey,
                'Accept' => 'application/json',
            ])
                ->timeout(10)
                ->withOptions(['verify' => $this->verifySSL])
                ->get("{$this->baseUrl}/v1/key/info");

            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Retorna informações sobre o uso da API
     */
    public function getApiUsage(): ?array
    {
        try {
            $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => $this->apiKey,
                'Accept' => 'application/json',
            ])
                ->timeout($this->timeout)
                ->get("{$this->baseUrl}/v1/key/info");

            if (!$response->successful()) {
                return null;
            }

            $data = $response->json();
            return $data['data']['usage'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
