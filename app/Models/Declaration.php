<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Declaration extends Model
{
    protected $fillable = [
        'user_id',
        'year',
        'month',
        'total_operado_brl',
        'total_alienacao_brl',
        'total_taxas_brl',
        'num_operacoes',
        'in1888_status',
        'gcap_status',
        'irpf_status',
        'ganho_capital_brl',
        'imposto_devido_brl',
        'is_exempt',
        'darf_pdf_path',
        'in1888_file_path',
        'gcap_file_path',
    ];

    protected $casts = [
        'total_operado_brl' => 'decimal:2',
        'total_alienacao_brl' => 'decimal:2',
        'total_taxas_brl' => 'decimal:2',
        'ganho_capital_brl' => 'decimal:2',
        'imposto_devido_brl' => 'decimal:2',
        'is_exempt' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getMonthNameAttribute(): string
    {
        $months = [
            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março',
            4 => 'Abril', 5 => 'Maio', 6 => 'Junho',
            7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro',
            10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro',
        ];

        return $months[$this->month] ?? '';
    }

    public function hasPendingObligations(): bool
    {
        return $this->in1888_status === 'pendente'
            || $this->gcap_status === 'pendente'
            || $this->irpf_status === 'pendente';
    }
}
