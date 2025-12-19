<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PriceCache extends Model
{
    protected $table = 'price_cache';

    protected $fillable = [
        'symbol',
        'base_currency',
        'quote_currency',
        'price_date',
        'price_open',
        'price_high',
        'price_low',
        'price_close',
        'volume',
        'source',
    ];

    protected $casts = [
        'price_date' => 'date',
        'price_open' => 'decimal:8',
        'price_high' => 'decimal:8',
        'price_low' => 'decimal:8',
        'price_close' => 'decimal:8',
        'volume' => 'decimal:8',
    ];

    /**
     * Busca preço para um símbolo em uma data específica
     */
    public static function getPrice(string $symbol, Carbon $date, string $quoteCurrency = 'BRL'): ?float
    {
        $cache = self::where('symbol', strtoupper($symbol))
            ->where('quote_currency', $quoteCurrency)
            ->where('price_date', $date->format('Y-m-d'))
            ->first();

        return $cache?->price_close;
    }

    /**
     * Salva preço no cache
     */
    public static function setPrice(
        string $symbol,
        Carbon $date,
        float $price,
        string $quoteCurrency = 'BRL',
        string $source = 'coinmarketcap',
        ?float $open = null,
        ?float $high = null,
        ?float $low = null,
        ?float $volume = null
    ): self {
        return self::updateOrCreate(
            [
                'symbol' => strtoupper($symbol),
                'price_date' => $date->format('Y-m-d'),
                'quote_currency' => $quoteCurrency,
            ],
            [
                'price_close' => $price,
                'price_open' => $open,
                'price_high' => $high,
                'price_low' => $low,
                'volume' => $volume,
                'source' => $source,
            ]
        );
    }

    /**
     * Busca preços para um range de datas
     */
    public static function getPriceRange(
        string $symbol,
        Carbon $startDate,
        Carbon $endDate,
        string $quoteCurrency = 'BRL'
    ): array {
        return self::where('symbol', strtoupper($symbol))
            ->where('quote_currency', $quoteCurrency)
            ->whereBetween('price_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->orderBy('price_date')
            ->pluck('price_close', 'price_date')
            ->toArray();
    }

    /**
     * Verifica se existe cache para um símbolo em uma data
     */
    public static function hasPrice(string $symbol, Carbon $date, string $quoteCurrency = 'BRL'): bool
    {
        return self::where('symbol', strtoupper($symbol))
            ->where('quote_currency', $quoteCurrency)
            ->where('price_date', $date->format('Y-m-d'))
            ->exists();
    }

    /**
     * Retorna datas faltantes no cache para um período
     */
    public static function getMissingDates(
        string $symbol,
        Carbon $startDate,
        Carbon $endDate,
        string $quoteCurrency = 'BRL'
    ): array {
        $existingDates = self::where('symbol', strtoupper($symbol))
            ->where('quote_currency', $quoteCurrency)
            ->whereBetween('price_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->pluck('price_date')
            ->map(fn ($date) => $date->format('Y-m-d'))
            ->toArray();

        $missingDates = [];
        $current = $startDate->copy();

        while ($current <= $endDate) {
            $dateStr = $current->format('Y-m-d');
            if (!in_array($dateStr, $existingDates)) {
                $missingDates[] = $current->copy();
            }
            $current->addDay();
        }

        return $missingDates;
    }
}
