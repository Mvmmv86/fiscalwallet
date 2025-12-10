@props([
    'href' => null,
    'danger' => false,
])

@php
    $classes = 'flex items-center gap-2 w-full px-4 py-2 text-sm text-left transition-colors ' .
        ($danger ? 'text-danger-600 hover:bg-danger-50' : 'text-gray-700 hover:bg-gray-50');
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
