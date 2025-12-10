@props([
    'label' => null,
    'placeholder' => 'Selecione...',
    'error' => null,
    'options' => [],
    'selected' => null,
])

<div class="w-full">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 mb-2">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <select
            {{ $attributes->merge([
                'class' => 'w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 transition-colors duration-200 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 focus:bg-white appearance-none cursor-pointer pr-10' .
                ($error ? ' border-danger-500 focus:border-danger-500 focus:ring-danger-100' : '')
            ]) }}
        >
            @if($placeholder)
                <option value="" disabled {{ !$selected ? 'selected' : '' }}>{{ $placeholder }}</option>
            @endif

            @foreach($options as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach

            {{ $slot }}
        </select>

        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <x-icons.chevron-down class="w-5 h-5 text-gray-400" />
        </div>
    </div>

    @if($error)
        <p class="mt-1.5 text-xs text-danger-500">{{ $error }}</p>
    @endif
</div>
