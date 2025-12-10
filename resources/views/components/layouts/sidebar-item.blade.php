@props([
    'href' => '#',
    'icon' => null,
    'active' => false,
])

<a
    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => $active
            ? 'flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary-50 text-primary-600 font-medium'
            : 'flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-sidebar-hover transition-colors duration-200'
    ]) }}
>
    @if($icon)
        <x-dynamic-component :component="'icons.' . $icon" class="w-5 h-5" />
    @endif

    <span>{{ $slot }}</span>

    @if($active)
        <x-icons.chevron-right class="w-4 h-4 ml-auto" />
    @endif
</a>
