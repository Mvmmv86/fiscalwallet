<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'align' => 'right',
    'width' => '48',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'align' => 'right',
    'width' => '48',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $alignments = [
        'left' => 'origin-top-left left-0',
        'right' => 'origin-top-right right-0',
    ];

    $widths = [
        '48' => 'w-48',
        '56' => 'w-56',
        '64' => 'w-64',
    ];

    $alignClass = $alignments[$align] ?? $alignments['right'];
    $widthClass = $widths[$width] ?? $widths['48'];
?>

<div class="relative" x-data="{ open: false }" @click.away="open = false">
    <div @click="open = !open">
        <?php echo e($trigger); ?>

    </div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-50 mt-2 <?php echo e($widthClass); ?> <?php echo e($alignClass); ?> rounded-lg bg-white shadow-elevated border border-gray-100 py-1"
        x-cloak
    >
        <?php echo e($slot); ?>

    </div>
</div>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components/ui/dropdown.blade.php ENDPATH**/ ?>