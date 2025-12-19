<?php

namespace App\Providers;

use App\Events\WalletSyncCompleted;
use App\Events\WalletSyncFailed;
use App\Listeners\CreateSyncLogAfterSync;
use App\Listeners\LogWalletSyncFailure;
use App\Listeners\UpdateAssetBalancesAfterSync;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar Event Listeners
        Event::listen(
            WalletSyncCompleted::class,
            [
                UpdateAssetBalancesAfterSync::class,
                CreateSyncLogAfterSync::class,
            ]
        );

        Event::listen(
            WalletSyncFailed::class,
            [
                LogWalletSyncFailure::class,
            ]
        );
    }
}
