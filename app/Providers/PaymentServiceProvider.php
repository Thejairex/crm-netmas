<?php

namespace App\Providers;

use App\Services\Payment\PaymentService;
use App\Services\Payment\PaymentMethodResolver;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Registrar el resolver de métodos de pago
        $this->app->singleton(PaymentMethodResolver::class, function ($app) {
            return new PaymentMethodResolver(); // Resolver para gestionar todos los métodos de pago
        });

        // Registrar el servicio de pagos
        $this->app->singleton(PaymentService::class, function ($app) {
            return new PaymentService($app->make(PaymentMethodResolver::class));
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
