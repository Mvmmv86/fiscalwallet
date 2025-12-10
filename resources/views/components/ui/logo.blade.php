@props([
    'size' => 'md',
    'showText' => false,
    'href' => null,
])

@php
    $sizes = [
        'sm' => ['icon' => 'h-6', 'text' => 'text-base'],
        'md' => ['icon' => 'h-8', 'text' => 'text-lg'],
        'lg' => ['icon' => 'h-10', 'text' => 'text-xl'],
        'xl' => ['icon' => 'h-12', 'text' => 'text-2xl'],
    ];

    $sizeConfig = $sizes[$size] ?? $sizes['md'];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center']) }}>
@else
    <div {{ $attributes->merge(['class' => 'inline-flex items-center']) }}>
@endif
        <img
            src="{{ asset('assets/images/logo/imageslogo.svg.svg') }}"
            alt="Fiscal Wallet"
            class="{{ $sizeConfig['icon'] }} w-auto"
        />
        @if($showText)
            <span class="{{ $sizeConfig['text'] }} font-semibold text-gray-900 ml-2">Fiscal <span class="font-normal text-gray-400">Wallet</span></span>
        @endif
@if($href)
    </a>
@else
    </div>
@endif
