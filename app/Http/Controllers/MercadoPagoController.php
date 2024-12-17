<?php

namespace App\Http\Controllers;

use App\Events\MercadoPagoPaymentUpdated;
use Illuminate\Http\Request;
use Log;

class MercadoPagoController extends Controller
{
    public function webhook(Request $request)
    {
        $data = $request->all();
        Log::info($data);

        $eventType = $data['action'];
        if ($eventType == 'payment.created' || $eventType == 'payment.updated')  {
            event(new MercadoPagoPaymentUpdated($data));
        }

        return response()->json([
            'status' => 'success',], 200);

}

    public function success()
    {
        return view('payment.success');
    }

    public function failure()
    {
        return view('payment.failure');
    }

    public function pending()
    {
        return view('payment.pending');
    }
}
