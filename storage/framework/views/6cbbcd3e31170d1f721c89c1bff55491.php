<?php if (isset($component)) { $__componentOriginal715f1bc2e7fb91351b727fc134e47f4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal715f1bc2e7fb91351b727fc134e47f4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.onboarding','data' => ['title' => 'Bem-vindo','step' => 1]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.onboarding'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Bem-vindo','step' => 1]); ?>
    <div class="flex flex-col items-center text-center gap-6">
        <!-- Título -->
        <h1 class="text-2xl font-semibold text-gray-900">Seja bem-vindo!</h1>

        <!-- Descrição -->
        <p class="text-sm text-gray-600 max-w-md">
            Mesmo você integrando suas carteiras ou operações, isso não será enviado a receita federal.
        </p>

        <!-- Botão -->
        <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['href' => ''.e(route('onboarding.select-platform')).'','variant' => 'primary','size' => 'lg','class' => 'rounded-full px-8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('onboarding.select-platform')).'','variant' => 'primary','size' => 'lg','class' => 'rounded-full px-8']); ?>
            Entendi!
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
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal715f1bc2e7fb91351b727fc134e47f4d)): ?>
<?php $attributes = $__attributesOriginal715f1bc2e7fb91351b727fc134e47f4d; ?>
<?php unset($__attributesOriginal715f1bc2e7fb91351b727fc134e47f4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal715f1bc2e7fb91351b727fc134e47f4d)): ?>
<?php $component = $__componentOriginal715f1bc2e7fb91351b727fc134e47f4d; ?>
<?php unset($__componentOriginal715f1bc2e7fb91351b727fc134e47f4d); ?>
<?php endif; ?>
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/onboarding/welcome.blade.php ENDPATH**/ ?>