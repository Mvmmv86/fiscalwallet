@props([
    'title' => null,
    'name' => 'slide-over',
    'width' => 'md',
    'showClearButton' => false,
])

@php
    $widths = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
    ];
    $widthClass = $widths[$width] ?? $widths['md'];
@endphp

<div
    x-data="{ show: false }"
    x-show="show"
    x-on:open-slide-over.window="if ($event.detail === '{{ $name }}') show = true"
    x-on:close-slide-over.window="if ($event.detail === '{{ $name }}') show = false"
    x-on:keydown.escape.window="show = false"
    x-cloak
    class="fixed inset-0 z-50 overflow-hidden"
    aria-labelledby="slide-over-title"
    role="dialog"
    aria-modal="true"
>
    <!-- Overlay -->
    <div
        x-show="show"
        x-transition:enter="ease-in-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in-out duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 transition-opacity"
        x-on:click="show = false"
    ></div>

    <!-- Panel -->
    <div class="fixed inset-y-0 right-0 flex max-w-full">
        <div
            x-show="show"
            x-transition:enter="transform transition ease-in-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in-out duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="w-screen {{ $widthClass }}"
        >
            <div class="flex h-full flex-col bg-white shadow-xl">
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $title }}</h2>
                    <div class="flex items-center gap-3">
                        @if($showClearButton)
                            <button
                                type="button"
                                x-on:click="$dispatch('clear-filters')"
                                class="text-sm text-primary-600 hover:text-primary-700 transition-colors"
                            >
                                Limpar tudo
                            </button>
                        @endif
                        <button
                            type="button"
                            x-on:click="show = false"
                            class="p-1 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition-colors"
                        >
                            <x-icons.x class="w-5 h-5" />
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="flex-1 overflow-y-auto px-6 py-4">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                @if(isset($footer))
                    <div class="border-t border-gray-100 px-6 py-4">
                        {{ $footer }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
