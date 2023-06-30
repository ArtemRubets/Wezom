<?php

namespace App\Providers;

use App\Services\VehicleAPIService;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        $this->app->singleton(
            VehicleAPIService::class,
            fn () => new VehicleAPIService(
                (string) config('services.vehicles-api.url'),
            ),
        );
    }
}
