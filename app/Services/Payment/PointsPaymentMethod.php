<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Log;


class PointsPaymentMethod implements PaymentMethod
{

    public function pay($purchase)
    {
        $user = $purchase->user;
        $points = $user->balance_points;
        $amount = $purchase->product->price;

        if ($points < $amount) {
            // TODO: add a better error handling
            return response()->json([
                'error' => 'The user does not have enough points.',
                'current_points' => $points,
                'required_points' => $amount
            ], 422);
        }

        \DB::beginTransaction();
        try {
            $user->balance_points = $points - $amount;
            $user->save();

            $purchase->status = 'approved';
            $purchase->save();

            \DB::commit();

            return response()->json([
                'message' => 'Payment successful.',
                'current_points' => $user->balance_points
            ], 200);

        } catch (\Exception $e) {
            \DB::rollBack();
            Log::error("Error al realizar el pago", [
                'message' => $e->getMessage(),
                'purchase_id' => $purchase->id
            ]);

            return response()->json([
                'error' => 'Error al realizar el pago'
            ], 500);
        }


    }

    public function getPaymentMethod($purchaseId)
    {
        return null;
    }
}
