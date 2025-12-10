@props([
    'clickable' => false,
])

<tr {{ $attributes->merge([
    'class' => 'border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150' .
    ($clickable ? ' cursor-pointer' : '')
]) }}>
    {{ $slot }}
</tr>
