@props([
    'periods' => ['1D', '1S', '1M', '1A', 'Tudo'],
    'selected' => 'Tudo',
    'wireModel' => null,
])

<div {{ $attributes->merge(['class' => 'flex items-center gap-1']) }}>
    @foreach($periods as $period)
        <button
            type="button"
            @if($wireModel)
                wire:click="$set('{{ $wireModel }}', '{{ $period }}')"
            @endif
            class="px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
                {{ $selected === $period
                    ? 'bg-primary-600 text-white'
                    : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
                }}"
        >
            {{ $period }}
        </button>
    @endforeach
</div>
