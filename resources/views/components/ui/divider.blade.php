@props([
    'text' => null,
])

@if($text)
    <div {{ $attributes->merge(['class' => 'flex items-center gap-4']) }}>
        <div class="flex-1 h-px bg-gray-200"></div>
        <span class="text-sm text-gray-500">{{ $text }}</span>
        <div class="flex-1 h-px bg-gray-200"></div>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'h-px bg-gray-200']) }}></div>
@endif
