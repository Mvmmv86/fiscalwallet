@props([
    'label' => null,
    'error' => null,
    'hint' => null,
    'rows' => 4,
])

<div>
    @if($label)
        <label class="block text-sm font-medium text-gray-700 mb-1.5">
            {{ $label }}
        </label>
    @endif

    <textarea
        rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-3 bg-white border rounded-lg text-sm placeholder-gray-400 transition-colors resize-none focus:outline-none focus:ring-2 ' .
                ($error
                    ? 'border-danger-500 focus:border-danger-500 focus:ring-danger-100'
                    : 'border-gray-200 focus:border-primary-500 focus:ring-primary-100')
        ]) }}
    >{{ $slot }}</textarea>

    @if($error)
        <p class="mt-1.5 text-sm text-danger-500">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1.5 text-sm text-gray-500">{{ $hint }}</p>
    @endif
</div>
