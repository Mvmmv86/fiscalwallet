<?php
    $exchangeNames = [
        'binance' => 'Binance',
        'coinbase' => 'Coinbase',
        'metamask' => 'MetaMask',
        'mercado-bitcoin' => 'Mercado Bitcoin',
        'foxbit' => 'Foxbit',
        'kraken' => 'Kraken',
        'kucoin' => 'Kucoin',
    ];
    $exchangeName = $exchangeNames[$exchange ?? 'binance'] ?? 'Exchange';
?>

<?php if (isset($component)) { $__componentOriginal715f1bc2e7fb91351b727fc134e47f4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal715f1bc2e7fb91351b727fc134e47f4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.onboarding','data' => ['title' => 'Conectar com '.e($exchangeName).'','step' => 3]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.onboarding'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Conectar com '.e($exchangeName).'','step' => 3]); ?>
    <div class="flex flex-col items-center gap-6" x-data="{ importType: 'automatic' }">
        <!-- Título -->
        <div class="text-center">
            <h1 class="text-2xl font-semibold text-gray-900">Conectar com a <?php echo e($exchangeName); ?></h1>
        </div>

        <!-- Campo Nome da Carteira -->
        <div class="w-full max-w-md">
            <?php if (isset($component)) { $__componentOriginal65bd7e7dbd93cec773ad6501ce127e46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal65bd7e7dbd93cec773ad6501ce127e46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.input','data' => ['type' => 'text','name' => 'wallet_name','label' => 'Digite o nome da carteira','placeholder' => 'Pesquisar','iconRight' => 'search','rounded' => 'full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'wallet_name','label' => 'Digite o nome da carteira','placeholder' => 'Pesquisar','iconRight' => 'search','rounded' => 'full']); ?>
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

        <!-- Seção Importar Operações -->
        <div class="flex flex-col gap-3 w-full max-w-md">
            <label class="text-sm font-medium text-gray-700">Importar operações</label>

            <!-- Opção Importação Automática -->
            <label
                @click="importType = 'automatic'"
                :class="importType === 'automatic' ? 'border-primary-500 bg-primary-50' : 'border-gray-200 bg-white'"
                class="flex items-center gap-3 p-4 rounded-xl border hover:border-primary-500 cursor-pointer transition-all"
            >
                <input type="radio" name="import_type" value="automatic" x-model="importType" class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500">
                <span class="text-sm text-gray-700">Importação automática</span>
            </label>

            <!-- Opção Importação Manual -->
            <label
                @click="importType = 'manual'"
                :class="importType === 'manual' ? 'border-primary-500 bg-primary-50' : 'border-gray-200 bg-white'"
                class="flex items-center gap-3 p-4 rounded-xl border hover:border-primary-500 cursor-pointer transition-all"
            >
                <input type="radio" name="import_type" value="manual" x-model="importType" class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500">
                <span class="text-sm text-gray-700">Importação manual</span>
            </label>
        </div>

        <!-- Botão Continuar -->
        <div class="flex justify-end w-full max-w-md">
            <a
                :href="importType === 'automatic' ? '<?php echo e(route('onboarding.import-automatic', ['exchange' => $exchange])); ?>' : '<?php echo e(route('onboarding.import-manual', ['exchange' => $exchange])); ?>'"
                class="inline-flex items-center justify-center font-medium rounded-full px-6 py-2 text-sm bg-primary-600 text-white hover:bg-primary-700 transition-colors"
            >
                Continuar
            </a>
        </div>
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
<?php /**PATH C:\Users\marcu\fiscalwallet\resources\views/onboarding/connect-exchange.blade.php ENDPATH**/ ?>