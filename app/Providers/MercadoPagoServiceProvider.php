<?php

namespace App\Providers;

use App\Services\MercadoPagoService;
use Illuminate\Support\ServiceProvider;

class MercadoPagoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MercadoPagoService::class, function () {
            return new MercadoPagoService();
        });
    }
}
