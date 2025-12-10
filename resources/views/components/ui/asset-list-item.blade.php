@props([
    'name' => '',
    'value' => 0,
    'color' => '#9333EA',
    'percentage' => null,
])

<div {{ $attributes->merge(['class' => 'flex items-center justify-between py-1']) }}>
    <div class="flex items-center gap-2">
        <span class="w-2 h-2 rounded-full flex-shrink-0" style="background-color: {{ $color }}"></span>
        <span class="text-sm text-gray-600">{{ $name }}</span>
    </div>
    <div class="flex items-center gap-3">
        @if($percentage !== null)
            <span class="text-xs text-gray-400">{{ number_format($percentage, 1) }}%</span>
        @endif
        <span class="text-sm font-medium text-gray-900">
            R$ {{ number_format($value, 2, ',', '.') }}
        </span>
    </div>
</div>
