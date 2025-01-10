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
        $this->pointsService->earnPoints($purchase);

        if ($product->category->name == 'Supplier Packages') {
            $user->role = 'supplier';
            $user->rank_id = 1;
            $user->save();
        }
    }

    public function registerPurchase()
    {

    }
}

