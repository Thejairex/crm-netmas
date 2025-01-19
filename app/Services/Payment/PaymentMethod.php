<?php

namespace App\Services\Payment;

interface PaymentMethod
{
    public function pay($products);
    public function getPaymentMethod($paymentId);
}
