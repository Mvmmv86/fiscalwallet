@props([
    'src' => null,
    'alt' => '',
    'size' => 'md',
    'initials' => null,
])

@php
    $sizes = [
        'sm' => 'w-8 h-8 text-xs',
        'md' => 'w-10 h-10 text-sm',
        'lg' => 'w-12 h-12 text-base',
        'xl' => 'w-16 h-16 text-lg',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

@if($src)
    <img
        src="{{ $src }}"
        alt="{{ $alt }}"
        {{ $attributes->merge(['class' => "rounded-full object-cover {$sizeClass}"]) }}
    />
@else
    <div {{ $attributes->merge(['class' => "rounded-full bg-primary-100 text-primary-600 font-medium flex items-center justify-center {$sizeClass}"]) }}>
        {{ $initials ?? substr($alt, 0, 2) }}
    </div>
@endif
