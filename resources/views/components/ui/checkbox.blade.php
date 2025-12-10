@props([
    'label' => null,
    'checked' => false,
])

<label class="inline-flex items-center gap-2 cursor-pointer">
    <input
        type="checkbox"
        {{ $checked ? 'checked' : '' }}
        {{ $attributes->merge([
            'class' => 'w-4 h-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 focus:ring-offset-0 cursor-pointer'
        ]) }}
    />
    @if($label)
        <span class="text-sm text-gray-700">{{ $label }}</span>
    @endif
</label>
