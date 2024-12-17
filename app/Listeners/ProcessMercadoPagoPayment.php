<?php

namespace App\Listeners;

use App\Events\MercadoPagoPaymentUpdated;
use App\Models\Purchase;
use App\Services\MercadoPagoService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class ProcessMercadoPagoPayment
{
    /**
     * Create the event listener.
     */
    protected $mercadoPagoService;
    public function __construct(
        MercadoPagoService $mercadoPagoService
    ){
        $this->mercadoPagoService = $mercadoPagoService;
    }

    /**
     * Handle the event.
     */
    public function handle(MercadoPagoPaymentUpdated $event): void
    {
        Log::info("LLego al listener");
        $paymentData = $event->paymentData;
        $payment = $this->mercadoPagoService->getPaymentById($paymentData);


    }
}
