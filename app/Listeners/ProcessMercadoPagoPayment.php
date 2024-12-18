<?php

namespace App\Listeners;

use App\Events\MercadoPagoPaymentUpdated;
use App\Models\Product;
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
    ) {
        $this->mercadoPagoService = $mercadoPagoService;
    }

    /**
     * Handle the event.
     */
    public function handle(MercadoPagoPaymentUpdated $event): void
    {
        Log::info("LLego al listener");
        $paymentId = $event->paymentData['data']['id'];
        if (config('app.env') != 'local') {
            $payment = $this->mercadoPagoService->getPaymentById($paymentId);
            $purchase = Purchase::where('external_reference', $payment->external_reference)->first();
            $purchase->status = $payment->status;
            $purchase->save();
        } else {
            $purchase = Purchase::latest()->first();
            if ($purchase->status == 'pending') {
                $purchase->status = 'approved';
                $purchase->save();
            }
        }
        ;
    }
}
