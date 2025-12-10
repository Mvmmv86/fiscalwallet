@props([
    'type' => 'text',
    'label' => null,
    'placeholder' => '',
    'error' => null,
    'icon' => null,
    'iconRight' => null,
    'hint' => null,
    'rounded' => 'lg',
    'size' => 'md',
])

@php
    $roundedClasses = [
        'lg' => 'rounded-lg',
        'full' => 'rounded-full',
        'xl' => 'rounded-xl',
        'none' => 'rounded-none',
    ];
    $roundedClass = $roundedClasses[$rounded] ?? $roundedClasses['lg'];

    $sizeClasses = [
        'xl' => 'px-5 py-4 text-base',
        'lg' => 'px-4 py-3.5 text-sm',
        'md' => 'px-4 py-3 text-sm',
        'sm' => 'px-3 py-2 text-xs',
    ];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<div class="w-full">
    @if($label)
        <label class="block text-xs font-normal text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        @if($icon)
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <x-dynamic-component :component="'icons.' . $icon" class="w-5 h-5 text-gray-400" />
            </div>
        @endif

        <input
            type="{{ $type }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge([
                'class' => 'w-full ' . $sizeClass . ' bg-[#DDD8E1] border border-[#DDD8E1] ' . $roundedClass . ' text-gray-900 placeholder-gray-400 transition-colors duration-200 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 focus:bg-white' .
                ($icon ? ' pl-12' : '') .
                ($iconRight ? ' pr-12' : '') .
                ($error ? ' border-danger-500 focus:border-danger-500 focus:ring-danger-100' : '')
            ]) }}
        />

        @if($iconRight)
            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                <x-dynamic-component :component="'icons.' . $iconRight" class="w-5 h-5 text-gray-400" />
            </div>
        @endif
    </div>

    @if($hint && !$error)
        <p class="mt-1.5 text-xs text-gray-500">{{ $hint }}</p>
    @endif

    @if($error)
        <p class="mt-1.5 text-xs text-danger-500">{{ $error }}</p>
    @endif
</div>
