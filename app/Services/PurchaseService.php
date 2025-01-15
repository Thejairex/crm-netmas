<?php

namespace App\Services;

class PurchaseService
{
    /**
     * Create a new class instance.
     */
    protected $commissionService, $pointsService;
    public function __construct(
        CommissionService $commissionService,
        PointsService $pointsService,
    ) {
        $this->commissionService = $commissionService;
        $this->pointsService = $pointsService;
    }


    public function processPurchase($purchase)
    {
        $user = $purchase->user;
        $product = $purchase->product;
        $this->commissionService->assingComission($purchase);

        if ($product->payment_method != 'points') {
            $this->pointsService->earnPoints($purchase);
        }
        if ($product->category->is_supplier_pack && $user->role == 'customer') {
            $user->role = 'supplier';
            $user->
            $user->save();
        }
    }

    public function registerPurchase()
    {

    }
}

