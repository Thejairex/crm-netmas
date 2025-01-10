<?php

namespace App\Listeners;

use App\Events\MercadoPagoPaymentUpdated;
use App\Models\Purchase;
use App\Services\CommissionService;
use App\Services\MercadoPagoService;
use App\Services\PointsService;
use App\Services\PurchaseService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class ProcessMercadoPagoPayment
{
    /**
     * Create the event listener.
     */
    protected $purchaseService, $mercadoPagoService;
    public function __construct(PurchaseService $purchaseService,
                                MercadoPagoService $mercadoPagoService,)
    {

        $this->purchaseService = $purchaseService;
        $this->mercadoPagoService = $mercadoPagoService;
    }

    /**
     * Handle the event.
     */
    public function handle(MercadoPagoPaymentUpdated $event): void
    {
        Log::info("LLego al listener");

        $paymentId = $event->paymentData['data']['id'];

        // Si no estamos en local, obtenemos el pago y actualizamos el estado
        if (config('app.env') != 'local') {
            $payment = $this->mercadoPagoService->getPaymentById($paymentId);

            $purchase = Purchase::where('external_reference', $payment->external_reference)->first();
            $purchase->status = $payment->status;
            $purchase->save();

            // Si estamos en local, obtenemos el último pago pendiente y actualizamos el estado
        } else {
            $purchase = Purchase::latest()->first();
            if ($purchase->status == 'pending') {
                $purchase->status = 'approved';
                $purchase->save();
            }
        }

        $this->purchaseService->processPurchase($purchase);
    }
}

