@props([
    'label' => '',
    'value' => '',
    'info' => null,
    'border' => true,
])

<div {{ $attributes->merge(['class' => $border ? 'pb-4 border-b border-gray-100' : 'pb-4']) }}>
    <div class="flex items-center gap-1 mb-2">
        <span class="text-sm text-gray-600">{{ $label }}</span>
        @if($info)
            <button type="button" title="{{ $info }}" class="text-gray-400 hover:text-gray-500">
                <x-icons.info class="w-4 h-4" />
            </button>
        @else
            <x-icons.info class="w-4 h-4 text-gray-400" />
        @endif
    </div>
    <p class="text-lg font-semibold text-gray-900">
        {{ $value }}
    </p>

    @if(isset($slot) && !empty(trim($slot)))
        <div class="mt-2">
            {{ $slot }}
        </div>
    @endif
</div>
