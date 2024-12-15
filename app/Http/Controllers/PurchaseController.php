<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
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
        // dd($product);
        Purchase::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'payment_method' => $request->payment_method,
            'amount' => $product->calculateTotalPrice(),
            'status' => 'pending',
        ]);


        return redirect()->route('purchases.index')->with('success', 'Purchase completed successfully.');

    }

    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }
}
