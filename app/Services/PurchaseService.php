<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class PurchaseService
{
    /**
     * Create a new class instance.
     */
    protected $commissionService, $pointsService, $rankService;
    public function __construct(
        CommissionService $commissionService,
        PointsService $pointsService,
        RankService $rankService
    ) {
        $this->commissionService = $commissionService;
        $this->pointsService = $pointsService;
        $this->rankService = $rankService;
    }


    public function processPurchase($purchase)
    {
        $user = $purchase->user;
        $product = $purchase->product;
        $this->commissionService->assingComission($purchase);
        Log::info("Commission assigned");
        if ($product->payment_method != 'points') {
            $this->pointsService->earnPoints($purchase);
            Log::info("Points earned");
        }

        if ($product->is_supplier_pack && $user->role != 'supplier') {
            Log::info("Starting supplier rank");
            $this->rankService->startUserRank($user);
            Log::info("Supplier rank started");
        }
    }

    public function registerPurchase()
    {

    }
}

