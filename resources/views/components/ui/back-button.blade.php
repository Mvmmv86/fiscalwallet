@props([
    'href' => null,
])

@php
    $classes = 'p-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors inline-flex items-center justify-center';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        <x-icons.arrow-left class="w-4 h-4" />
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
        <x-icons.arrow-left class="w-4 h-4" />
    </button>
@endif
