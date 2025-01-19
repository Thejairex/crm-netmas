<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Services\Payment\PaymentService;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function index(): View
    {
        $cart = $this->getCart();
        return view('cart.index', compact('cart'));
    }

    public function add($productId)
    {
        $cart = $this->getCart();

        $item = $cart->items()->where('product_id', $productId)->first();
        if ($item) {
            $item->quantity++;
            $item->save();
        } else {
            $cart->items()->create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string|in:mercadopago,crypto,points',
        ]);
        $cart = $this->getCart();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }

        // Encabezar la compra
        $purchase = Purchase::create([
            'user_id' => auth()->id(),
            'total_amount' => $cart->items->sum(function ($item) {
                return $item->product->price * $item->quantity;
            }),
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        // Crear los items de compra
        $purchase->items()->createMany($cart->items->map(function ($item) use ($purchase) {
            return [
                'purchase_id' => $purchase->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->getTotalPrice(),
                'total' => $item->product->getTotalPrice() * $item->quantity
            ];
        }));

        $cart->items()->delete();
        return $this->paymentService->processPayment( $purchase);;
    }

    public function remove($productId)
    {
        $cart = $this->getCart();
        $item = $cart->items()->where('product_id', $productId)->first();
        if ($item) {
            $item->delete();
        }
        return redirect()->back()->with('success', 'Product removed from cart successfully.');
    }

    public function clear()
    {
        $cart = $this->getCart();
        $cart->items()->delete();
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }

    private function getCart()
    {
        return auth()->user()->cart ?? auth()->user()->cart()->create([]);
    }
}
