<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => '',
    'value' => 0,
    'color' => '#9333EA',
    'percentage' => null,
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
    'name' => '',
    'value' => 0,
    'color' => '#9333EA',
    'percentage' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div <?php echo e($attributes->merge(['class' => 'flex items-center justify-between py-1'])); ?>>
    <div class="flex items-center gap-2">
        <span class="w-2 h-2 rounded-full flex-shrink-0" style="background-color: <?php echo e($color); ?>"></span>
        <span class="text-sm text-gray-600"><?php echo e($name); ?></span>
    </div>
    <div class="flex items-center gap-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($percentage !== null): ?>
            <span class="text-xs text-gray-400"><?php echo e(number_format($percentage, 1)); ?>%</span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <span class="text-sm font-medium text-gray-900">
            R$ <?php echo e(number_format($value, 2, ',', '.')); ?>

        </span>
    </div>
</div>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components/ui/asset-list-item.blade.php ENDPATH**/ ?>