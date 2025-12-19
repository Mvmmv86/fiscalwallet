<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SyncLog extends Model
{
    protected $fillable = [
        'wallet_id',
        'type',
        'status',
        'total_operations',
        'processed_operations',
        'new_operations',
        'updated_operations',
        'failed_operations',
        'started_at',
        'completed_at',
        'duration_seconds',
        'error_message',
        'error_details',
        'metadata',
    ];

    protected $casts = [
        'error_details' => 'array',
        'metadata' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRunning($query)
    {
        return $query->where('status', 'running');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    // Helpers
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isRunning(): bool
    {
        return $this->status === 'running';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function getProgressPercentageAttribute(): float
    {
        if ($this->total_operations === 0) {
            return 0;
        }

        return round(($this->processed_operations / $this->total_operations) * 100, 2);
    }

    // Métodos de controle
    public function start(): void
    {
        $this->update([
            'status' => 'running',
            'started_at' => now(),
        ]);
    }

    public function complete(): void
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
            'duration_seconds' => $this->started_at
                ? now()->diffInSeconds($this->started_at)
                : null,
        ]);
    }

    public function fail(string $message, ?array $details = null): void
    {
        $this->update([
            'status' => 'failed',
            'completed_at' => now(),
            'error_message' => $message,
            'error_details' => $details,
            'duration_seconds' => $this->started_at
                ? now()->diffInSeconds($this->started_at)
                : null,
        ]);
    }
}
