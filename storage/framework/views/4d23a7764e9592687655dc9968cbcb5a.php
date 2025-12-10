<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'periods' => ['1D', '1S', '1M', '1A', 'Tudo'],
    'selected' => 'Tudo',
    'wireModel' => null,
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
    'periods' => ['1D', '1S', '1M', '1A', 'Tudo'],
    'selected' => 'Tudo',
    'wireModel' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div <?php echo e($attributes->merge(['class' => 'flex items-center gap-1'])); ?>>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $periods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $period): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button
            type="button"
            <?php if($wireModel): ?>
                wire:click="$set('<?php echo e($wireModel); ?>', '<?php echo e($period); ?>')"
            <?php endif; ?>
            class="px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
                <?php echo e($selected === $period
                    ? 'bg-primary-600 text-white'
                    : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>"
        >
            <?php echo e($period); ?>

        </button>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components/ui/period-filter.blade.php ENDPATH**/ ?>