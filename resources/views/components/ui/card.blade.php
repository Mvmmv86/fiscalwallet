@props([
    'title' => null,
    'subtitle' => null,
    'padding' => 'default',
    'shadow' => 'card',
])

@php
    $paddings = [
        'none' => '',
        'sm' => 'p-4',
        'default' => 'p-6',
        'lg' => 'p-8',
    ];

    $shadows = [
        'none' => '',
        'card' => 'shadow-card',
        'elevated' => 'shadow-elevated',
    ];

    $paddingClass = $paddings[$padding] ?? $paddings['default'];
    $shadowClass = $shadows[$shadow] ?? $shadows['card'];
@endphp

<div {{ $attributes->merge(['class' => "bg-white rounded-2xl border border-gray-100 {$shadowClass} {$paddingClass}"]) }}>
    @if($title || isset($header))
        <div class="flex items-center justify-between {{ $title ? 'mb-4' : '' }}">
            <div>
                @if($title)
                    <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                @endif
                @if($subtitle)
                    <p class="text-sm text-gray-500 mt-0.5">{{ $subtitle }}</p>
                @endif
            </div>
            @if(isset($header))
                {{ $header }}
            @endif
        </div>
    @endif

    {{ $slot }}

    @if(isset($footer))
        <div class="mt-4 pt-4 border-t border-gray-100">
            {{ $footer }}
        </div>
    @endif
</div>
