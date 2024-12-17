<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Services\MercadoPagoService;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    protected $mercadoPagoService;
    public function __construct(
        MercadoPagoService $mercadoPagoService
    ){
        $this->mercadoPagoService = $mercadoPagoService;
    }

    public function index()
    {
        $purchases = Purchase::where('user_id', auth()->id())->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create($id)
    {
        $product = Product::findOrFail($id);
        return view('purchases.create', compact('product'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'payment_method' => 'required|string|in:mercadopago,crypto,points',
        ]);

        $product = Product::findOrFail($request->product_id);

        $purchase = new Purchase();
        $purchase->user_id = auth()->id();
        $purchase->product_id = $product->id;
        $purchase->payment_method = $request->payment_method;
        $purchase->amount = $product->calculateTotalPrice();
        $purchase->status = 'pending';

        if ($request->payment_method == 'mercadopago') {
            $preference = $this->mercadoPagoService->createPaymentPreference($product);

            if (is_string($preference)) {
                $purchase->delete();
                return redirect()->route('purchases.create', $product->id)->with('error', $preference);
            }
            $purchase->external_reference = $preference->external_reference;
        }

        $purchase->save();

        // return redirect($preference->init_point); // Production
        return redirect($preference->sandbox_init_point); // Local
    }

    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }
}
