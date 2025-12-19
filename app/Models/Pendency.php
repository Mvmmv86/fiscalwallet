<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendency extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'description',
        'priority',
        'status',
        'original_value_brl',
        'fine_brl',
        'interest_brl',
        'updated_value_brl',
        'due_date',
        'instructions',
        'reference_year',
        'reference_month',
        'reference_wallet',
        'resolved_at',
    ];

    protected $casts = [
        'original_value_brl' => 'decimal:2',
        'fine_brl' => 'decimal:2',
        'interest_brl' => 'decimal:2',
        'updated_value_brl' => 'decimal:2',
        'due_date' => 'date',
        'resolved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isResolved(): bool
    {
        return $this->status === 'resolved';
    }

    public function isCritical(): bool
    {
        return $this->priority === 'critica';
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCritical($query)
    {
        return $query->where('priority', 'critica');
    }
}
