@props([
    'currentPage' => 1,
    'totalItems' => 0,
    'perPage' => 50,
])

@php
    $start = (($currentPage - 1) * $perPage) + 1;
    $end = min($currentPage * $perPage, $totalItems);
    $totalPages = ceil($totalItems / $perPage);
@endphp

<div class="flex items-center justify-end gap-4 py-4">
    <span class="text-sm text-gray-600">
        {{ $start }}-{{ $end }} de {{ $totalItems }}
    </span>

    <div class="flex items-center gap-2">
        <button
            type="button"
            wire:click="previousPage"
            @if($currentPage <= 1) disabled @endif
            class="p-2 rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
        >
            <x-icons.arrow-left class="w-4 h-4" />
        </button>

        <button
            type="button"
            wire:click="nextPage"
            @if($currentPage >= $totalPages) disabled @endif
            class="p-2 rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
        >
            <x-icons.arrow-right class="w-4 h-4" />
        </button>
    </div>
</div>
