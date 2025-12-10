@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'disabled' => false,
    'icon' => null,
    'iconRight' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed gap-2';

    $variants = [
        'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500',
        'secondary' => 'border border-primary-600 text-primary-600 hover:bg-primary-50 focus:ring-primary-500 bg-transparent',
        'neutral' => 'border border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-gray-500 bg-white',
        'danger' => 'bg-danger-500 text-white hover:bg-danger-600 focus:ring-danger-500',
        'success' => 'bg-success-500 text-white hover:bg-success-600 focus:ring-success-500',
        'ghost' => 'text-gray-600 hover:bg-gray-100 focus:ring-gray-500',
    ];

    $sizes = [
        'xl' => 'h-14 px-8 text-lg',
        'lg' => 'h-12 px-6 text-base',
        'md' => 'h-10 px-4 text-sm',
        'sm' => 'h-8 px-3 text-xs',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <x-dynamic-component :component="'icons.' . $icon" class="w-5 h-5" />
        @endif
        {{ $slot }}
        @if($iconRight)
            <x-dynamic-component :component="'icons.' . $iconRight" class="w-5 h-5" />
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <x-dynamic-component :component="'icons.' . $icon" class="w-5 h-5" />
        @endif
        {{ $slot }}
        @if($iconRight)
            <x-dynamic-component :component="'icons.' . $iconRight" class="w-5 h-5" />
        @endif
    </button>
@endif
