@props([
    'icon' => null,
    'variant' => 'neutral',
    'size' => 'md',
    'href' => null,
    'badge' => null,
])

@php
    $variants = [
        'neutral' => 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50',
        'primary' => 'bg-primary-600 text-white hover:bg-primary-700',
        'ghost' => 'text-gray-500 hover:bg-gray-100',
    ];

    $sizes = [
        'sm' => 'p-1.5',
        'md' => 'p-2',
        'lg' => 'p-3',
    ];

    $iconSizes = [
        'sm' => 'w-4 h-4',
        'md' => 'w-5 h-5',
        'lg' => 'w-6 h-6',
    ];

    $variantClass = $variants[$variant] ?? $variants['neutral'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $iconSize = $iconSizes[$size] ?? $iconSizes['md'];
    $classes = "rounded-full transition-colors inline-flex items-center justify-center relative {$variantClass} {$sizeClass}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <x-dynamic-component :component="'icons.' . $icon" :class="$iconSize" />
        @else
            {{ $slot }}
        @endif

        @if($badge)
            <span class="absolute top-1 right-1 w-2 h-2 bg-danger-500 rounded-full"></span>
        @endif
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <x-dynamic-component :component="'icons.' . $icon" :class="$iconSize" />
        @else
            {{ $slot }}
        @endif

        @if($badge)
            <span class="absolute top-1 right-1 w-2 h-2 bg-danger-500 rounded-full"></span>
        @endif
    </button>
@endif
