<?php

namespace App\Services\Payment;

class PaymentMethodResolver
{
    protected $methods;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->methods = [
            'mercadopago' => new mpPaymentMethod(),
            'points' => new PointsPaymentMethod()
        ];
    }

    public function resolve ($paymentMethod) {
        return $this->methods[$paymentMethod] ?? null;
    }
}
