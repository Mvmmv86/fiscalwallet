<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => '',
    'value' => '',
    'variant' => 'default',
    'icon' => null,
    'info' => null,
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
    'title' => '',
    'value' => '',
    'variant' => 'default',
    'icon' => null,
    'info' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $variants = [
        'default' => 'bg-white border border-gray-100',
        'primary' => 'bg-gradient-to-r from-primary-600 to-primary-500 text-white',
        'success' => 'bg-white border border-gray-100',
        'danger' => 'bg-white border border-gray-100',
    ];

    $iconBgs = [
        'default' => 'bg-gray-100',
        'primary' => 'bg-white/20',
        'success' => 'bg-success-100',
        'danger' => 'bg-danger-100',
    ];

    $iconColors = [
        'default' => 'text-gray-600',
        'primary' => 'text-white',
        'success' => 'text-success-600',
        'danger' => 'text-danger-600',
    ];

    $titleColors = [
        'default' => 'text-gray-600',
        'primary' => 'text-white/90',
        'success' => 'text-gray-600',
        'danger' => 'text-gray-600',
    ];

    $valueColors = [
        'default' => 'text-gray-900',
        'primary' => 'text-white',
        'success' => 'text-gray-900',
        'danger' => 'text-gray-900',
    ];

    $variantClass = $variants[$variant] ?? $variants['default'];
    $iconBgClass = $iconBgs[$variant] ?? $iconBgs['default'];
    $iconColorClass = $iconColors[$variant] ?? $iconColors['default'];
    $titleColorClass = $titleColors[$variant] ?? $titleColors['default'];
    $valueColorClass = $valueColors[$variant] ?? $valueColors['default'];
?>

<div <?php echo e($attributes->merge(['class' => "rounded-2xl p-6 shadow-card {$variantClass}"])); ?>>
    <div class="flex items-start justify-between">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
            <div class="p-2 rounded-lg <?php echo e($iconBgClass); ?>">
                <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => 'icons.' . $icon] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 '.e($iconColorClass).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($info): ?>
            <button type="button" class="p-1 rounded-full hover:bg-black/5 transition-colors" title="<?php echo e($info); ?>">
                <?php if (isset($component)) { $__componentOriginaldfb2872b9aeea0f6148ef7a304b1dcce = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldfb2872b9aeea0f6148ef7a304b1dcce = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.info','data' => ['class' => 'w-4 h-4 '.e($variant === 'primary' ? 'text-white/70' : 'text-gray-400').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.info'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 '.e($variant === 'primary' ? 'text-white/70' : 'text-gray-400').'']); ?>
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
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="mt-4">
        <p class="text-sm font-medium <?php echo e($titleColorClass); ?>"><?php echo e($title); ?></p>
        <p class="text-2xl font-bold mt-1 <?php echo e($valueColorClass); ?>"><?php echo e($value); ?></p>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($footer)): ?>
            <div class="mt-2">
                <?php echo e($footer); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components/ui/metric-card.blade.php ENDPATH**/ ?>