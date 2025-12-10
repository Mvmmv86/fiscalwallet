<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => '',
    'value' => '',
    'info' => null,
    'border' => true,
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
    'label' => '',
    'value' => '',
    'info' => null,
    'border' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div <?php echo e($attributes->merge(['class' => $border ? 'pb-4 border-b border-gray-100' : 'pb-4'])); ?>>
    <div class="flex items-center gap-1 mb-2">
        <span class="text-sm text-gray-600"><?php echo e($label); ?></span>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($info): ?>
            <button type="button" title="<?php echo e($info); ?>" class="text-gray-400 hover:text-gray-500">
                <?php if (isset($component)) { $__componentOriginaldfb2872b9aeea0f6148ef7a304b1dcce = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldfb2872b9aeea0f6148ef7a304b1dcce = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.info','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.info'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldfb2872b9aeea0f6148ef7a304b1dcce)): ?>
<?php $attributes = $__attributesOriginaldfb2872b9aeea0f6148ef7a304b1dcce; ?>
<?php unset($__attributesOriginaldfb2872b9aeea0f6148ef7a304b1dcce); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldfb2872b9aeea0f6148ef7a304b1dcce)): ?>
<?php $component = $__componentOriginaldfb2872b9aeea0f6148ef7a304b1dcce; ?>
<?php unset($__componentOriginaldfb2872b9aeea0f6148ef7a304b1dcce); ?>
<?php endif; ?>
            </button>
        <?php else: ?>
            <?php if (isset($component)) { $__componentOriginaldfb2872b9aeea0f6148ef7a304b1dcce = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldfb2872b9aeea0f6148ef7a304b1dcce = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.info','data' => ['class' => 'w-4 h-4 text-gray-400']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.info'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 text-gray-400']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldfb2872b9aeea0f6148ef7a304b1dcce)): ?>
<?php $attributes = $__attributesOriginaldfb2872b9aeea0f6148ef7a304b1dcce; ?>
<?php unset($__attributesOriginaldfb2872b9aeea0f6148ef7a304b1dcce); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldfb2872b9aeea0f6148ef7a304b1dcce)): ?>
<?php $component = $__componentOriginaldfb2872b9aeea0f6148ef7a304b1dcce; ?>
<?php unset($__componentOriginaldfb2872b9aeea0f6148ef7a304b1dcce); ?>
<?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <p class="text-lg font-semibold text-gray-900">
        <?php echo e($value); ?>

    </p>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($slot) && !empty(trim($slot))): ?>
        <div class="mt-2">
            <?php echo e($slot); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components/ui/summary-item.blade.php ENDPATH**/ ?>