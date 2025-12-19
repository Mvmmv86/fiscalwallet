<?php

namespace App\Services;

use App\Models\PriceCache;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class PriceCacheService
{
    protected CurrencyConverterService $converter;

    public function __construct(CurrencyConverterService $converter)
    {
        $this->converter = $converter;
    }

    /**
     * Preenche cache de preços para operações
     */
    public function warmCacheForOperations(Collection $operations): void
    {
        $symbolDates = $this->groupOperationsBySymbolAndDate($operations);

        foreach ($symbolDates as $symbol => $dates) {
            $this->warmCacheForSymbol($symbol, $dates);
        }
    }

    /**
     * Agrupa operações por símbolo e data
     */
    protected function groupOperationsBySymbolAndDate(Collection $operations): array
    {
        $symbolDates = [];

        foreach ($operations as $operation) {
            $symbol = $operation->symbol ?? $operation['symbol'] ?? null;
            $date = $operation->executed_at ?? $operation['executed_at'] ?? null;

            if (!$symbol || !$date) {
                continue;
            }

            if ($date instanceof Carbon) {
                $dateStr = $date->format('Y-m-d');
            } else {
                $dateStr = Carbon::parse($date)->format('Y-m-d');
            }

            if (!isset($symbolDates[$symbol])) {
                $symbolDates[$symbol] = [];
            }

            $symbolDates[$symbol][$dateStr] = true;
        }

        return $symbolDates;
    }

    /**
     * Preenche cache para um símbolo específico
     */
    public function warmCacheForSymbol(string $symbol, array $dates): void
    {
        $sortedDates = array_keys($dates);
        sort($sortedDates);

        if (empty($sortedDates)) {
            return;
        }

        $startDate = Carbon::parse($sortedDates[0]);
        $endDate = Carbon::parse(end($sortedDates));

        $missingDates = PriceCache::getMissingDates($symbol, $startDate, $endDate, 'BRL');

        if (empty($missingDates)) {
            Log::info("Cache already warm for {$symbol}");
            return;
        }

        Log::info("Warming cache for {$symbol}", [
            'missing_dates' => count($missingDates),
            'start' => $startDate->format('Y-m-d'),
            'end' => $endDate->format('Y-m-d'),
        ]);

        $this->converter->getAssetPricesInBrl($symbol, $startDate, $endDate);
    }

    /**
     * Preenche cache para um período específico
     */
    public function warmCacheForPeriod(array $symbols, Carbon $startDate, Carbon $endDate): void
    {
        foreach ($symbols as $symbol) {
            Log::info("Warming cache for {$symbol} from {$startDate->format('Y-m-d')} to {$endDate->format('Y-m-d')}");
            $this->converter->getAssetPricesInBrl($symbol, $startDate, $endDate);
            usleep(100000);
        }
    }

    /**
     * Busca preço do cache ou API
     */
    public function getPrice(string $symbol, Carbon $date): ?float
    {
        return $this->converter->getAssetPriceInBrl($symbol, $date);
    }

    /**
     * Busca preços do cache para múltiplas operações
     */
    public function getPricesForOperations(Collection $operations): array
    {
        $prices = [];

        foreach ($operations as $operation) {
            $symbol = $operation->symbol ?? $operation['symbol'] ?? null;
            $date = $operation->executed_at ?? $operation['executed_at'] ?? null;

            if (!$symbol || !$date) {
                continue;
            }

            if (!($date instanceof Carbon)) {
                $date = Carbon::parse($date);
            }

            $dateStr = $date->format('Y-m-d');
            $key = "{$symbol}_{$dateStr}";

            if (!isset($prices[$key])) {
                $prices[$key] = $this->getPrice($symbol, $date);
            }
        }

        return $prices;
    }

    /**
     * Limpa cache antigo
     */
    public function clearOldCache(int $daysToKeep = 365): int
    {
        $cutoffDate = now()->subDays($daysToKeep);

        $deleted = PriceCache::where('price_date', '<', $cutoffDate)
            ->delete();

        Log::info("Cleared {$deleted} old price cache entries");

        return $deleted;
    }

    /**
     * Retorna estatísticas do cache
     */
    public function getCacheStats(): array
    {
        return [
            'total_entries' => PriceCache::count(),
            'symbols' => PriceCache::distinct('symbol')->count(),
            'date_range' => [
                'oldest' => PriceCache::min('price_date'),
                'newest' => PriceCache::max('price_date'),
            ],
            'by_source' => PriceCache::selectRaw('source, count(*) as count')
                ->groupBy('source')
                ->pluck('count', 'source')
                ->toArray(),
        ];
    }

    /**
     * Verifica integridade do cache para um símbolo
     */
    public function checkCacheIntegrity(string $symbol, Carbon $startDate, Carbon $endDate): array
    {
        $missingDates = PriceCache::getMissingDates($symbol, $startDate, $endDate, 'BRL');

        $totalDays = $startDate->diffInDays($endDate) + 1;
        $cachedDays = $totalDays - count($missingDates);
        $coverage = $totalDays > 0 ? ($cachedDays / $totalDays) * 100 : 0;

        return [
            'symbol' => $symbol,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'total_days' => $totalDays,
            'cached_days' => $cachedDays,
            'missing_days' => count($missingDates),
            'coverage_percent' => round($coverage, 2),
            'missing_dates' => array_map(fn ($d) => $d->format('Y-m-d'), array_slice($missingDates, 0, 10)),
        ];
    }
}
