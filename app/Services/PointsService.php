<?php

namespace App\Services;

use App\Models\Purchase;

class PointsService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }


    /**
     * Register purchase with points by subtracting what the user has.
     *
     * @param \App\Models\Purchase $purchase
     * @return void
     */
    public function spendPoints(Purchase $purchase)
    {
        $user = $purchase->user;
        $points = $user->balance_points;
        $amount = $purchase->product->price;

        if ($points < $amount) {
            // TODO: add a better error handling
            abort(422, 'The user does not have enough points.');
        }

        $user->balance_points = $points - $amount;
        $user->save();

    }

    /**
     * Earn points for purchases made by the user.
     *
     * @param \App\Models\Purchase $purchase
     * @return void
     */
    public function earnPoints(Purchase $purchase)
    {
        $user = $purchase->user;
        $points = $user->balance_points;
        $amount = $purchase->product->price;

        $user->balance_points = $points + $amount;
        $user->save();
    }
}
