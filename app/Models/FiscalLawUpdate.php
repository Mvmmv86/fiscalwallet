<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FiscalLawUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'fiscal_law_id',
        'title',
        'change_summary',
        'change_type',
        'impact_level',
        'affected_areas',
        'full_content',
        'source_url',
        'source_name',
        'published_at',
        'discovered_at',
        'users_notified',
        'notified_at',
    ];

    protected $casts = [
        'affected_areas' => 'array',
        'published_at' => 'datetime',
        'discovered_at' => 'datetime',
        'notified_at' => 'datetime',
        'users_notified' => 'boolean',
    ];

    /**
     * Lei relacionada
     */
    public function fiscalLaw(): BelongsTo
    {
        return $this->belongsTo(FiscalLaw::class);
    }

    /**
     * Scope para atualizações não notificadas
     */
    public function scopeNotNotified($query)
    {
        return $query->where('users_notified', false);
    }

    /**
     * Scope para atualizações de alto impacto
     */
    public function scopeHighImpact($query)
    {
        return $query->where('impact_level', 'high');
    }

    /**
     * Scope para atualizações recentes (últimos N dias)
     */
    public function scopeRecent($query, int $days = 7)
    {
        return $query->where('discovered_at', '>=', now()->subDays($days));
    }

    /**
     * Scope por tipo de mudança
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('change_type', $type);
    }

    /**
     * Scope por área afetada
     */
    public function scopeAffecting($query, string $area)
    {
        return $query->whereJsonContains('affected_areas', $area);
    }

    /**
     * Marcar como notificado
     */
    public function markAsNotified(): void
    {
        $this->update([
            'users_notified' => true,
            'notified_at' => now(),
        ]);
    }

    /**
     * Retorna o ícone baseado no tipo de mudança
     */
    public function getTypeIcon(): string
    {
        return match ($this->change_type) {
            'new_law' => '📋',
            'amendment' => '✏️',
            'clarification' => '💡',
            'revocation' => '❌',
            'deadline' => '📅',
            'rate_change' => '💰',
            default => '📌',
        };
    }

    /**
     * Retorna o texto do tipo de mudança em português
     */
    public function getTypeLabel(): string
    {
        return match ($this->change_type) {
            'new_law' => 'Nova Lei',
            'amendment' => 'Alteração',
            'clarification' => 'Esclarecimento',
            'revocation' => 'Revogação',
            'deadline' => 'Mudança de Prazo',
            'rate_change' => 'Mudança de Alíquota',
            default => 'Atualização',
        };
    }

    /**
     * Retorna a cor do badge baseado no impacto
     */
    public function getImpactColor(): string
    {
        return match ($this->impact_level) {
            'high' => 'red',
            'medium' => 'yellow',
            'low' => 'green',
            default => 'gray',
        };
    }

    /**
     * Formata para exibição no chat
     */
    public function toChatMessage(): string
    {
        $icon = $this->getTypeIcon();
        $label = $this->getTypeLabel();

        $message = "{$icon} **{$label}:** {$this->title}\n\n";
        $message .= "{$this->change_summary}\n\n";

        if ($this->published_at) {
            $message .= "📅 Publicado em: {$this->published_at->format('d/m/Y')}\n";
        }

        $message .= "🔗 [Ver fonte oficial]({$this->source_url})";

        return $message;
    }
}
