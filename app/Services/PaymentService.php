<?php

namespace App\Services;

interface PaymentService
{
    public function createPaymentPreference($product);
    public function getPaymentPreference($exteral_reference);
}
