<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'exchange_id',
        'name',
        'api_key',
        'api_secret',
        'import_type',
        'import_start_date',
        'status',
        'last_sync_at',
        'sync_error',
        'total_balance_brl',
    ];

    protected $hidden = [
        'api_key',
        'api_secret',
    ];

    protected $casts = [
        'import_start_date' => 'date',
        'last_sync_at' => 'datetime',
        'total_balance_brl' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exchange(): BelongsTo
    {
        return $this->belongsTo(Exchange::class);
    }

    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }

    public function syncLogs(): HasMany
    {
        return $this->hasMany(SyncLog::class);
    }

    public function latestSyncLog()
    {
        return $this->hasOne(SyncLog::class)->latestOfMany();
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isSyncing(): bool
    {
        return $this->status === 'syncing';
    }

    public function hasError(): bool
    {
        return $this->status === 'error';
    }
}
