<?php

namespace App\Providers;

use App\Events\PointsUpdated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\MercadoPagoPaymentUpdated;
use App\Listeners\ProcessMercadoPagoPayment;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MercadoPagoPaymentUpdated::class => [
            ProcessMercadoPagoPayment::class,
        ],
        PointsUpdated::class => [
            \App\Listeners\UpdateRank::class
        ]
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
