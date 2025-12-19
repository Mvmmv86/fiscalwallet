<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    protected $fillable = [
        'user_id',
        'symbol',
        'name',
        'quantity',
        'average_cost_brl',
        'total_invested_brl',
        'current_price_brl',
        'current_value_brl',
        'unrealized_gain_loss_brl',
        'realized_gain_loss_brl',
        'price_updated_at',
    ];

    protected $casts = [
        'quantity' => 'decimal:8',
        'average_cost_brl' => 'decimal:2',
        'total_invested_brl' => 'decimal:2',
        'current_price_brl' => 'decimal:2',
        'current_value_brl' => 'decimal:2',
        'unrealized_gain_loss_brl' => 'decimal:2',
        'realized_gain_loss_brl' => 'decimal:2',
        'price_updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getReturnPercentageAttribute(): float
    {
        if ($this->total_invested_brl == 0) {
            return 0;
        }

        return (($this->current_value_brl - $this->total_invested_brl) / $this->total_invested_brl) * 100;
    }
}
