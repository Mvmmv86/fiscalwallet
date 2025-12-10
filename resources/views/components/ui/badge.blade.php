@props([
    'variant' => 'neutral',
    'size' => 'md',
    'dot' => false,
])

@php
    $variants = [
        'success' => 'bg-success-100 text-success-700',
        'danger' => 'bg-danger-100 text-danger-700',
        'warning' => 'bg-warning-100 text-warning-700',
        'primary' => 'bg-primary-100 text-primary-700',
        'neutral' => 'bg-gray-100 text-gray-700',
        'entrada' => 'bg-success-100 text-success-700',
        'saida' => 'bg-danger-100 text-danger-700',
        'saque' => 'bg-primary-100 text-primary-700',
        'deposito' => 'bg-success-100 text-success-700',
        'pendente' => 'bg-warning-100 text-warning-700',
        'isento' => 'bg-success-100 text-success-700',
    ];

    $dotColors = [
        'success' => 'bg-success-500',
        'danger' => 'bg-danger-500',
        'warning' => 'bg-warning-500',
        'primary' => 'bg-primary-500',
        'neutral' => 'bg-gray-500',
        'entrada' => 'bg-success-500',
        'saida' => 'bg-danger-500',
        'saque' => 'bg-primary-500',
        'deposito' => 'bg-success-500',
        'pendente' => 'bg-warning-500',
        'isento' => 'bg-success-500',
    ];

    $sizes = [
        'sm' => 'px-2 py-0.5 text-xs',
        'md' => 'px-3 py-1 text-xs',
        'lg' => 'px-4 py-1.5 text-sm',
    ];

    $variantClass = $variants[$variant] ?? $variants['neutral'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $dotColor = $dotColors[$variant] ?? $dotColors['neutral'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded-full font-medium {$variantClass} {$sizeClass}"]) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
    @endif
    {{ $slot }}
</span>
