<?php

namespace App\Services;

use App\Models\Commission;

class CommissionService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
    }

    public function calculateCommission($amount) {
        return $amount * 0.05;
    }

    public function assingComission($purchase) {
        $comission = new Commission();
        $comission->user_id = $purchase->user_id;
        $comission->purchase_id = $purchase->id;
        $comission->amount = $this->calculateCommission($purchase->amount);
        $comission->save();

        return true;
    }
}
