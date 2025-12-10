@props([
    'title' => '',
    'value' => '',
    'variant' => 'default',
    'icon' => null,
    'info' => null,
])

@php
    $variants = [
        'default' => 'bg-white border border-gray-100',
        'primary' => 'bg-gradient-to-r from-primary-600 to-primary-500 text-white',
        'success' => 'bg-white border border-gray-100',
        'danger' => 'bg-white border border-gray-100',
    ];

    $iconBgs = [
        'default' => 'bg-gray-100',
        'primary' => 'bg-white/20',
        'success' => 'bg-success-100',
        'danger' => 'bg-danger-100',
    ];

    $iconColors = [
        'default' => 'text-gray-600',
        'primary' => 'text-white',
        'success' => 'text-success-600',
        'danger' => 'text-danger-600',
    ];

    $titleColors = [
        'default' => 'text-gray-600',
        'primary' => 'text-white/90',
        'success' => 'text-gray-600',
        'danger' => 'text-gray-600',
    ];

    $valueColors = [
        'default' => 'text-gray-900',
        'primary' => 'text-white',
        'success' => 'text-gray-900',
        'danger' => 'text-gray-900',
    ];

    $variantClass = $variants[$variant] ?? $variants['default'];
    $iconBgClass = $iconBgs[$variant] ?? $iconBgs['default'];
    $iconColorClass = $iconColors[$variant] ?? $iconColors['default'];
    $titleColorClass = $titleColors[$variant] ?? $titleColors['default'];
    $valueColorClass = $valueColors[$variant] ?? $valueColors['default'];
@endphp

<div {{ $attributes->merge(['class' => "rounded-2xl p-6 shadow-card {$variantClass}"]) }}>
    <div class="flex items-start justify-between">
        @if($icon)
            <div class="p-2 rounded-lg {{ $iconBgClass }}">
                <x-dynamic-component :component="'icons.' . $icon" class="w-5 h-5 {{ $iconColorClass }}" />
            </div>
        @endif

        @if($info)
            <button type="button" class="p-1 rounded-full hover:bg-black/5 transition-colors" title="{{ $info }}">
                <x-icons.info class="w-4 h-4 {{ $variant === 'primary' ? 'text-white/70' : 'text-gray-400' }}" />
            </button>
        @endif
    </div>

    <div class="mt-4">
        <p class="text-sm font-medium {{ $titleColorClass }}">{{ $title }}</p>
        <p class="text-2xl font-bold mt-1 {{ $valueColorClass }}">{{ $value }}</p>

        @if(isset($footer))
            <div class="mt-2">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>
