<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operation extends Model
{
    protected $fillable = [
        'user_id',
        'wallet_id',
        'type',
        'executed_at',
        'from_asset',
        'from_amount',
        'from_price_brl',
        'to_asset',
        'to_amount',
        'to_price_brl',
        'total_brl',
        'fee_brl',
        'cost_basis_brl',
        'gain_loss_brl',
        'external_id',
        'tx_hash',
        'notes',
    ];

    protected $casts = [
        'executed_at' => 'datetime',
        'from_amount' => 'decimal:8',
        'from_price_brl' => 'decimal:2',
        'to_amount' => 'decimal:8',
        'to_price_brl' => 'decimal:2',
        'total_brl' => 'decimal:2',
        'fee_brl' => 'decimal:2',
        'cost_basis_brl' => 'decimal:2',
        'gain_loss_brl' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function isBuy(): bool
    {
        return $this->type === 'buy';
    }

    public function isSell(): bool
    {
        return $this->type === 'sell';
    }

    public function hasGain(): bool
    {
        return $this->gain_loss_brl && $this->gain_loss_brl > 0;
    }

    public function hasLoss(): bool
    {
        return $this->gain_loss_brl && $this->gain_loss_brl < 0;
    }
}
