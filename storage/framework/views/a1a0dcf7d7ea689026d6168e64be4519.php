<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fiscal Wallet - Preview de Componentes</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-background min-h-screen p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <div class="flex items-center gap-4 mb-4">
                <?php if (isset($component)) { $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.logo','data' => ['size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'lg']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $attributes = $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $component = $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
            </div>
            <h1 class="text-display text-gray-900 mb-2">Fiscal Wallet</h1>
            <p class="text-body-lg text-gray-600">Preview de todos os componentes do Design System</p>
        </div>

        <!-- LOGO -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Logo</h2>

            <div class="flex flex-wrap items-center gap-8">
                <div class="flex flex-col items-center gap-2">
                    <?php if (isset($component)) { $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.logo','data' => ['size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $attributes = $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $component = $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
                    <span class="text-xs text-gray-500">Small</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <?php if (isset($component)) { $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.logo','data' => ['size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $attributes = $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $component = $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
                    <span class="text-xs text-gray-500">Medium</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <?php if (isset($component)) { $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.logo','data' => ['size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'lg']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $attributes = $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $component = $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
                    <span class="text-xs text-gray-500">Large</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <?php if (isset($component)) { $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.logo','data' => ['size' => 'xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'xl']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $attributes = $__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__attributesOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6)): ?>
<?php $component = $__componentOriginalc9b691e47e4aeaac2320d6494f20beb6; ?>
<?php unset($__componentOriginalc9b691e47e4aeaac2320d6494f20beb6); ?>
<?php endif; ?>
                    <span class="text-xs text-gray-500">Extra Large</span>
                </div>
            </div>
        </section>

        <!-- BACK BUTTON & ICON BUTTON -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Back Button & Icon Buttons</h2>

            <div class="space-y-6">
                <!-- Back Button -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Back Button</h3>
                    <div class="flex items-center gap-4">
                        <?php if (isset($component)) { $__componentOriginal0a6faeac6c557239eed0167385754ebb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a6faeac6c557239eed0167385754ebb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.back-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.back-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0a6faeac6c557239eed0167385754ebb)): ?>
<?php $attributes = $__attributesOriginal0a6faeac6c557239eed0167385754ebb; ?>
<?php unset($__attributesOriginal0a6faeac6c557239eed0167385754ebb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0a6faeac6c557239eed0167385754ebb)): ?>
<?php $component = $__componentOriginal0a6faeac6c557239eed0167385754ebb; ?>
<?php unset($__componentOriginal0a6faeac6c557239eed0167385754ebb); ?>
<?php endif; ?>
                        <span class="text-gray-500 text-sm">Botão de voltar</span>
                    </div>
                </div>

                <!-- Icon Buttons -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Icon Buttons</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal0b13408463faa13a13ad37dce6dd70f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon-button','data' => ['icon' => 'bell','variant' => 'neutral']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'bell','variant' => 'neutral']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $attributes = $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $component = $__componentOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
                            <span class="text-xs text-gray-500">Neutral</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal0b13408463faa13a13ad37dce6dd70f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon-button','data' => ['icon' => 'bell','variant' => 'neutral','badge' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'bell','variant' => 'neutral','badge' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $attributes = $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $component = $__componentOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
                            <span class="text-xs text-gray-500">Com badge</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal0b13408463faa13a13ad37dce6dd70f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon-button','data' => ['icon' => 'plus','variant' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'plus','variant' => 'primary']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $attributes = $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $component = $__componentOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
                            <span class="text-xs text-gray-500">Primary</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal0b13408463faa13a13ad37dce6dd70f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon-button','data' => ['icon' => 'more-vertical','variant' => 'ghost']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'more-vertical','variant' => 'ghost']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $attributes = $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $component = $__componentOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
                            <span class="text-xs text-gray-500">Ghost</span>
                        </div>
                    </div>
                </div>

                <!-- Icon Button Sizes -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Tamanhos</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal0b13408463faa13a13ad37dce6dd70f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon-button','data' => ['icon' => 'bell','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'bell','size' => 'sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $attributes = $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $component = $__componentOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
                            <span class="text-xs text-gray-500">Small</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal0b13408463faa13a13ad37dce6dd70f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon-button','data' => ['icon' => 'bell','size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'bell','size' => 'md']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $attributes = $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $component = $__componentOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
                            <span class="text-xs text-gray-500">Medium</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal0b13408463faa13a13ad37dce6dd70f7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.icon-button','data' => ['icon' => 'bell','size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'bell','size' => 'lg']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $attributes = $__attributesOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__attributesOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7)): ?>
<?php $component = $__componentOriginal0b13408463faa13a13ad37dce6dd70f7; ?>
<?php unset($__componentOriginal0b13408463faa13a13ad37dce6dd70f7); ?>
<?php endif; ?>
                            <span class="text-xs text-gray-500">Large</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DIVIDER -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Divider</h2>

            <div class="space-y-6 max-w-md">
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Simples</h3>
                    <?php if (isset($component)) { $__componentOriginal5010c7b692c0c50f7e63d4192488f108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5010c7b692c0c50f7e63d4192488f108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.divider','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.divider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5010c7b692c0c50f7e63d4192488f108)): ?>
<?php $attributes = $__attributesOriginal5010c7b692c0c50f7e63d4192488f108; ?>
<?php unset($__attributesOriginal5010c7b692c0c50f7e63d4192488f108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5010c7b692c0c50f7e63d4192488f108)): ?>
<?php $component = $__componentOriginal5010c7b692c0c50f7e63d4192488f108; ?>
<?php unset($__componentOriginal5010c7b692c0c50f7e63d4192488f108); ?>
<?php endif; ?>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Com texto</h3>
                    <?php if (isset($component)) { $__componentOriginal5010c7b692c0c50f7e63d4192488f108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5010c7b692c0c50f7e63d4192488f108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.divider','data' => ['text' => 'ou']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.divider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['text' => 'ou']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5010c7b692c0c50f7e63d4192488f108)): ?>
<?php $attributes = $__attributesOriginal5010c7b692c0c50f7e63d4192488f108; ?>
<?php unset($__attributesOriginal5010c7b692c0c50f7e63d4192488f108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5010c7b692c0c50f7e63d4192488f108)): ?>
<?php $component = $__componentOriginal5010c7b692c0c50f7e63d4192488f108; ?>
<?php unset($__componentOriginal5010c7b692c0c50f7e63d4192488f108); ?>
<?php endif; ?>
                </div>
            </div>
        </section>

        <!-- RADIO BUTTON -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Radio Button</h2>

            <div class="max-w-sm space-y-2">
                <?php if (isset($component)) { $__componentOriginal2b872940064962925e68f9767df4ff66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b872940064962925e68f9767df4ff66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.radio-button','data' => ['name' => 'importacao','value' => 'automatica','label' => 'Importação automática','checked' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.radio-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'importacao','value' => 'automatica','label' => 'Importação automática','checked' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b872940064962925e68f9767df4ff66)): ?>
<?php $attributes = $__attributesOriginal2b872940064962925e68f9767df4ff66; ?>
<?php unset($__attributesOriginal2b872940064962925e68f9767df4ff66); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b872940064962925e68f9767df4ff66)): ?>
<?php $component = $__componentOriginal2b872940064962925e68f9767df4ff66; ?>
<?php unset($__componentOriginal2b872940064962925e68f9767df4ff66); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal2b872940064962925e68f9767df4ff66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b872940064962925e68f9767df4ff66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.radio-button','data' => ['name' => 'importacao','value' => 'manual','label' => 'Importação manual']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.radio-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'importacao','value' => 'manual','label' => 'Importação manual']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b872940064962925e68f9767df4ff66)): ?>
<?php $attributes = $__attributesOriginal2b872940064962925e68f9767df4ff66; ?>
<?php unset($__attributesOriginal2b872940064962925e68f9767df4ff66); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b872940064962925e68f9767df4ff66)): ?>
<?php $component = $__componentOriginal2b872940064962925e68f9767df4ff66; ?>
<?php unset($__componentOriginal2b872940064962925e68f9767df4ff66); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- BANNER CARD -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Banner Card</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Banner Anuncio (MBR Invest)</h3>
                    <div class="grid grid-cols-2 gap-4 items-start">
                        
                        <div>
                            <p class="text-xs text-gray-500 mb-2">Quadrado</p>
                            <div class="rounded-xl overflow-hidden max-w-[180px]">
                                <img
                                    src="<?php echo e(asset('assets/images/source_banner anuncio.png')); ?>"
                                    alt="Banner Anuncio Quadrado"
                                    class="w-full h-auto object-cover"
                                />
                            </div>
                        </div>

                        
                        <div>
                            <p class="text-xs text-gray-500 mb-2">Retangular</p>
                            <div class="rounded-xl overflow-hidden">
                                <img
                                    src="<?php echo e(asset('assets/images/banner-anuncio-Rectangle 56.png')); ?>"
                                    alt="Banner Anuncio Retangular"
                                    class="w-full h-auto object-cover"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Banner Login</h3>
                    <div class="grid grid-cols-2 gap-4 items-start">
                        
                        <div>
                            <p class="text-xs text-gray-500 mb-2">Quadrado</p>
                            <div class="rounded-xl overflow-hidden max-w-[180px]">
                                <img
                                    src="<?php echo e(asset('assets/images/banner-login.png')); ?>"
                                    alt="Banner Login Quadrado"
                                    class="w-full h-auto object-cover"
                                />
                            </div>
                        </div>

                        
                        <div>
                            <p class="text-xs text-gray-500 mb-2">Retangular</p>
                            <div class="rounded-xl overflow-hidden">
                                <img
                                    src="<?php echo e(asset('assets/images/banner-login-retangulo.png')); ?>"
                                    alt="Banner Login Retangular"
                                    class="w-full h-auto object-cover"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- BUTTONS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Buttons</h2>

            <div class="space-y-6">
                <!-- Variants -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Variantes</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary']); ?>Primary <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'secondary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary']); ?>Secondary <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'neutral']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'neutral']); ?>Neutral <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'danger']); ?>Danger <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'success']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'success']); ?>Success <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'ghost']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost']); ?>Ghost <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                    </div>
                </div>

                <!-- Sizes -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Tamanhos</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'sm']); ?>Small <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md']); ?>Medium <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg']); ?>Large <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','size' => 'xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'xl']); ?>Extra Large <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                    </div>
                </div>

                <!-- With Icons -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Com Ícones</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','icon' => 'plus']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','icon' => 'plus']); ?>Adicionar <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'secondary','icon' => 'download']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','icon' => 'download']); ?>Exportar <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'neutral','icon' => 'refresh']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'neutral','icon' => 'refresh']); ?>Sincronizar <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                    </div>
                </div>

                <!-- Disabled -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Desabilitado</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','disabled' => true]); ?>Desabilitado <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- INPUTS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Inputs</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php if (isset($component)) { $__componentOriginal65bd7e7dbd93cec773ad6501ce127e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.input','data' => ['label' => 'Input padrão','placeholder' => 'Digite algo...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Input padrão','placeholder' => 'Digite algo...']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46)): ?>
<?php $attributes = $__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46; ?>
<?php unset($__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal65bd7e7dbd93cec773ad6501ce127e46)): ?>
<?php $component = $__componentOriginal65bd7e7dbd93cec773ad6501ce127e46; ?>
<?php unset($__componentOriginal65bd7e7dbd93cec773ad6501ce127e46); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal65bd7e7dbd93cec773ad6501ce127e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.input','data' => ['label' => 'Com ícone','placeholder' => 'Pesquisar...','icon' => 'search']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Com ícone','placeholder' => 'Pesquisar...','icon' => 'search']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46)): ?>
<?php $attributes = $__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46; ?>
<?php unset($__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal65bd7e7dbd93cec773ad6501ce127e46)): ?>
<?php $component = $__componentOriginal65bd7e7dbd93cec773ad6501ce127e46; ?>
<?php unset($__componentOriginal65bd7e7dbd93cec773ad6501ce127e46); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal65bd7e7dbd93cec773ad6501ce127e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.input','data' => ['label' => 'Com erro','placeholder' => 'Email inválido','error' => 'Este campo é obrigatório']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Com erro','placeholder' => 'Email inválido','error' => 'Este campo é obrigatório']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46)): ?>
<?php $attributes = $__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46; ?>
<?php unset($__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal65bd7e7dbd93cec773ad6501ce127e46)): ?>
<?php $component = $__componentOriginal65bd7e7dbd93cec773ad6501ce127e46; ?>
<?php unset($__componentOriginal65bd7e7dbd93cec773ad6501ce127e46); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal65bd7e7dbd93cec773ad6501ce127e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.input','data' => ['label' => 'Com dica','placeholder' => 'Sua API Key','hint' => 'Encontre sua API Key nas configurações da Binance']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Com dica','placeholder' => 'Sua API Key','hint' => 'Encontre sua API Key nas configurações da Binance']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46)): ?>
<?php $attributes = $__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46; ?>
<?php unset($__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal65bd7e7dbd93cec773ad6501ce127e46)): ?>
<?php $component = $__componentOriginal65bd7e7dbd93cec773ad6501ce127e46; ?>
<?php unset($__componentOriginal65bd7e7dbd93cec773ad6501ce127e46); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- SELECT -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Select</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php if (isset($component)) { $__componentOriginal231e2c645bf8af0c5c05a5dc5a94c862 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal231e2c645bf8af0c5c05a5dc5a94c862 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.select','data' => ['label' => 'Carteira','placeholder' => 'Selecione uma carteira','options' => ['binance' => 'Binance', 'mercado_bitcoin' => 'Mercado Bitcoin', 'ftx' => 'FTX']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Carteira','placeholder' => 'Selecione uma carteira','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['binance' => 'Binance', 'mercado_bitcoin' => 'Mercado Bitcoin', 'ftx' => 'FTX'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal231e2c645bf8af0c5c05a5dc5a94c862)): ?>
<?php $attributes = $__attributesOriginal231e2c645bf8af0c5c05a5dc5a94c862; ?>
<?php unset($__attributesOriginal231e2c645bf8af0c5c05a5dc5a94c862); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal231e2c645bf8af0c5c05a5dc5a94c862)): ?>
<?php $component = $__componentOriginal231e2c645bf8af0c5c05a5dc5a94c862; ?>
<?php unset($__componentOriginal231e2c645bf8af0c5c05a5dc5a94c862); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal231e2c645bf8af0c5c05a5dc5a94c862 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal231e2c645bf8af0c5c05a5dc5a94c862 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.select','data' => ['label' => 'Com erro','placeholder' => 'Selecione...','options' => ['op1' => 'Opção 1', 'op2' => 'Opção 2'],'error' => 'Selecione uma opção']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Com erro','placeholder' => 'Selecione...','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['op1' => 'Opção 1', 'op2' => 'Opção 2']),'error' => 'Selecione uma opção']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal231e2c645bf8af0c5c05a5dc5a94c862)): ?>
<?php $attributes = $__attributesOriginal231e2c645bf8af0c5c05a5dc5a94c862; ?>
<?php unset($__attributesOriginal231e2c645bf8af0c5c05a5dc5a94c862); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal231e2c645bf8af0c5c05a5dc5a94c862)): ?>
<?php $component = $__componentOriginal231e2c645bf8af0c5c05a5dc5a94c862; ?>
<?php unset($__componentOriginal231e2c645bf8af0c5c05a5dc5a94c862); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- BADGES -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Badges</h2>

            <div class="space-y-6">
                <!-- Variants -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Variantes</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary']); ?>Primary <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'success']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'success']); ?>Success <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'danger']); ?>Danger <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'warning']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'warning']); ?>Warning <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'neutral']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'neutral']); ?>Neutral <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Status Fiscais</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'entrada']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'entrada']); ?>Entrada <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'saida']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'saida']); ?>Saída <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'saque']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'saque']); ?>Saque <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'deposito']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'deposito']); ?>Depósito <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'pendente']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'pendente']); ?>Pendente <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'isento']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'isento']); ?>Isento <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                    </div>
                </div>

                <!-- With dot -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Com indicador</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'success','dot' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'success','dot' => true]); ?>Ativo <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'danger','dot' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'danger','dot' => true]); ?>Inativo <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'warning','dot' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'warning','dot' => true]); ?>Pendente <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                    </div>
                </div>

                <!-- Sizes -->
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Tamanhos</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'primary','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'sm']); ?>Small <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'primary','size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'md']); ?>Medium <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'primary','size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'lg']); ?>Large <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- CARDS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Cards</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['title' => 'Card Simples']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Card Simples']); ?>
                    <p class="text-gray-600">Conteúdo do card com texto simples.</p>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $attributes = $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $component = $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['title' => 'Card com Subtítulo','subtitle' => 'Informação adicional']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Card com Subtítulo','subtitle' => 'Informação adicional']); ?>
                    <p class="text-gray-600">Card com título e subtítulo.</p>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $attributes = $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $component = $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['title' => 'Card com Footer']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Card com Footer']); ?>
                    <p class="text-gray-600">Card com área de footer.</p>
                     <?php $__env->slot('footer', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','size' => 'sm']); ?>Ação <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                     <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $attributes = $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $component = $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- METRIC CARDS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Metric Cards</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php if (isset($component)) { $__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.metric-card','data' => ['title' => 'Desempenho do mês','value' => 'R$ 34.000,00','variant' => 'primary','icon' => 'chart','info' => 'Desempenho total do mês']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.metric-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Desempenho do mês','value' => 'R$ 34.000,00','variant' => 'primary','icon' => 'chart','info' => 'Desempenho total do mês']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe)): ?>
<?php $attributes = $__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe; ?>
<?php unset($__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe)): ?>
<?php $component = $__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe; ?>
<?php unset($__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.metric-card','data' => ['title' => 'Ganhos','value' => 'R$ 50.000,00','variant' => 'success','icon' => 'trending-up','info' => 'Total de ganhos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.metric-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Ganhos','value' => 'R$ 50.000,00','variant' => 'success','icon' => 'trending-up','info' => 'Total de ganhos']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe)): ?>
<?php $attributes = $__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe; ?>
<?php unset($__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe)): ?>
<?php $component = $__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe; ?>
<?php unset($__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.metric-card','data' => ['title' => 'Perdas','value' => 'R$ 16.000,00','variant' => 'danger','icon' => 'trending-down','info' => 'Total de perdas']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.metric-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Perdas','value' => 'R$ 16.000,00','variant' => 'danger','icon' => 'trending-down','info' => 'Total de perdas']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe)): ?>
<?php $attributes = $__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe; ?>
<?php unset($__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe)): ?>
<?php $component = $__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe; ?>
<?php unset($__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.metric-card','data' => ['title' => 'Quantidade de operações','value' => '58','variant' => 'default','icon' => 'list','info' => 'Número de operações']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.metric-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Quantidade de operações','value' => '58','variant' => 'default','icon' => 'list','info' => 'Número de operações']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe)): ?>
<?php $attributes = $__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe; ?>
<?php unset($__attributesOriginalb1c0d43ce2b7e6614df99c318557a7fe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe)): ?>
<?php $component = $__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe; ?>
<?php unset($__componentOriginalb1c0d43ce2b7e6614df99c318557a7fe); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- PROGRESS BAR -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Progress Bar</h2>

            <div class="space-y-6 max-w-md">
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Cores</h3>
                    <div class="space-y-4">
                        <?php if (isset($component)) { $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.progress-bar','data' => ['value' => 70,'max' => 100,'color' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.progress-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => 70,'max' => 100,'color' => 'primary']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $attributes = $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $component = $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.progress-bar','data' => ['value' => 50,'max' => 100,'color' => 'success']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.progress-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => 50,'max' => 100,'color' => 'success']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $attributes = $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $component = $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.progress-bar','data' => ['value' => 30,'max' => 100,'color' => 'warning']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.progress-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => 30,'max' => 100,'color' => 'warning']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $attributes = $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $component = $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.progress-bar','data' => ['value' => 90,'max' => 100,'color' => 'danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.progress-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => 90,'max' => 100,'color' => 'danger']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $attributes = $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $component = $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
                    </div>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Tamanhos</h3>
                    <div class="space-y-4">
                        <?php if (isset($component)) { $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.progress-bar','data' => ['value' => 60,'max' => 100,'size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.progress-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => 60,'max' => 100,'size' => 'sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $attributes = $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $component = $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.progress-bar','data' => ['value' => 60,'max' => 100,'size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.progress-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => 60,'max' => 100,'size' => 'md']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $attributes = $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $component = $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.progress-bar','data' => ['value' => 60,'max' => 100,'size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.progress-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => 60,'max' => 100,'size' => 'lg']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $attributes = $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $component = $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
                    </div>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Limite de Isenção (exemplo real)</h3>
                    <?php if (isset($component)) { $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.progress-bar','data' => ['value' => 34000,'max' => 35000,'color' => 'primary','showLabel' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.progress-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => 34000,'max' => 35000,'color' => 'primary','showLabel' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $attributes = $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $component = $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
                </div>
            </div>
        </section>

        <!-- PERIOD FILTER -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Period Filter</h2>

            <div class="space-y-4">
                <?php if (isset($component)) { $__componentOriginal5d1dcf89ca035c7f1248fdd7d43f6e45 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d1dcf89ca035c7f1248fdd7d43f6e45 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.period-filter','data' => ['periods' => ['1D', '1S', '1M', '1A', 'Tudo'],'selected' => 'Tudo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.period-filter'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['periods' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['1D', '1S', '1M', '1A', 'Tudo']),'selected' => 'Tudo']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5d1dcf89ca035c7f1248fdd7d43f6e45)): ?>
<?php $attributes = $__attributesOriginal5d1dcf89ca035c7f1248fdd7d43f6e45; ?>
<?php unset($__attributesOriginal5d1dcf89ca035c7f1248fdd7d43f6e45); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5d1dcf89ca035c7f1248fdd7d43f6e45)): ?>
<?php $component = $__componentOriginal5d1dcf89ca035c7f1248fdd7d43f6e45; ?>
<?php unset($__componentOriginal5d1dcf89ca035c7f1248fdd7d43f6e45); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal5d1dcf89ca035c7f1248fdd7d43f6e45 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d1dcf89ca035c7f1248fdd7d43f6e45 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.period-filter','data' => ['periods' => ['7D', '30D', '90D', '1A'],'selected' => '30D']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.period-filter'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['periods' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['7D', '30D', '90D', '1A']),'selected' => '30D']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5d1dcf89ca035c7f1248fdd7d43f6e45)): ?>
<?php $attributes = $__attributesOriginal5d1dcf89ca035c7f1248fdd7d43f6e45; ?>
<?php unset($__attributesOriginal5d1dcf89ca035c7f1248fdd7d43f6e45); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5d1dcf89ca035c7f1248fdd7d43f6e45)): ?>
<?php $component = $__componentOriginal5d1dcf89ca035c7f1248fdd7d43f6e45; ?>
<?php unset($__componentOriginal5d1dcf89ca035c7f1248fdd7d43f6e45); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- DATE PICKER -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Date Picker</h2>

            <div class="flex flex-wrap gap-6">
                <?php if (isset($component)) { $__componentOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.date-picker','data' => ['year' => 2023]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.date-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['year' => 2023]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e)): ?>
<?php $attributes = $__attributesOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e; ?>
<?php unset($__attributesOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e)): ?>
<?php $component = $__componentOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e; ?>
<?php unset($__componentOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.date-picker','data' => ['year' => 2023,'month' => '07','showMonth' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.date-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['year' => 2023,'month' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('07'),'showMonth' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e)): ?>
<?php $attributes = $__attributesOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e; ?>
<?php unset($__attributesOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e)): ?>
<?php $component = $__componentOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e; ?>
<?php unset($__componentOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- SUMMARY ITEM -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Summary Item</h2>

            <div class="max-w-sm">
                <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['title' => 'Resumo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Resumo']); ?>
                    <?php if (isset($component)) { $__componentOriginalc7c17cc3536f3869ffbaf1b737b96444 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.summary-item','data' => ['label' => 'Limite de isenção','value' => 'R$34.000,00/R$ 35.000,00','info' => 'Limite mensal de isenção fiscal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.summary-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Limite de isenção','value' => 'R$34.000,00/R$ 35.000,00','info' => 'Limite mensal de isenção fiscal']); ?>
                        <?php if (isset($component)) { $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.progress-bar','data' => ['value' => 34000,'max' => 35000,'color' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.progress-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => 34000,'max' => 35000,'color' => 'primary']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $attributes = $__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__attributesOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff)): ?>
<?php $component = $__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff; ?>
<?php unset($__componentOriginal59ef5994b22a1cc08ed5d50edefbc0ff); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444)): ?>
<?php $attributes = $__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444; ?>
<?php unset($__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7c17cc3536f3869ffbaf1b737b96444)): ?>
<?php $component = $__componentOriginalc7c17cc3536f3869ffbaf1b737b96444; ?>
<?php unset($__componentOriginalc7c17cc3536f3869ffbaf1b737b96444); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalc7c17cc3536f3869ffbaf1b737b96444 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.summary-item','data' => ['label' => 'Valor tributário a pagar','value' => 'R$0,00']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.summary-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Valor tributário a pagar','value' => 'R$0,00']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444)): ?>
<?php $attributes = $__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444; ?>
<?php unset($__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7c17cc3536f3869ffbaf1b737b96444)): ?>
<?php $component = $__componentOriginalc7c17cc3536f3869ffbaf1b737b96444; ?>
<?php unset($__componentOriginalc7c17cc3536f3869ffbaf1b737b96444); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalc7c17cc3536f3869ffbaf1b737b96444 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.summary-item','data' => ['label' => 'Próxima data para envio de declaração:','value' => '24/Abr']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.summary-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Próxima data para envio de declaração:','value' => '24/Abr']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444)): ?>
<?php $attributes = $__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444; ?>
<?php unset($__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7c17cc3536f3869ffbaf1b737b96444)): ?>
<?php $component = $__componentOriginalc7c17cc3536f3869ffbaf1b737b96444; ?>
<?php unset($__componentOriginalc7c17cc3536f3869ffbaf1b737b96444); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalc7c17cc3536f3869ffbaf1b737b96444 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.summary-item','data' => ['label' => 'Quantidade de operações','value' => 'R$ 42,00','border' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.summary-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Quantidade de operações','value' => 'R$ 42,00','border' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444)): ?>
<?php $attributes = $__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444; ?>
<?php unset($__attributesOriginalc7c17cc3536f3869ffbaf1b737b96444); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7c17cc3536f3869ffbaf1b737b96444)): ?>
<?php $component = $__componentOriginalc7c17cc3536f3869ffbaf1b737b96444; ?>
<?php unset($__componentOriginalc7c17cc3536f3869ffbaf1b737b96444); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $attributes = $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $component = $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- ASSET LIST ITEM -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Asset List Item</h2>

            <div class="max-w-sm">
                <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['title' => 'Principais ativos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Principais ativos']); ?>
                    <div class="space-y-2">
                        <?php if (isset($component)) { $__componentOriginal6666a8deae3b9e924b78a6dbd043e20d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.asset-list-item','data' => ['name' => 'BTC','value' => 1000000,'color' => '#9333EA']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.asset-list-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'BTC','value' => 1000000,'color' => '#9333EA']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d)): ?>
<?php $attributes = $__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d; ?>
<?php unset($__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6666a8deae3b9e924b78a6dbd043e20d)): ?>
<?php $component = $__componentOriginal6666a8deae3b9e924b78a6dbd043e20d; ?>
<?php unset($__componentOriginal6666a8deae3b9e924b78a6dbd043e20d); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal6666a8deae3b9e924b78a6dbd043e20d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.asset-list-item','data' => ['name' => 'ETH','value' => 500000,'color' => '#A855F7']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.asset-list-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'ETH','value' => 500000,'color' => '#A855F7']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d)): ?>
<?php $attributes = $__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d; ?>
<?php unset($__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6666a8deae3b9e924b78a6dbd043e20d)): ?>
<?php $component = $__componentOriginal6666a8deae3b9e924b78a6dbd043e20d; ?>
<?php unset($__componentOriginal6666a8deae3b9e924b78a6dbd043e20d); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal6666a8deae3b9e924b78a6dbd043e20d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.asset-list-item','data' => ['name' => 'USDT','value' => 500000,'color' => '#C084FC']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.asset-list-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'USDT','value' => 500000,'color' => '#C084FC']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d)): ?>
<?php $attributes = $__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d; ?>
<?php unset($__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6666a8deae3b9e924b78a6dbd043e20d)): ?>
<?php $component = $__componentOriginal6666a8deae3b9e924b78a6dbd043e20d; ?>
<?php unset($__componentOriginal6666a8deae3b9e924b78a6dbd043e20d); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal6666a8deae3b9e924b78a6dbd043e20d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.asset-list-item','data' => ['name' => 'XRP','value' => 500000,'color' => '#D8B4FE']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.asset-list-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'XRP','value' => 500000,'color' => '#D8B4FE']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d)): ?>
<?php $attributes = $__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d; ?>
<?php unset($__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6666a8deae3b9e924b78a6dbd043e20d)): ?>
<?php $component = $__componentOriginal6666a8deae3b9e924b78a6dbd043e20d; ?>
<?php unset($__componentOriginal6666a8deae3b9e924b78a6dbd043e20d); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal6666a8deae3b9e924b78a6dbd043e20d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.asset-list-item','data' => ['name' => 'Outros','value' => 500000,'color' => '#E9D5FF']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.asset-list-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'Outros','value' => 500000,'color' => '#E9D5FF']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d)): ?>
<?php $attributes = $__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d; ?>
<?php unset($__attributesOriginal6666a8deae3b9e924b78a6dbd043e20d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6666a8deae3b9e924b78a6dbd043e20d)): ?>
<?php $component = $__componentOriginal6666a8deae3b9e924b78a6dbd043e20d; ?>
<?php unset($__componentOriginal6666a8deae3b9e924b78a6dbd043e20d); ?>
<?php endif; ?>
                    </div>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $attributes = $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $component = $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- TABLE -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Table</h2>

            <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['padding' => 'none']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['padding' => 'none']); ?>
                <?php if (isset($component)) { $__componentOriginal793d2b22631f88b8a3d00569a12acf88 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal793d2b22631f88b8a3d00569a12acf88 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                     <?php $__env->slot('head', null, []); ?> 
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mês</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Valor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                        </tr>
                     <?php $__env->endSlot(); ?>

                    <?php if (isset($component)) { $__componentOriginal35379c366f393c2f9b3689df81de4868 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35379c366f393c2f9b3689df81de4868 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-row','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                        <?php if (isset($component)) { $__componentOriginal637f80709300ab9bb7e468464d43998f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal637f80709300ab9bb7e468464d43998f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>DEZ <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $attributes = $__attributesOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__attributesOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $component = $__componentOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__componentOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal637f80709300ab9bb7e468464d43998f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal637f80709300ab9bb7e468464d43998f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>R$ 3.000.000,00 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $attributes = $__attributesOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__attributesOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $component = $__componentOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__componentOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal637f80709300ab9bb7e468464d43998f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal637f80709300ab9bb7e468464d43998f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'pendente']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'pendente']); ?>Pendente <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $attributes = $__attributesOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__attributesOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $component = $__componentOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__componentOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal637f80709300ab9bb7e468464d43998f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal637f80709300ab9bb7e468464d43998f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <?php if (isset($component)) { $__componentOriginaleea726fa4f84deb9f7684b50bdd6328c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleea726fa4f84deb9f7684b50bdd6328c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.dropdown','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                 <?php $__env->slot('trigger', null, []); ?> 
                                    <button class="p-2 rounded-full text-gray-400 hover:bg-gray-100">
                                        <?php if (isset($component)) { $__componentOriginal0886f8e9f291de70f7e64b32903d41fc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0886f8e9f291de70f7e64b32903d41fc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.more-vertical','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.more-vertical'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0886f8e9f291de70f7e64b32903d41fc)): ?>
<?php $attributes = $__attributesOriginal0886f8e9f291de70f7e64b32903d41fc; ?>
<?php unset($__attributesOriginal0886f8e9f291de70f7e64b32903d41fc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0886f8e9f291de70f7e64b32903d41fc)): ?>
<?php $component = $__componentOriginal0886f8e9f291de70f7e64b32903d41fc; ?>
<?php unset($__componentOriginal0886f8e9f291de70f7e64b32903d41fc); ?>
<?php endif; ?>
                                    </button>
                                 <?php $__env->endSlot(); ?>
                                <?php if (isset($component)) { $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.dropdown-item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.dropdown-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Ver detalhes <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $attributes = $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $component = $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.dropdown-item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.dropdown-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Editar <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $attributes = $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $component = $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.dropdown-item','data' => ['danger' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.dropdown-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['danger' => true]); ?>Excluir <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $attributes = $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $component = $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleea726fa4f84deb9f7684b50bdd6328c)): ?>
<?php $attributes = $__attributesOriginaleea726fa4f84deb9f7684b50bdd6328c; ?>
<?php unset($__attributesOriginaleea726fa4f84deb9f7684b50bdd6328c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleea726fa4f84deb9f7684b50bdd6328c)): ?>
<?php $component = $__componentOriginaleea726fa4f84deb9f7684b50bdd6328c; ?>
<?php unset($__componentOriginaleea726fa4f84deb9f7684b50bdd6328c); ?>
<?php endif; ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $attributes = $__attributesOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__attributesOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $component = $__componentOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__componentOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35379c366f393c2f9b3689df81de4868)): ?>
<?php $attributes = $__attributesOriginal35379c366f393c2f9b3689df81de4868; ?>
<?php unset($__attributesOriginal35379c366f393c2f9b3689df81de4868); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35379c366f393c2f9b3689df81de4868)): ?>
<?php $component = $__componentOriginal35379c366f393c2f9b3689df81de4868; ?>
<?php unset($__componentOriginal35379c366f393c2f9b3689df81de4868); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginal35379c366f393c2f9b3689df81de4868 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35379c366f393c2f9b3689df81de4868 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-row','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                        <?php if (isset($component)) { $__componentOriginal637f80709300ab9bb7e468464d43998f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal637f80709300ab9bb7e468464d43998f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>NOV <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $attributes = $__attributesOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__attributesOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $component = $__componentOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__componentOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal637f80709300ab9bb7e468464d43998f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal637f80709300ab9bb7e468464d43998f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>R$ 3.000.000,00 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $attributes = $__attributesOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__attributesOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $component = $__componentOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__componentOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal637f80709300ab9bb7e468464d43998f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal637f80709300ab9bb7e468464d43998f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'isento']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'isento']); ?>Isento <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $attributes = $__attributesOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__attributesOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $component = $__componentOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__componentOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal637f80709300ab9bb7e468464d43998f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal637f80709300ab9bb7e468464d43998f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <button class="p-2 rounded-full text-gray-400 hover:bg-gray-100">
                                <?php if (isset($component)) { $__componentOriginal0886f8e9f291de70f7e64b32903d41fc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0886f8e9f291de70f7e64b32903d41fc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.more-vertical','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.more-vertical'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0886f8e9f291de70f7e64b32903d41fc)): ?>
<?php $attributes = $__attributesOriginal0886f8e9f291de70f7e64b32903d41fc; ?>
<?php unset($__attributesOriginal0886f8e9f291de70f7e64b32903d41fc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0886f8e9f291de70f7e64b32903d41fc)): ?>
<?php $component = $__componentOriginal0886f8e9f291de70f7e64b32903d41fc; ?>
<?php unset($__componentOriginal0886f8e9f291de70f7e64b32903d41fc); ?>
<?php endif; ?>
                            </button>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $attributes = $__attributesOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__attributesOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $component = $__componentOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__componentOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35379c366f393c2f9b3689df81de4868)): ?>
<?php $attributes = $__attributesOriginal35379c366f393c2f9b3689df81de4868; ?>
<?php unset($__attributesOriginal35379c366f393c2f9b3689df81de4868); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35379c366f393c2f9b3689df81de4868)): ?>
<?php $component = $__componentOriginal35379c366f393c2f9b3689df81de4868; ?>
<?php unset($__componentOriginal35379c366f393c2f9b3689df81de4868); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginal35379c366f393c2f9b3689df81de4868 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35379c366f393c2f9b3689df81de4868 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-row','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                        <?php if (isset($component)) { $__componentOriginal637f80709300ab9bb7e468464d43998f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal637f80709300ab9bb7e468464d43998f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>OUT <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $attributes = $__attributesOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__attributesOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $component = $__componentOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__componentOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal637f80709300ab9bb7e468464d43998f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal637f80709300ab9bb7e468464d43998f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>R$ 3.000.000,00 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $attributes = $__attributesOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__attributesOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $component = $__componentOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__componentOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal637f80709300ab9bb7e468464d43998f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal637f80709300ab9bb7e468464d43998f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php if (isset($component)) { $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.badge','data' => ['variant' => 'isento']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'isento']); ?>Isento <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $attributes = $__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__attributesOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4)): ?>
<?php $component = $__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4; ?>
<?php unset($__componentOriginalab7baa01105b3dfe1e0cf1dfc58879b4); ?>
<?php endif; ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $attributes = $__attributesOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__attributesOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $component = $__componentOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__componentOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal637f80709300ab9bb7e468464d43998f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal637f80709300ab9bb7e468464d43998f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.table-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.table-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <button class="p-2 rounded-full text-gray-400 hover:bg-gray-100">
                                <?php if (isset($component)) { $__componentOriginal0886f8e9f291de70f7e64b32903d41fc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0886f8e9f291de70f7e64b32903d41fc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.more-vertical','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.more-vertical'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0886f8e9f291de70f7e64b32903d41fc)): ?>
<?php $attributes = $__attributesOriginal0886f8e9f291de70f7e64b32903d41fc; ?>
<?php unset($__attributesOriginal0886f8e9f291de70f7e64b32903d41fc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0886f8e9f291de70f7e64b32903d41fc)): ?>
<?php $component = $__componentOriginal0886f8e9f291de70f7e64b32903d41fc; ?>
<?php unset($__componentOriginal0886f8e9f291de70f7e64b32903d41fc); ?>
<?php endif; ?>
                            </button>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $attributes = $__attributesOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__attributesOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal637f80709300ab9bb7e468464d43998f)): ?>
<?php $component = $__componentOriginal637f80709300ab9bb7e468464d43998f; ?>
<?php unset($__componentOriginal637f80709300ab9bb7e468464d43998f); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35379c366f393c2f9b3689df81de4868)): ?>
<?php $attributes = $__attributesOriginal35379c366f393c2f9b3689df81de4868; ?>
<?php unset($__attributesOriginal35379c366f393c2f9b3689df81de4868); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35379c366f393c2f9b3689df81de4868)): ?>
<?php $component = $__componentOriginal35379c366f393c2f9b3689df81de4868; ?>
<?php unset($__componentOriginal35379c366f393c2f9b3689df81de4868); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal793d2b22631f88b8a3d00569a12acf88)): ?>
<?php $attributes = $__attributesOriginal793d2b22631f88b8a3d00569a12acf88; ?>
<?php unset($__attributesOriginal793d2b22631f88b8a3d00569a12acf88); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal793d2b22631f88b8a3d00569a12acf88)): ?>
<?php $component = $__componentOriginal793d2b22631f88b8a3d00569a12acf88; ?>
<?php unset($__componentOriginal793d2b22631f88b8a3d00569a12acf88); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $attributes = $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $component = $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
        </section>

        <!-- CHECKBOX -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Checkbox</h2>

            <div class="flex flex-wrap gap-6">
                <?php if (isset($component)) { $__componentOriginala40cc9faf0a70b4042aba6747c772818 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala40cc9faf0a70b4042aba6747c772818 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.checkbox','data' => ['label' => 'Opção 1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Opção 1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala40cc9faf0a70b4042aba6747c772818)): ?>
<?php $attributes = $__attributesOriginala40cc9faf0a70b4042aba6747c772818; ?>
<?php unset($__attributesOriginala40cc9faf0a70b4042aba6747c772818); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala40cc9faf0a70b4042aba6747c772818)): ?>
<?php $component = $__componentOriginala40cc9faf0a70b4042aba6747c772818; ?>
<?php unset($__componentOriginala40cc9faf0a70b4042aba6747c772818); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginala40cc9faf0a70b4042aba6747c772818 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala40cc9faf0a70b4042aba6747c772818 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.checkbox','data' => ['label' => 'Opção 2','checked' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Opção 2','checked' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala40cc9faf0a70b4042aba6747c772818)): ?>
<?php $attributes = $__attributesOriginala40cc9faf0a70b4042aba6747c772818; ?>
<?php unset($__attributesOriginala40cc9faf0a70b4042aba6747c772818); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala40cc9faf0a70b4042aba6747c772818)): ?>
<?php $component = $__componentOriginala40cc9faf0a70b4042aba6747c772818; ?>
<?php unset($__componentOriginala40cc9faf0a70b4042aba6747c772818); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginala40cc9faf0a70b4042aba6747c772818 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala40cc9faf0a70b4042aba6747c772818 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.checkbox','data' => ['label' => 'Opção 3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Opção 3']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala40cc9faf0a70b4042aba6747c772818)): ?>
<?php $attributes = $__attributesOriginala40cc9faf0a70b4042aba6747c772818; ?>
<?php unset($__attributesOriginala40cc9faf0a70b4042aba6747c772818); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala40cc9faf0a70b4042aba6747c772818)): ?>
<?php $component = $__componentOriginala40cc9faf0a70b4042aba6747c772818; ?>
<?php unset($__componentOriginala40cc9faf0a70b4042aba6747c772818); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- AVATAR -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Avatar</h2>

            <div class="flex flex-wrap items-center gap-6">
                <?php if (isset($component)) { $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.avatar','data' => ['size' => 'sm','alt' => 'AR']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm','alt' => 'AR']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2)): ?>
<?php $attributes = $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2; ?>
<?php unset($__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2)): ?>
<?php $component = $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2; ?>
<?php unset($__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.avatar','data' => ['size' => 'md','alt' => 'AR']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md','alt' => 'AR']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2)): ?>
<?php $attributes = $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2; ?>
<?php unset($__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2)): ?>
<?php $component = $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2; ?>
<?php unset($__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.avatar','data' => ['size' => 'lg','alt' => 'AR']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'lg','alt' => 'AR']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2)): ?>
<?php $attributes = $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2; ?>
<?php unset($__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2)): ?>
<?php $component = $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2; ?>
<?php unset($__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.avatar','data' => ['size' => 'xl','alt' => 'AR']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'xl','alt' => 'AR']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2)): ?>
<?php $attributes = $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2; ?>
<?php unset($__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2)): ?>
<?php $component = $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2; ?>
<?php unset($__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.avatar','data' => ['size' => 'lg','src' => 'https://ui-avatars.com/api/?name=Alonso+Rodrigues&background=9333EA&color=fff','alt' => 'Alonso Rodrigues']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'lg','src' => 'https://ui-avatars.com/api/?name=Alonso+Rodrigues&background=9333EA&color=fff','alt' => 'Alonso Rodrigues']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2)): ?>
<?php $attributes = $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2; ?>
<?php unset($__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2)): ?>
<?php $component = $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2; ?>
<?php unset($__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- DROPDOWN -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Dropdown</h2>

            <div class="flex gap-6">
                <?php if (isset($component)) { $__componentOriginaleea726fa4f84deb9f7684b50bdd6328c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleea726fa4f84deb9f7684b50bdd6328c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.dropdown','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                     <?php $__env->slot('trigger', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'neutral']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'neutral']); ?>
                            Menu de Ações
                            <?php if (isset($component)) { $__componentOriginalfb5ab559e4014313073efeb5cdff727a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5ab559e4014313073efeb5cdff727a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chevron-down','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
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
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                     <?php $__env->endSlot(); ?>

                    <?php if (isset($component)) { $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.dropdown-item','data' => ['href' => '#']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.dropdown-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#']); ?>
                        <?php if (isset($component)) { $__componentOriginal881f5ac4e47c0c198e5178ad5ad39289 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal881f5ac4e47c0c198e5178ad5ad39289 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.file-text','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.file-text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal881f5ac4e47c0c198e5178ad5ad39289)): ?>
<?php $attributes = $__attributesOriginal881f5ac4e47c0c198e5178ad5ad39289; ?>
<?php unset($__attributesOriginal881f5ac4e47c0c198e5178ad5ad39289); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal881f5ac4e47c0c198e5178ad5ad39289)): ?>
<?php $component = $__componentOriginal881f5ac4e47c0c198e5178ad5ad39289; ?>
<?php unset($__componentOriginal881f5ac4e47c0c198e5178ad5ad39289); ?>
<?php endif; ?>
                        Ver detalhes
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $attributes = $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $component = $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.dropdown-item','data' => ['href' => '#']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.dropdown-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#']); ?>
                        <?php if (isset($component)) { $__componentOriginalcb5db8d5c08be2cc48e3785b39aa322e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb5db8d5c08be2cc48e3785b39aa322e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.download','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.download'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcb5db8d5c08be2cc48e3785b39aa322e)): ?>
<?php $attributes = $__attributesOriginalcb5db8d5c08be2cc48e3785b39aa322e; ?>
<?php unset($__attributesOriginalcb5db8d5c08be2cc48e3785b39aa322e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcb5db8d5c08be2cc48e3785b39aa322e)): ?>
<?php $component = $__componentOriginalcb5db8d5c08be2cc48e3785b39aa322e; ?>
<?php unset($__componentOriginalcb5db8d5c08be2cc48e3785b39aa322e); ?>
<?php endif; ?>
                        Baixar
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $attributes = $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $component = $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.dropdown-item','data' => ['href' => '#']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.dropdown-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#']); ?>
                        <?php if (isset($component)) { $__componentOriginal576f4d42079cd7cc622d4037ec77e086 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal576f4d42079cd7cc622d4037ec77e086 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.refresh','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.refresh'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal576f4d42079cd7cc622d4037ec77e086)): ?>
<?php $attributes = $__attributesOriginal576f4d42079cd7cc622d4037ec77e086; ?>
<?php unset($__attributesOriginal576f4d42079cd7cc622d4037ec77e086); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal576f4d42079cd7cc622d4037ec77e086)): ?>
<?php $component = $__componentOriginal576f4d42079cd7cc622d4037ec77e086; ?>
<?php unset($__componentOriginal576f4d42079cd7cc622d4037ec77e086); ?>
<?php endif; ?>
                        Sincronizar
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $attributes = $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $component = $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
                    <div class="border-t border-gray-100 my-1"></div>
                    <?php if (isset($component)) { $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.dropdown-item','data' => ['href' => '#','danger' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.dropdown-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#','danger' => true]); ?>
                        <?php if (isset($component)) { $__componentOriginal25305810f9b150b3c69b0ffa42f21251 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal25305810f9b150b3c69b0ffa42f21251 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.x','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.x'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
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
                        Excluir
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $attributes = $__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__attributesOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86)): ?>
<?php $component = $__componentOriginalb5772a3fe50157660e6e2d7f982f2e86; ?>
<?php unset($__componentOriginalb5772a3fe50157660e6e2d7f982f2e86); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleea726fa4f84deb9f7684b50bdd6328c)): ?>
<?php $attributes = $__attributesOriginaleea726fa4f84deb9f7684b50bdd6328c; ?>
<?php unset($__attributesOriginaleea726fa4f84deb9f7684b50bdd6328c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleea726fa4f84deb9f7684b50bdd6328c)): ?>
<?php $component = $__componentOriginaleea726fa4f84deb9f7684b50bdd6328c; ?>
<?php unset($__componentOriginaleea726fa4f84deb9f7684b50bdd6328c); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- TEXTAREA -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Textarea</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl">
                <?php if (isset($component)) { $__componentOriginal62d1193389a71cd99ff302a00abbf991 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62d1193389a71cd99ff302a00abbf991 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.textarea','data' => ['label' => 'Descricao','placeholder' => 'Digite aqui a descricao...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Descricao','placeholder' => 'Digite aqui a descricao...']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal62d1193389a71cd99ff302a00abbf991)): ?>
<?php $attributes = $__attributesOriginal62d1193389a71cd99ff302a00abbf991; ?>
<?php unset($__attributesOriginal62d1193389a71cd99ff302a00abbf991); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal62d1193389a71cd99ff302a00abbf991)): ?>
<?php $component = $__componentOriginal62d1193389a71cd99ff302a00abbf991; ?>
<?php unset($__componentOriginal62d1193389a71cd99ff302a00abbf991); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal62d1193389a71cd99ff302a00abbf991 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62d1193389a71cd99ff302a00abbf991 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.textarea','data' => ['label' => 'Com erro','placeholder' => 'Digite algo...','error' => 'Este campo e obrigatorio']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Com erro','placeholder' => 'Digite algo...','error' => 'Este campo e obrigatorio']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal62d1193389a71cd99ff302a00abbf991)): ?>
<?php $attributes = $__attributesOriginal62d1193389a71cd99ff302a00abbf991; ?>
<?php unset($__attributesOriginal62d1193389a71cd99ff302a00abbf991); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal62d1193389a71cd99ff302a00abbf991)): ?>
<?php $component = $__componentOriginal62d1193389a71cd99ff302a00abbf991; ?>
<?php unset($__componentOriginal62d1193389a71cd99ff302a00abbf991); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal62d1193389a71cd99ff302a00abbf991 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62d1193389a71cd99ff302a00abbf991 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.textarea','data' => ['label' => 'Com dica','placeholder' => 'Observacoes adicionais...','hint' => 'Maximo de 500 caracteres','rows' => 3]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Com dica','placeholder' => 'Observacoes adicionais...','hint' => 'Maximo de 500 caracteres','rows' => 3]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal62d1193389a71cd99ff302a00abbf991)): ?>
<?php $attributes = $__attributesOriginal62d1193389a71cd99ff302a00abbf991; ?>
<?php unset($__attributesOriginal62d1193389a71cd99ff302a00abbf991); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal62d1193389a71cd99ff302a00abbf991)): ?>
<?php $component = $__componentOriginal62d1193389a71cd99ff302a00abbf991; ?>
<?php unset($__componentOriginal62d1193389a71cd99ff302a00abbf991); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- SPINNER -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Spinner</h2>

            <div class="space-y-6">
                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Tamanhos</h3>
                    <div class="flex items-center gap-6">
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal7ee43febc033d8a87ae157694e6933ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ee43febc033d8a87ae157694e6933ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.spinner','data' => ['size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm']); ?>
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
                            <span class="text-xs text-gray-500">Small</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal7ee43febc033d8a87ae157694e6933ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ee43febc033d8a87ae157694e6933ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.spinner','data' => ['size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md']); ?>
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
                            <span class="text-xs text-gray-500">Medium</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal7ee43febc033d8a87ae157694e6933ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ee43febc033d8a87ae157694e6933ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.spinner','data' => ['size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'lg']); ?>
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
                            <span class="text-xs text-gray-500">Large</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal7ee43febc033d8a87ae157694e6933ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ee43febc033d8a87ae157694e6933ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.spinner','data' => ['size' => 'xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'xl']); ?>
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
                            <span class="text-xs text-gray-500">Extra Large</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-4">Cores</h3>
                    <div class="flex items-center gap-6">
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal7ee43febc033d8a87ae157694e6933ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ee43febc033d8a87ae157694e6933ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.spinner','data' => ['color' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'primary']); ?>
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
                            <span class="text-xs text-gray-500">Primary</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal7ee43febc033d8a87ae157694e6933ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ee43febc033d8a87ae157694e6933ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.spinner','data' => ['color' => 'gray']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray']); ?>
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
                            <span class="text-xs text-gray-500">Gray</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal7ee43febc033d8a87ae157694e6933ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ee43febc033d8a87ae157694e6933ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.spinner','data' => ['color' => 'success']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'success']); ?>
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
                            <span class="text-xs text-gray-500">Success</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal7ee43febc033d8a87ae157694e6933ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ee43febc033d8a87ae157694e6933ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.spinner','data' => ['color' => 'danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'danger']); ?>
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
                            <span class="text-xs text-gray-500">Danger</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 bg-gray-800 p-3 rounded-lg">
                            <?php if (isset($component)) { $__componentOriginal7ee43febc033d8a87ae157694e6933ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ee43febc033d8a87ae157694e6933ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.spinner','data' => ['color' => 'white']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.spinner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'white']); ?>
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
                            <span class="text-xs text-gray-300">White</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- STEP PROGRESS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Step Progress</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['title' => 'Processando...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Processando...']); ?>
                    <?php if (isset($component)) { $__componentOriginal6fc7b2b0599e874135cdb1beb8c91f05 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6fc7b2b0599e874135cdb1beb8c91f05 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.step-progress','data' => ['steps' => [
                        ['label' => 'Consultando transacoes', 'status' => 'completed'],
                        ['label' => 'Consolidando operacoes', 'status' => 'completed'],
                        ['label' => 'Calculando lucros', 'status' => 'loading'],
                        ['label' => 'Aplicando regras fiscais', 'status' => 'pending'],
                        ['label' => 'Gerando documento', 'status' => 'pending'],
                    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.step-progress'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['steps' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                        ['label' => 'Consultando transacoes', 'status' => 'completed'],
                        ['label' => 'Consolidando operacoes', 'status' => 'completed'],
                        ['label' => 'Calculando lucros', 'status' => 'loading'],
                        ['label' => 'Aplicando regras fiscais', 'status' => 'pending'],
                        ['label' => 'Gerando documento', 'status' => 'pending'],
                    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6fc7b2b0599e874135cdb1beb8c91f05)): ?>
<?php $attributes = $__attributesOriginal6fc7b2b0599e874135cdb1beb8c91f05; ?>
<?php unset($__attributesOriginal6fc7b2b0599e874135cdb1beb8c91f05); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6fc7b2b0599e874135cdb1beb8c91f05)): ?>
<?php $component = $__componentOriginal6fc7b2b0599e874135cdb1beb8c91f05; ?>
<?php unset($__componentOriginal6fc7b2b0599e874135cdb1beb8c91f05); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $attributes = $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $component = $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['title' => 'Concluido']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Concluido']); ?>
                    <?php if (isset($component)) { $__componentOriginal6fc7b2b0599e874135cdb1beb8c91f05 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6fc7b2b0599e874135cdb1beb8c91f05 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.step-progress','data' => ['steps' => [
                        ['label' => 'Consultando transacoes', 'status' => 'completed'],
                        ['label' => 'Consolidando operacoes', 'status' => 'completed'],
                        ['label' => 'Calculando lucros', 'status' => 'completed'],
                        ['label' => 'Aplicando regras fiscais', 'status' => 'completed'],
                        ['label' => 'Gerando documento', 'status' => 'completed'],
                    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.step-progress'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['steps' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                        ['label' => 'Consultando transacoes', 'status' => 'completed'],
                        ['label' => 'Consolidando operacoes', 'status' => 'completed'],
                        ['label' => 'Calculando lucros', 'status' => 'completed'],
                        ['label' => 'Aplicando regras fiscais', 'status' => 'completed'],
                        ['label' => 'Gerando documento', 'status' => 'completed'],
                    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6fc7b2b0599e874135cdb1beb8c91f05)): ?>
<?php $attributes = $__attributesOriginal6fc7b2b0599e874135cdb1beb8c91f05; ?>
<?php unset($__attributesOriginal6fc7b2b0599e874135cdb1beb8c91f05); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6fc7b2b0599e874135cdb1beb8c91f05)): ?>
<?php $component = $__componentOriginal6fc7b2b0599e874135cdb1beb8c91f05; ?>
<?php unset($__componentOriginal6fc7b2b0599e874135cdb1beb8c91f05); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $attributes = $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $component = $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.card','data' => ['title' => 'Com Erro']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Com Erro']); ?>
                    <?php if (isset($component)) { $__componentOriginal6fc7b2b0599e874135cdb1beb8c91f05 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6fc7b2b0599e874135cdb1beb8c91f05 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.step-progress','data' => ['steps' => [
                        ['label' => 'Consultando transacoes', 'status' => 'completed'],
                        ['label' => 'Consolidando operacoes', 'status' => 'completed'],
                        ['label' => 'Calculando lucros', 'status' => 'error'],
                        ['label' => 'Aplicando regras fiscais', 'status' => 'pending'],
                        ['label' => 'Gerando documento', 'status' => 'pending'],
                    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.step-progress'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['steps' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                        ['label' => 'Consultando transacoes', 'status' => 'completed'],
                        ['label' => 'Consolidando operacoes', 'status' => 'completed'],
                        ['label' => 'Calculando lucros', 'status' => 'error'],
                        ['label' => 'Aplicando regras fiscais', 'status' => 'pending'],
                        ['label' => 'Gerando documento', 'status' => 'pending'],
                    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6fc7b2b0599e874135cdb1beb8c91f05)): ?>
<?php $attributes = $__attributesOriginal6fc7b2b0599e874135cdb1beb8c91f05; ?>
<?php unset($__attributesOriginal6fc7b2b0599e874135cdb1beb8c91f05); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6fc7b2b0599e874135cdb1beb8c91f05)): ?>
<?php $component = $__componentOriginal6fc7b2b0599e874135cdb1beb8c91f05; ?>
<?php unset($__componentOriginal6fc7b2b0599e874135cdb1beb8c91f05); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $attributes = $__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__attributesOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93)): ?>
<?php $component = $__componentOriginaldae4cd48acb67888a4631e1ba48f2f93; ?>
<?php unset($__componentOriginaldae4cd48acb67888a4631e1ba48f2f93); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- MODAL -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Modal</h2>

            <div x-data="{ showModal: false }">
                <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary','@click' => 'showModal = true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','@click' => 'showModal = true']); ?>
                    Abrir Modal
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>

                <div
                    x-show="showModal"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 overflow-y-auto"
                    x-cloak
                >
                    <div class="fixed inset-0 bg-black/50" @click="showModal = false"></div>

                    <div class="flex min-h-full items-center justify-center p-4">
                        <div
                            x-show="showModal"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="relative bg-white rounded-2xl shadow-modal w-full max-w-md overflow-hidden"
                            @click.stop
                        >
                            <div class="flex items-center justify-between p-6 pb-0">
                                <h2 class="text-xl font-semibold text-gray-900">Conectar com a Binance</h2>
                                <button @click="showModal = false" class="p-2 rounded-full text-gray-400 hover:bg-gray-100">
                                    <?php if (isset($component)) { $__componentOriginal25305810f9b150b3c69b0ffa42f21251 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal25305810f9b150b3c69b0ffa42f21251 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.x','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.x'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
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
                                </button>
                            </div>

                            <div class="p-6 space-y-4">
                                <?php if (isset($component)) { $__componentOriginal65bd7e7dbd93cec773ad6501ce127e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.input','data' => ['label' => 'Digite o nome da carteira','placeholder' => 'Pesquisar','icon' => 'search']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Digite o nome da carteira','placeholder' => 'Pesquisar','icon' => 'search']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46)): ?>
<?php $attributes = $__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46; ?>
<?php unset($__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal65bd7e7dbd93cec773ad6501ce127e46)): ?>
<?php $component = $__componentOriginal65bd7e7dbd93cec773ad6501ce127e46; ?>
<?php unset($__componentOriginal65bd7e7dbd93cec773ad6501ce127e46); ?>
<?php endif; ?>

                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-3">Importar operações</p>
                                    <div class="space-y-2">
                                        <?php if (isset($component)) { $__componentOriginal2b872940064962925e68f9767df4ff66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b872940064962925e68f9767df4ff66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.radio-button','data' => ['name' => 'modal_importacao','value' => 'automatica','label' => 'Importação automática','checked' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.radio-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'modal_importacao','value' => 'automatica','label' => 'Importação automática','checked' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b872940064962925e68f9767df4ff66)): ?>
<?php $attributes = $__attributesOriginal2b872940064962925e68f9767df4ff66; ?>
<?php unset($__attributesOriginal2b872940064962925e68f9767df4ff66); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b872940064962925e68f9767df4ff66)): ?>
<?php $component = $__componentOriginal2b872940064962925e68f9767df4ff66; ?>
<?php unset($__componentOriginal2b872940064962925e68f9767df4ff66); ?>
<?php endif; ?>
                                        <?php if (isset($component)) { $__componentOriginal2b872940064962925e68f9767df4ff66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b872940064962925e68f9767df4ff66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.radio-button','data' => ['name' => 'modal_importacao','value' => 'manual','label' => 'Importação manual']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.radio-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'modal_importacao','value' => 'manual','label' => 'Importação manual']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b872940064962925e68f9767df4ff66)): ?>
<?php $attributes = $__attributesOriginal2b872940064962925e68f9767df4ff66; ?>
<?php unset($__attributesOriginal2b872940064962925e68f9767df4ff66); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b872940064962925e68f9767df4ff66)): ?>
<?php $component = $__componentOriginal2b872940064962925e68f9767df4ff66; ?>
<?php unset($__componentOriginal2b872940064962925e68f9767df4ff66); ?>
<?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end p-6 pt-0">
                                <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['variant' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary']); ?>Continuar <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- PAGINATION -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Pagination</h2>

            <div class="flex items-center justify-end gap-4">
                <span class="text-sm text-gray-600">1-50 de 1000</span>
                <div class="flex items-center gap-2">
                    <button class="p-2 rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50">
                        <?php if (isset($component)) { $__componentOriginaldaf5ec6ced2e3a1b979bb241323f28e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldaf5ec6ced2e3a1b979bb241323f28e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.arrow-left','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.arrow-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldaf5ec6ced2e3a1b979bb241323f28e7)): ?>
<?php $attributes = $__attributesOriginaldaf5ec6ced2e3a1b979bb241323f28e7; ?>
<?php unset($__attributesOriginaldaf5ec6ced2e3a1b979bb241323f28e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldaf5ec6ced2e3a1b979bb241323f28e7)): ?>
<?php $component = $__componentOriginaldaf5ec6ced2e3a1b979bb241323f28e7; ?>
<?php unset($__componentOriginaldaf5ec6ced2e3a1b979bb241323f28e7); ?>
<?php endif; ?>
                    </button>
                    <button class="p-2 rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50">
                        <?php if (isset($component)) { $__componentOriginal37a3f047daccd28b87517bd215a12923 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal37a3f047daccd28b87517bd215a12923 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.arrow-right','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.arrow-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal37a3f047daccd28b87517bd215a12923)): ?>
<?php $attributes = $__attributesOriginal37a3f047daccd28b87517bd215a12923; ?>
<?php unset($__attributesOriginal37a3f047daccd28b87517bd215a12923); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal37a3f047daccd28b87517bd215a12923)): ?>
<?php $component = $__componentOriginal37a3f047daccd28b87517bd215a12923; ?>
<?php unset($__componentOriginal37a3f047daccd28b87517bd215a12923); ?>
<?php endif; ?>
                    </button>
                </div>
            </div>
        </section>

        <!-- FILTER BAR -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Filter Bar</h2>

            <div class="flex flex-wrap items-center gap-3">
                <?php if (isset($component)) { $__componentOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.date-picker','data' => ['year' => 2023,'month' => '07','showMonth' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.date-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['year' => 2023,'month' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('07'),'showMonth' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e)): ?>
<?php $attributes = $__attributesOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e; ?>
<?php unset($__attributesOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e)): ?>
<?php $component = $__componentOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e; ?>
<?php unset($__componentOriginal7f4c83fa1ea8a66f8f2f54ce6cdbbc4e); ?>
<?php endif; ?>

                <div class="relative flex-1 min-w-[200px] max-w-xs">
                    <input
                        type="text"
                        placeholder="Pesquisar"
                        class="w-full pl-4 pr-10 py-2.5 bg-white border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100"
                    />
                    <?php if (isset($component)) { $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.search','data' => ['class' => 'absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a)): ?>
<?php $attributes = $__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a; ?>
<?php unset($__attributesOriginala0c73ad9511ae1934ff7056d4fc38e8a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a)): ?>
<?php $component = $__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a; ?>
<?php unset($__componentOriginala0c73ad9511ae1934ff7056d4fc38e8a); ?>
<?php endif; ?>
                </div>

                <div class="relative">
                    <select class="appearance-none pl-4 pr-10 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 cursor-pointer">
                        <option>Todas as carteiras</option>
                        <option>Binance</option>
                        <option>Mercado Bitcoin</option>
                    </select>
                    <?php if (isset($component)) { $__componentOriginalfb5ab559e4014313073efeb5cdff727a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb5ab559e4014313073efeb5cdff727a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.chevron-down','data' => ['class' => 'absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none']); ?>
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

                <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                    Filtro
                    <?php if (isset($component)) { $__componentOriginalfa68024704d8dee6dbc8b7204baf31f8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa68024704d8dee6dbc8b7204baf31f8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.filter','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.filter'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfa68024704d8dee6dbc8b7204baf31f8)): ?>
<?php $attributes = $__attributesOriginalfa68024704d8dee6dbc8b7204baf31f8; ?>
<?php unset($__attributesOriginalfa68024704d8dee6dbc8b7204baf31f8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfa68024704d8dee6dbc8b7204baf31f8)): ?>
<?php $component = $__componentOriginalfa68024704d8dee6dbc8b7204baf31f8; ?>
<?php unset($__componentOriginalfa68024704d8dee6dbc8b7204baf31f8); ?>
<?php endif; ?>
                </button>
            </div>
        </section>

        <!-- ICONS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Icons</h2>

            <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-4">
                <?php
                    $icons = [
                        'grid', 'wallet', 'credit-card', 'list', 'file-text',
                        'book', 'help-circle', 'bell', 'search', 'filter',
                        'calendar', 'chevron-down', 'chevron-right', 'arrow-left', 'arrow-right',
                        'x', 'more-vertical', 'check', 'info', 'plus',
                        'chart', 'trending-up', 'trending-down', 'refresh', 'download', 'menu',
                        'alert-circle'
                    ];
                ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-100">
                        <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => 'icons.' . $icon] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-6 h-6 text-gray-700']); ?>
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
                        <span class="text-xs text-gray-500"><?php echo e($icon); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>

        <!-- SIDEBAR ITEM -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Sidebar Item</h2>

            <div class="max-w-xs bg-sidebar-bg p-4 rounded-lg space-y-1">
                <?php if (isset($component)) { $__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.sidebar-item','data' => ['href' => '#','icon' => 'grid','active' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.sidebar-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#','icon' => 'grid','active' => true]); ?>
                    Dashboard
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53)): ?>
<?php $attributes = $__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53; ?>
<?php unset($__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53)): ?>
<?php $component = $__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53; ?>
<?php unset($__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.sidebar-item','data' => ['href' => '#','icon' => 'wallet','active' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.sidebar-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#','icon' => 'wallet','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                    Portfólio
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53)): ?>
<?php $attributes = $__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53; ?>
<?php unset($__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53)): ?>
<?php $component = $__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53; ?>
<?php unset($__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.sidebar-item','data' => ['href' => '#','icon' => 'credit-card','active' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.sidebar-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#','icon' => 'credit-card','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                    Carteiras
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53)): ?>
<?php $attributes = $__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53; ?>
<?php unset($__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53)): ?>
<?php $component = $__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53; ?>
<?php unset($__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.sidebar-item','data' => ['href' => '#','icon' => 'list','active' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.sidebar-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#','icon' => 'list','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                    Operações
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53)): ?>
<?php $attributes = $__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53; ?>
<?php unset($__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53)): ?>
<?php $component = $__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53; ?>
<?php unset($__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.sidebar-item','data' => ['href' => '#','icon' => 'file-text','active' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.sidebar-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#','icon' => 'file-text','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                    Declarações
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53)): ?>
<?php $attributes = $__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53; ?>
<?php unset($__attributesOriginalb6d3310b0106d3f43bc8aac2b68bbc53); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53)): ?>
<?php $component = $__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53; ?>
<?php unset($__componentOriginalb6d3310b0106d3f43bc8aac2b68bbc53); ?>
<?php endif; ?>
            </div>
        </section>

        <!-- COLORS -->
        <section class="mb-12">
            <h2 class="text-h1 text-gray-900 mb-6 pb-2 border-b border-gray-200">Cores do Design System</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <h3 class="text-h3 text-gray-700 mb-3">Primary</h3>
                    <div class="space-y-2">
                        <div class="h-10 rounded bg-primary-500 flex items-center justify-center text-white text-xs">#9333EA</div>
                        <div class="h-10 rounded bg-primary-600 flex items-center justify-center text-white text-xs">#7C3AED</div>
                        <div class="h-10 rounded bg-primary-100 flex items-center justify-center text-primary-700 text-xs">#F3E8FF</div>
                    </div>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-3">Success</h3>
                    <div class="space-y-2">
                        <div class="h-10 rounded bg-success-500 flex items-center justify-center text-white text-xs">#22C55E</div>
                        <div class="h-10 rounded bg-success-600 flex items-center justify-center text-white text-xs">#16A34A</div>
                        <div class="h-10 rounded bg-success-100 flex items-center justify-center text-success-700 text-xs">#DCFCE7</div>
                    </div>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-3">Danger</h3>
                    <div class="space-y-2">
                        <div class="h-10 rounded bg-danger-500 flex items-center justify-center text-white text-xs">#EF4444</div>
                        <div class="h-10 rounded bg-danger-600 flex items-center justify-center text-white text-xs">#DC2626</div>
                        <div class="h-10 rounded bg-danger-100 flex items-center justify-center text-danger-700 text-xs">#FEE2E2</div>
                    </div>
                </div>

                <div>
                    <h3 class="text-h3 text-gray-700 mb-3">Warning</h3>
                    <div class="space-y-2">
                        <div class="h-10 rounded bg-warning-500 flex items-center justify-center text-white text-xs">#F59E0B</div>
                        <div class="h-10 rounded bg-warning-600 flex items-center justify-center text-white text-xs">#D97706</div>
                        <div class="h-10 rounded bg-warning-100 flex items-center justify-center text-warning-700 text-xs">#FEF3C7</div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</body>
</html>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/components-preview.blade.php ENDPATH**/ ?>