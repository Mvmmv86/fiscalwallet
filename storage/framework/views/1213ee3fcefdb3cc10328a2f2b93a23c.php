<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => null,
    'placeholder' => 'Selecione...',
    'error' => null,
    'options' => [],
    'selected' => null,
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
    'label' => null,
    'placeholder' => 'Selecione...',
    'error' => null,
    'options' => [],
    'selected' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="w-full">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($label): ?>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            <?php echo e($label); ?>

        </label>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="relative">
        <select
            <?php echo e($attributes->merge([
                'class' => 'w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 transition-colors duration-200 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 focus:bg-white appearance-none cursor-pointer pr-10' .
                ($error ? ' border-danger-500 focus:border-danger-500 focus:ring-danger-100' : '')
            ])); ?>

        >
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($placeholder): ?>
                <option value="" disabled <?php echo e(!$selected ? 'selected' : ''); ?>><?php echo e($placeholder); ?></option>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($value); ?>" <?php echo e($selected == $value ? 'selected' : ''); ?>>
                    <?php echo e($label); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo e($slot); ?>

        </select>

        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <?php if (isset($component)) { $__componentOriginalfb5ab559e4014313073efeb5cdff727a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5ab559e4014313073efeb5cdff727a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chevron-down','data' => ['class' => 'w-5 h-5 text-gray-400']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 text-gray-400']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb5ab559e4014313073efeb5cdff727a)): ?>
<?php $attributes = $__attributesOriginalfb5ab559e4014313073efeb5cdff727a; ?>
<?php unset($__attributesOriginalfb5ab559e4014313073efeb5cdff727a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb5ab559e4014313073efeb5cdff727a)): ?>
<?php $component = $__componentOriginalfb5ab559e4014313073efeb5cdff727a; ?>
<?php unset($__componentOriginalfb5ab559e4014313073efeb5cdff727a); ?>
<?php endif; ?>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($error): ?>
        <p class="mt-1.5 text-xs text-danger-500"><?php echo e($error); ?></p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components/ui/select.blade.php ENDPATH**/ ?>