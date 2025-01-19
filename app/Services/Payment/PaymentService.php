<?php

namespace App\Services\Payment;

use App\Models\Product;
use App\Models\Purchase;

class PaymentService
{
    protected $paymentMethodResolver;

    public function __construct(PaymentMethodResolver $paymentMethodResolver)
    {
        $this->paymentMethodResolver = $paymentMethodResolver;
    }

    /**
     * Procesa el pago según el método de pago seleccionado.
     *
     * @param Purchase $purchase
     * @param Product $product
     * @return mixed
     * @throws \Exception
     */
    public function processPayment($purchase)
    {
        $paymentMethod = $this->paymentMethodResolver->resolve($purchase->payment_method);
        $products = $purchase->items()->get();

        if (!$paymentMethod) {
            throw new \Exception('Payment method not supported: ' . $paymentMethod);
        }
        $response = $paymentMethod->pay($products);
        // dd($response);

        if ($purchase->payment_method === 'mercadopago' && is_object($response)) {
            // Guardar el external_reference para MercadoPago
            $purchase->external_reference = $response->external_reference;
            $purchase->save();
            // Retornar la URL de redirección
            return redirect($response->sandbox_init_point); // Usamos sandbox en desarrollo
        }

        if ($purchase->payment_method === 'crypto') {
            // Ejemplo: simulación de procesamiento de pago con criptomonedas
            return redirect()->route('payment.success')->with('success', 'Payment successful via crypto.');
        }

        if ($purchase->payment_method === 'points') {
            return redirect()->route('payment.success')->with('success', 'Payment successful, points have been subtracted.');
        }

        // Si no se logró procesar el pago
        throw new \Exception('Payment failed for method: ' . $purchase->payment_method);
    }
}
