@props([
    'title' => 'Relatório',
    'subtitle' => null,
    'usuario' => null,
    'periodo' => null
])

<div class="document-header">
    <div class="logo">
        <div class="logo-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white" opacity="0.9"/>
                <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div>
            <div class="logo-text">Fiscal <span>Wallet</span></div>
            <div class="text-xs text-gray-500">Gestao Fiscal de Criptoativos</div>
        </div>
    </div>

    <div class="info">
        @if($usuario)
            <div class="text-sm font-semibold text-gray-900">{{ $usuario['nome'] ?? 'Usuario' }}</div>
            <div class="text-xs text-gray-500">CPF: {{ $usuario['cpf'] ?? '000.000.000-00' }}</div>
        @endif
        @if($periodo)
            <div class="text-xs text-gray-500 mt-1">
                Periodo: {{ $periodo['inicio'] ?? '' }} a {{ $periodo['fim'] ?? '' }}
            </div>
        @endif
        <div class="text-xs text-gray-400 mt-1">
            Gerado em: {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>
</div>

@if($title)
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
    @if($subtitle)
        <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
    @endif
</div>
@endif
