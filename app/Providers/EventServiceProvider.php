<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\MercadoPagoPaymentUpdated;
use App\Listeners\ProcessMercadoPagoPayment;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MercadoPagoPaymentUpdated::class => [
            ProcessMercadoPagoPayment::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
}
