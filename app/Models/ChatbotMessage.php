<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatbotMessage extends Model
{
    protected $fillable = [
        'user_id',
        'role',
        'content',
        'intent',
        'context',
        'was_helpful',
        'feedback',
        'session_id',
    ];

    protected $casts = [
        'context' => 'array',
        'was_helpful' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeFromUser($query)
    {
        return $query->where('role', 'user');
    }

    public function scopeFromAssistant($query)
    {
        return $query->where('role', 'assistant');
    }

    public function scopeBySession($query, string $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }

    public function scopeByIntent($query, string $intent)
    {
        return $query->where('intent', $intent);
    }

    public function scopeHelpful($query)
    {
        return $query->where('was_helpful', true);
    }

    public function scopeNotHelpful($query)
    {
        return $query->where('was_helpful', false);
    }

    // Helpers
    public function isFromUser(): bool
    {
        return $this->role === 'user';
    }

    public function isFromAssistant(): bool
    {
        return $this->role === 'assistant';
    }

    public function wasHelpful(): ?bool
    {
        return $this->was_helpful;
    }

    // Métodos estáticos para criar mensagens
    public static function createUserMessage(int $userId, string $content, ?string $sessionId = null, ?string $intent = null): self
    {
        return self::create([
            'user_id' => $userId,
            'role' => 'user',
            'content' => $content,
            'session_id' => $sessionId ?? session()->getId(),
            'intent' => $intent,
        ]);
    }

    public static function createAssistantMessage(int $userId, string $content, ?string $sessionId = null, ?string $intent = null, ?array $context = null): self
    {
        return self::create([
            'user_id' => $userId,
            'role' => 'assistant',
            'content' => $content,
            'session_id' => $sessionId ?? session()->getId(),
            'intent' => $intent,
            'context' => $context,
        ]);
    }
}
