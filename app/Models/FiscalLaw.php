<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FiscalLaw extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'description',
        'full_content',
        'effective_date',
        'last_updated',
        'source_url',
        'keywords',
        'metadata',
        'is_active',
    ];

    protected $casts = [
        'effective_date' => 'date',
        'last_updated' => 'date',
        'keywords' => 'array',
        'metadata' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Atualizações desta lei
     */
    public function updates(): HasMany
    {
        return $this->hasMany(FiscalLawUpdate::class);
    }

    /**
     * Scope para leis ativas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para buscar por código
     */
    public function scopeByCode($query, string $code)
    {
        return $query->where('code', $code);
    }

    /**
     * Scope para buscar por palavras-chave
     */
    public function scopeWithKeyword($query, string $keyword)
    {
        return $query->whereJsonContains('keywords', $keyword);
    }

    /**
     * Retorna o conteúdo formatado para o contexto da IA
     */
    public function getAIContext(): string
    {
        $context = "## {$this->code} - {$this->title}\n\n";
        $context .= "**Descrição:** {$this->description}\n\n";
        $context .= "**Vigência:** {$this->effective_date->format('d/m/Y')}\n\n";

        if ($this->metadata) {
            $context .= "**Informações importantes:**\n";
            foreach ($this->metadata as $key => $value) {
                $context .= "- {$key}: {$value}\n";
            }
            $context .= "\n";
        }

        $context .= "**Detalhes:**\n{$this->full_content}\n\n";

        if ($this->source_url) {
            $context .= "**Fonte:** {$this->source_url}\n";
        }

        return $context;
    }
}
