@props([
    'value' => 0,
    'max' => 100,
    'color' => 'primary',
    'size' => 'md',
    'showLabel' => false,
])

@php
    $percentage = $max > 0 ? min(($value / $max) * 100, 100) : 0;

    $colors = [
        'primary' => 'bg-primary-500',
        'success' => 'bg-success-500',
        'danger' => 'bg-danger-500',
        'warning' => 'bg-warning-500',
    ];

    $sizes = [
        'sm' => 'h-1',
        'md' => 'h-2',
        'lg' => 'h-3',
    ];

    $colorClass = $colors[$color] ?? $colors['primary'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    <div class="w-full bg-gray-100 rounded-full overflow-hidden {{ $sizeClass }}">
        <div
            class="h-full rounded-full transition-all duration-300 {{ $colorClass }}"
            style="width: {{ $percentage }}%"
        ></div>
    </div>

    @if($showLabel)
        <div class="flex justify-between mt-1">
            <span class="text-xs text-gray-500">{{ number_format($value, 2, ',', '.') }}</span>
            <span class="text-xs text-gray-500">{{ number_format($max, 2, ',', '.') }}</span>
        </div>
    @endif
</div>
