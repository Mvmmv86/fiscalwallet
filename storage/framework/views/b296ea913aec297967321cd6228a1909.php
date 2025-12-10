<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'steps' => [],
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
    'steps' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>



<div <?php echo e($attributes->merge(['class' => 'space-y-3'])); ?>>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $status = $step['status'] ?? 'pending';
            $label = $step['label'] ?? '';
        ?>

        <div class="flex items-center gap-3">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status === 'completed'): ?>
                <div class="flex-shrink-0 w-5 h-5 rounded-full bg-success-500 flex items-center justify-center">
                    <?php if (isset($component)) { $__componentOriginald437fe0064eab6d7fb2abdae5ed6f550 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald437fe0064eab6d7fb2abdae5ed6f550 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.check','data' => ['class' => 'w-3 h-3 text-white']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3 h-3 text-white']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald437fe0064eab6d7fb2abdae5ed6f550)): ?>
<?php $attributes = $__attributesOriginald437fe0064eab6d7fb2abdae5ed6f550; ?>
<?php unset($__attributesOriginald437fe0064eab6d7fb2abdae5ed6f550); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald437fe0064eab6d7fb2abdae5ed6f550)): ?>
<?php $component = $__componentOriginald437fe0064eab6d7fb2abdae5ed6f550; ?>
<?php unset($__componentOriginald437fe0064eab6d7fb2abdae5ed6f550); ?>
<?php endif; ?>
                </div>
                <span class="text-sm text-gray-900"><?php echo e($label); ?></span>
            <?php elseif($status === 'loading'): ?>
                <div class="flex-shrink-0">
                    <?php if (isset($component)) { $__componentOriginal7ee43febc033d8a87ae157694e6933ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ee43febc033d8a87ae157694e6933ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.spinner','data' => ['size' => 'md','color' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md','color' => 'primary']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7ee43febc033d8a87ae157694e6933ee)): ?>
<?php $attributes = $__attributesOriginal7ee43febc033d8a87ae157694e6933ee; ?>
<?php unset($__attributesOriginal7ee43febc033d8a87ae157694e6933ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7ee43febc033d8a87ae157694e6933ee)): ?>
<?php $component = $__componentOriginal7ee43febc033d8a87ae157694e6933ee; ?>
<?php unset($__componentOriginal7ee43febc033d8a87ae157694e6933ee); ?>
<?php endif; ?>
                </div>
                <span class="text-sm text-gray-900"><?php echo e($label); ?></span>
            <?php elseif($status === 'error'): ?>
                <div class="flex-shrink-0 w-5 h-5 rounded-full bg-danger-500 flex items-center justify-center">
                    <?php if (isset($component)) { $__componentOriginal25305810f9b150b3c69b0ffa42f21251 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal25305810f9b150b3c69b0ffa42f21251 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.x','data' => ['class' => 'w-3 h-3 text-white']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.x'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-3 h-3 text-white']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal25305810f9b150b3c69b0ffa42f21251)): ?>
<?php $attributes = $__attributesOriginal25305810f9b150b3c69b0ffa42f21251; ?>
<?php unset($__attributesOriginal25305810f9b150b3c69b0ffa42f21251); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal25305810f9b150b3c69b0ffa42f21251)): ?>
<?php $component = $__componentOriginal25305810f9b150b3c69b0ffa42f21251; ?>
<?php unset($__componentOriginal25305810f9b150b3c69b0ffa42f21251); ?>
<?php endif; ?>
                </div>
                <span class="text-sm text-danger-600"><?php echo e($label); ?></span>
            <?php else: ?>
                
                <div class="flex-shrink-0 w-5 h-5 rounded-full border-2 border-gray-300"></div>
                <span class="text-sm text-gray-400"><?php echo e($label); ?></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components/ui/step-progress.blade.php ENDPATH**/ ?>