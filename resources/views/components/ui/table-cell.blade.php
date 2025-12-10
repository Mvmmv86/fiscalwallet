@props([
    'align' => 'left',
])

@php
    $alignments = [
        'left' => 'text-left',
        'center' => 'text-center',
        'right' => 'text-right',
    ];

    $alignClass = $alignments[$align] ?? $alignments['left'];
@endphp

<td {{ $attributes->merge(['class' => "px-4 py-4 text-sm text-gray-900 {$alignClass}"]) }}>
    {{ $slot }}
</td>
