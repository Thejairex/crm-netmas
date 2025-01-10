<?php

namespace App\Providers;

use App\Services\MercadoPagoService;
use App\Services\PointsService;
use App\Services\PurchaseService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MercadoPagoService::class, function () {
            return new MercadoPagoService();
        });

        $this->app->singleton(PointsService::class, function () {
            return new PointsService();
        });

        $this->app->singleton(PurchaseService::class, function () {
            return new PurchaseService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
