<?php

namespace App\Services\Clients;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BinancePriceClient
{
    protected string $baseUrl;
    protected int $timeout;

    protected bool $verifySSL;

    public function __construct()
    {
        $this->baseUrl = config('services.binance.base_url', 'https://api.binance.com');
        $this->timeout = config('services.binance.timeout', 30);
        $this->verifySSL = config('app.env') !== 'local';
    }

    /**
     * Cria uma requisição HTTP configurada
     */
    protected function http(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::timeout($this->timeout)->withOptions(['verify' => $this->verifySSL]);
    }

    /**
     * Busca cotação atual de um par de trading
     */
    public function getLatestPrice(string $symbol): ?float
    {
        try {
            $response = $this->http()
                ->get("{$this->baseUrl}/api/v3/ticker/price", [
                    'symbol' => strtoupper($symbol),
                ]);

            if (!$response->successful()) {
                return null;
            }

            $data = $response->json();
            return (float) ($data['price'] ?? 0);
        } catch (\Exception $e) {
            Log::error('Binance getLatestPrice error', [
                'symbol' => $symbol,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Busca cotação histórica usando klines (candlesticks)
     * @param string $symbol Par de trading (ex: BTCUSDT, BTCBRL)
     * @param Carbon $date Data desejada
     */
    public function getHistoricalPrice(string $symbol, Carbon $date): ?array
    {
        try {
            $startTime = $date->copy()->startOfDay()->getTimestampMs();
            $endTime = $date->copy()->endOfDay()->getTimestampMs();

            $response = $this->http()
                ->get("{$this->baseUrl}/api/v3/klines", [
                    'symbol' => strtoupper($symbol),
                    'interval' => '1d',
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                    'limit' => 1,
                ]);

            if (!$response->successful()) {
                return null;
            }

            $data = $response->json();

            if (empty($data)) {
                return null;
            }

            $kline = $data[0];

            return [
                'symbol' => $symbol,
                'date' => $date->format('Y-m-d'),
                'price_open' => (float) $kline[1],
                'price_high' => (float) $kline[2],
                'price_low' => (float) $kline[3],
                'price_close' => (float) $kline[4],
                'volume' => (float) $kline[5],
            ];
        } catch (\Exception $e) {
            Log::error('Binance getHistoricalPrice error', [
                'symbol' => $symbol,
                'date' => $date->format('Y-m-d'),
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Busca cotações históricas para um range de datas
     */
    public function getHistoricalPriceRange(
        string $symbol,
        Carbon $startDate,
        Carbon $endDate
    ): array {
        try {
            $startTime = $startDate->copy()->startOfDay()->getTimestampMs();
            $endTime = $endDate->copy()->endOfDay()->getTimestampMs();

            $response = $this->http()
                ->get("{$this->baseUrl}/api/v3/klines", [
                    'symbol' => strtoupper($symbol),
                    'interval' => '1d',
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                    'limit' => 1000,
                ]);

            if (!$response->successful()) {
                return [];
            }

            $data = $response->json();
            $prices = [];

            foreach ($data as $kline) {
                $date = Carbon::createFromTimestampMs($kline[0])->format('Y-m-d');
                $prices[$date] = [
                    'price_open' => (float) $kline[1],
                    'price_high' => (float) $kline[2],
                    'price_low' => (float) $kline[3],
                    'price_close' => (float) $kline[4],
                    'volume' => (float) $kline[5],
                ];
            }

            return $prices;
        } catch (\Exception $e) {
            Log::error('Binance getHistoricalPriceRange error', [
                'symbol' => $symbol,
                'error' => $e->getMessage(),
            ]);
            return [];
        }
    }

    /**
     * Busca cotação atual de múltiplos pares
     */
    public function getLatestPrices(array $symbols): array
    {
        try {
            $response = $this->http()
                ->get("{$this->baseUrl}/api/v3/ticker/price");

            if (!$response->successful()) {
                return [];
            }

            $data = $response->json();
            $symbolsUpper = array_map('strtoupper', $symbols);
            $prices = [];

            foreach ($data as $ticker) {
                if (in_array($ticker['symbol'], $symbolsUpper)) {
                    $prices[$ticker['symbol']] = (float) $ticker['price'];
                }
            }

            return $prices;
        } catch (\Exception $e) {
            Log::error('Binance getLatestPrices error', [
                'error' => $e->getMessage(),
            ]);
            return [];
        }
    }

    /**
     * Busca cotação BRL de um ativo via par intermediário
     * Primeiro busca USD, depois converte para BRL
     */
    public function getPriceInBrl(string $asset, Carbon $date): ?float
    {
        $usdPair = strtoupper($asset) . 'USDT';
        $usdPrice = $this->getHistoricalPrice($usdPair, $date);

        if (!$usdPrice) {
            $busdPair = strtoupper($asset) . 'BUSD';
            $usdPrice = $this->getHistoricalPrice($busdPair, $date);
        }

        if (!$usdPrice) {
            return null;
        }

        $usdBrlPrice = $this->getHistoricalPrice('USDTBRL', $date);

        if (!$usdBrlPrice) {
            return null;
        }

        return $usdPrice['price_close'] * $usdBrlPrice['price_close'];
    }

    /**
     * Busca a taxa USD/BRL atual
     */
    public function getUsdBrlRate(): ?float
    {
        return $this->getLatestPrice('USDTBRL');
    }

    /**
     * Busca a taxa USD/BRL histórica
     */
    public function getHistoricalUsdBrlRate(Carbon $date): ?float
    {
        $data = $this->getHistoricalPrice('USDTBRL', $date);
        return $data['price_close'] ?? null;
    }

    /**
     * Verifica se a API está funcionando
     */
    public function healthCheck(): bool
    {
        try {
            $response = Http::timeout(10)
                ->withOptions(['verify' => $this->verifySSL])
                ->get("{$this->baseUrl}/api/v3/ping");

            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Retorna lista de todos os pares de trading disponíveis
     */
    public function getExchangeInfo(): ?array
    {
        try {
            $response = $this->http()
                ->get("{$this->baseUrl}/api/v3/exchangeInfo");

            if (!$response->successful()) {
                return null;
            }

            return $response->json();
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Verifica se um par de trading existe
     */
    public function symbolExists(string $symbol): bool
    {
        $info = $this->getExchangeInfo();

        if (!$info || empty($info['symbols'])) {
            return false;
        }

        $symbols = array_column($info['symbols'], 'symbol');
        return in_array(strtoupper($symbol), $symbols);
    }
}
