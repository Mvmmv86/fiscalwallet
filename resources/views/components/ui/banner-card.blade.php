@props([
    'title' => '',
    'description' => '',
    'image' => null,
    'dark' => true,
])

@php
    $bgClass = $dark ? 'bg-gradient-to-br from-gray-900 to-gray-800' : 'bg-white border border-gray-100';
    $textClass = $dark ? 'text-white' : 'text-gray-900';
    $descClass = $dark ? 'text-white/90' : 'text-gray-600';
@endphp

<div {{ $attributes->merge(['class' => "rounded-2xl overflow-hidden {$bgClass} p-6 flex flex-col justify-between h-full min-h-[300px]"]) }}>
    <div>
        @if($title)
            <div class="flex items-center gap-2 mb-4">
                <span class="{{ $textClass }} font-bold text-xl">{{ $title }}</span>
            </div>
        @endif

        @if($description)
            <p class="{{ $descClass }} text-lg leading-relaxed">
                {{ $description }}
            </p>
        @endif

        {{ $slot }}
    </div>

    @if($image)
        <div class="mt-auto pt-4">
            <img
                src="{{ $image }}"
                alt="{{ $title }}"
                class="w-full h-32 object-cover rounded-lg"
            />
        </div>
    @endif
</div>
