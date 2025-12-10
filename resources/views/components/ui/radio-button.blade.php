@props([
    'name' => '',
    'value' => '',
    'label' => '',
    'checked' => false,
    'variant' => 'default',
])

@php
    $variants = [
        'default' => 'bg-gray-100 hover:bg-gray-200 text-gray-700',
        'selected' => 'bg-gray-200 text-gray-900',
    ];

    $variantClass = $checked ? $variants['selected'] : $variants['default'];
@endphp

<label {{ $attributes->merge(['class' => 'block cursor-pointer']) }}>
    <input
        type="radio"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        class="sr-only peer"
    />
    <div class="w-full px-4 py-3 rounded-lg text-sm text-center font-medium transition-colors {{ $variantClass }} peer-checked:bg-gray-200 peer-checked:text-gray-900">
        {{ $label }}
    </div>
</label>
