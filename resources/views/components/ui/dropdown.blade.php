@props([
    'align' => 'right',
    'width' => '48',
])

@php
    $alignments = [
        'left' => 'origin-top-left left-0',
        'right' => 'origin-top-right right-0',
    ];

    $widths = [
        '48' => 'w-48',
        '56' => 'w-56',
        '64' => 'w-64',
    ];

    $alignClass = $alignments[$align] ?? $alignments['right'];
    $widthClass = $widths[$width] ?? $widths['48'];
@endphp

<div class="relative" x-data="{ open: false }" @click.away="open = false">
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $widthClass }} {{ $alignClass }} rounded-lg bg-white shadow-elevated border border-gray-100 py-1"
        x-cloak
    >
        {{ $slot }}
    </div>
</div>
