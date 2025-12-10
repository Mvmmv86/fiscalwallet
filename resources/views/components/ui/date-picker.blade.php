@props([
    'year' => null,
    'month' => null,
    'showMonth' => false,
    'wireModelYear' => null,
    'wireModelMonth' => null,
])

@php
    $displayYear = $year ?? date('Y');
    $displayMonth = $month ?? null;

    $months = [
        '01' => 'Jan', '02' => 'Fev', '03' => 'Mar', '04' => 'Abr',
        '05' => 'Mai', '06' => 'Jun', '07' => 'Jul', '08' => 'Ago',
        '09' => 'Set', '10' => 'Out', '11' => 'Nov', '12' => 'Dez',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
    <div class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg">
        <span class="text-sm font-medium text-gray-900">
            {{ $displayYear }}@if($showMonth && $displayMonth)/{{ $displayMonth }}@endif
        </span>
        <x-icons.calendar class="w-4 h-4 text-gray-500" />
    </div>

    @if($showMonth)
        <div class="relative" x-data="{ open: false }">
            <button
                type="button"
                @click="open = !open"
                class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition-colors"
            >
                {{ $months[$displayMonth] ?? 'Mês' }}
                <x-icons.chevron-down class="w-4 h-4 text-gray-400" />
            </button>

            <div
                x-show="open"
                @click.away="open = false"
                x-transition
                class="absolute z-10 mt-1 w-32 bg-white border border-gray-200 rounded-lg shadow-elevated py-1"
                x-cloak
            >
                @foreach($months as $num => $name)
                    <button
                        type="button"
                        @if($wireModelMonth)
                            wire:click="$set('{{ $wireModelMonth }}', '{{ $num }}')"
                        @endif
                        @click="open = false"
                        class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-50 {{ $displayMonth === $num ? 'bg-primary-50 text-primary-600' : '' }}"
                    >
                        {{ $name }}
                    </button>
                @endforeach
            </div>
        </div>
    @endif
</div>
