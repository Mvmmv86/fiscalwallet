<?php

namespace App\Services;

use App\Models\PriceCache;
use App\Services\Clients\BinancePriceClient;
use App\Services\Clients\CoinMarketCapClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CurrencyConverterService
{
    protected CoinMarketCapClient $coinMarketCap;
    protected BinancePriceClient $binance;

    public function __construct(
        CoinMarketCapClient $coinMarketCap,
        BinancePriceClient $binance
    ) {
        $this->coinMarketCap = $coinMarketCap;
        $this->binance = $binance;
    }

    /**
     * Converte valor de USD para BRL em uma data específica
     */
    public function convertUsdToBrl(float $amountUsd, Carbon $date): float
    {
        $rate = $this->getUsdBrlRate($date);
        return $amountUsd * $rate;
    }

    /**
     * Busca cotação de um ativo em BRL para uma data específica
     * Usa CoinMarketCap como primário e Binance como fallback
     */
    public function getAssetPriceInBrl(string $symbol, Carbon $date): ?float
    {
        $cachedPrice = PriceCache::getPrice($symbol, $date, 'BRL');

        if ($cachedPrice !== null) {
            return $cachedPrice;
        }

        $price = $this->fetchPriceFromCoinMarketCap($symbol, $date);

        if ($price === null) {
            Log::info("CoinMarketCap failed for {$symbol}, trying Binance fallback");
            $price = $this->fetchPriceFromBinance($symbol, $date);
        }

        if ($price !== null) {
            PriceCache::setPrice(
                $symbol,
                $date,
                $price['price_close'],
                'BRL',
                $price['source'],
                $price['price_open'] ?? null,
                $price['price_high'] ?? null,
                $price['price_low'] ?? null,
                $price['volume'] ?? null
            );

            return $price['price_close'];
        }

        Log::warning("Could not fetch price for {$symbol} on {$date->format('Y-m-d')}");
        return null;
    }

    /**
     * Busca cotações para múltiplas datas
     */
    public function getAssetPricesInBrl(string $symbol, Carbon $startDate, Carbon $endDate): array
    {
        $cachedPrices = PriceCache::getPriceRange($symbol, $startDate, $endDate, 'BRL');

        $missingDates = PriceCache::getMissingDates($symbol, $startDate, $endDate, 'BRL');

        if (empty($missingDates)) {
            return $cachedPrices;
        }

        $fetchedPrices = $this->fetchPriceRangeFromCoinMarketCap($symbol, $startDate, $endDate);

        if (empty($fetchedPrices)) {
            $fetchedPrices = $this->fetchPriceRangeFromBinance($symbol, $startDate, $endDate);
        }

        foreach ($fetchedPrices as $dateStr => $priceData) {
            $date = Carbon::parse($dateStr);
            if (!PriceCache::hasPrice($symbol, $date, 'BRL')) {
                PriceCache::setPrice(
                    $symbol,
                    $date,
                    $priceData['price_close'],
                    'BRL',
                    $priceData['source'] ?? 'coinmarketcap',
                    $priceData['price_open'] ?? null,
                    $priceData['price_high'] ?? null,
                    $priceData['price_low'] ?? null,
                    $priceData['volume'] ?? null
                );
            }
        }

        return PriceCache::getPriceRange($symbol, $startDate, $endDate, 'BRL');
    }

    /**
     * Busca taxa USD/BRL para uma data específica
     */
    public function getUsdBrlRate(Carbon $date): float
    {
        $cacheKey = "usd_brl_rate_{$date->format('Y-m-d')}";

        return Cache::remember($cacheKey, 86400, function () use ($date) {
            $cachedPrice = PriceCache::getPrice('USD', $date, 'BRL');

            if ($cachedPrice !== null) {
                return $cachedPrice;
            }

            $rate = $this->fetchUsdBrlRateFromCoinMarketCap($date);

            if ($rate === null) {
                $rate = $this->fetchUsdBrlRateFromBinance($date);
            }

            if ($rate !== null) {
                PriceCache::setPrice('USD', $date, $rate, 'BRL', 'usd_brl');
                return $rate;
            }

            Log::warning("Could not fetch USD/BRL rate for {$date->format('Y-m-d')}, using fallback");
            return 5.0;
        });
    }

    /**
     * Busca cotação atual de um ativo em BRL
     */
    public function getCurrentPriceInBrl(string $symbol): ?float
    {
        $cacheKey = "current_price_{$symbol}_brl";

        return Cache::remember($cacheKey, 300, function () use ($symbol) {
            $quote = $this->coinMarketCap->getLatestQuote($symbol, 'BRL');

            if ($quote && isset($quote['price'])) {
                return $quote['price'];
            }

            $usdtPair = "{$symbol}USDT";
            $usdPrice = $this->binance->getLatestPrice($usdtPair);

            if ($usdPrice) {
                $usdBrlRate = $this->getCurrentUsdBrlRate();
                return $usdPrice * $usdBrlRate;
            }

            return null;
        });
    }

    /**
     * Busca taxa USD/BRL atual
     */
    public function getCurrentUsdBrlRate(): float
    {
        $cacheKey = 'current_usd_brl_rate';

        return Cache::remember($cacheKey, 300, function () {
            $rate = $this->coinMarketCap->getUsdBrlRate();

            if ($rate !== null) {
                return $rate;
            }

            $rate = $this->binance->getUsdBrlRate();

            if ($rate !== null) {
                return $rate;
            }

            return 5.0;
        });
    }

    /**
     * Busca cotação do CoinMarketCap
     */
    protected function fetchPriceFromCoinMarketCap(string $symbol, Carbon $date): ?array
    {
        $data = $this->coinMarketCap->getHistoricalQuote($symbol, $date, 'BRL');

        if ($data) {
            $data['source'] = 'coinmarketcap';
            return $data;
        }

        return null;
    }

    /**
     * Busca cotação da Binance (fallback)
     */
    protected function fetchPriceFromBinance(string $symbol, Carbon $date): ?array
    {
        $pair = "{$symbol}BRL";
        $data = $this->binance->getHistoricalPrice($pair, $date);

        if ($data) {
            $data['source'] = 'binance';
            return $data;
        }

        $usdtPair = "{$symbol}USDT";
        $usdData = $this->binance->getHistoricalPrice($usdtPair, $date);

        if ($usdData) {
            $usdBrlRate = $this->getUsdBrlRate($date);
            return [
                'symbol' => $symbol,
                'date' => $date->format('Y-m-d'),
                'price_open' => $usdData['price_open'] * $usdBrlRate,
                'price_high' => $usdData['price_high'] * $usdBrlRate,
                'price_low' => $usdData['price_low'] * $usdBrlRate,
                'price_close' => $usdData['price_close'] * $usdBrlRate,
                'volume' => $usdData['volume'],
                'source' => 'binance_converted',
            ];
        }

        return null;
    }

    /**
     * Busca cotações em range do CoinMarketCap
     */
    protected function fetchPriceRangeFromCoinMarketCap(string $symbol, Carbon $startDate, Carbon $endDate): array
    {
        $prices = $this->coinMarketCap->getHistoricalQuoteRange($symbol, $startDate, $endDate, 'BRL');

        foreach ($prices as &$price) {
            $price['source'] = 'coinmarketcap';
        }

        return $prices;
    }

    /**
     * Busca cotações em range da Binance
     */
    protected function fetchPriceRangeFromBinance(string $symbol, Carbon $startDate, Carbon $endDate): array
    {
        $pair = "{$symbol}BRL";
        $prices = $this->binance->getHistoricalPriceRange($pair, $startDate, $endDate);

        if (!empty($prices)) {
            foreach ($prices as &$price) {
                $price['source'] = 'binance';
            }
            return $prices;
        }

        $usdtPair = "{$symbol}USDT";
        $usdPrices = $this->binance->getHistoricalPriceRange($usdtPair, $startDate, $endDate);

        if (empty($usdPrices)) {
            return [];
        }

        $convertedPrices = [];
        foreach ($usdPrices as $dateStr => $usdPrice) {
            $date = Carbon::parse($dateStr);
            $usdBrlRate = $this->getUsdBrlRate($date);

            $convertedPrices[$dateStr] = [
                'price_open' => $usdPrice['price_open'] * $usdBrlRate,
                'price_high' => $usdPrice['price_high'] * $usdBrlRate,
                'price_low' => $usdPrice['price_low'] * $usdBrlRate,
                'price_close' => $usdPrice['price_close'] * $usdBrlRate,
                'volume' => $usdPrice['volume'],
                'source' => 'binance_converted',
            ];
        }

        return $convertedPrices;
    }

    /**
     * Busca taxa USD/BRL do CoinMarketCap
     */
    protected function fetchUsdBrlRateFromCoinMarketCap(Carbon $date): ?float
    {
        if ($date->isToday()) {
            return $this->coinMarketCap->getUsdBrlRate();
        }

        return null;
    }

    /**
     * Busca taxa USD/BRL da Binance
     */
    protected function fetchUsdBrlRateFromBinance(Carbon $date): ?float
    {
        if ($date->isToday()) {
            return $this->binance->getUsdBrlRate();
        }

        return $this->binance->getHistoricalUsdBrlRate($date);
    }

    /**
     * Verifica status dos serviços de cotação
     */
    public function getServicesStatus(): array
    {
        return [
            'coinmarketcap' => $this->coinMarketCap->healthCheck(),
            'binance' => $this->binance->healthCheck(),
        ];
    }
}
