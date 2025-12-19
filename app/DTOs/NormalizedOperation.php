<?php

namespace App\DTOs;

use Carbon\Carbon;

class NormalizedOperation
{
    public function __construct(
        public readonly string $externalId,
        public readonly string $symbol,
        public readonly string $type,
        public readonly float $quantity,
        public readonly float $priceUsd,
        public readonly float $priceBrl,
        public readonly float $totalUsd,
        public readonly float $totalBrl,
        public readonly float $feeUsd,
        public readonly float $feeBrl,
        public readonly Carbon $executedAt,
        public readonly string $source,
        public readonly ?string $name = null,
        public readonly ?string $quoteAsset = null,
        public readonly ?array $rawData = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            externalId: $data['external_id'],
            symbol: strtoupper($data['symbol']),
            type: $data['type'],
            quantity: (float) $data['quantity'],
            priceUsd: (float) ($data['price_usd'] ?? 0),
            priceBrl: (float) ($data['price_brl'] ?? 0),
            totalUsd: (float) ($data['total_usd'] ?? 0),
            totalBrl: (float) ($data['total_brl'] ?? 0),
            feeUsd: (float) ($data['fee_usd'] ?? 0),
            feeBrl: (float) ($data['fee_brl'] ?? 0),
            executedAt: $data['executed_at'] instanceof Carbon
                ? $data['executed_at']
                : Carbon::parse($data['executed_at']),
            source: $data['source'] ?? 'unknown',
            name: $data['name'] ?? null,
            quoteAsset: $data['quote_asset'] ?? null,
            rawData: $data['raw_data'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'external_id' => $this->externalId,
            'symbol' => $this->symbol,
            'name' => $this->name,
            'type' => $this->type,
            'quantity' => $this->quantity,
            'price_usd' => $this->priceUsd,
            'price_brl' => $this->priceBrl,
            'total_usd' => $this->totalUsd,
            'total_brl' => $this->totalBrl,
            'fee_usd' => $this->feeUsd,
            'fee_brl' => $this->feeBrl,
            'executed_at' => $this->executedAt,
            'source' => $this->source,
            'quote_asset' => $this->quoteAsset,
            'raw_data' => $this->rawData,
        ];
    }

    public function isPurchase(): bool
    {
        return in_array($this->type, ['buy', 'swap_in', 'deposit', 'transfer_in']);
    }

    public function isSale(): bool
    {
        return in_array($this->type, ['sell', 'swap_out']);
    }

    public function isTransfer(): bool
    {
        return in_array($this->type, ['deposit', 'withdrawal', 'transfer_in', 'transfer_out']);
    }
}
