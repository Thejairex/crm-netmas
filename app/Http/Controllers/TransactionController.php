<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create($id)
    {
        $service = Service::findOrFail($id);
        return view('transactions.create', compact('service'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'payment_method' => 'required|string|in:cash,crypto,points',
        ]);
        $service = Service::findOrFail($request->service_id);
        Transaction::create([
            'user_id' => Auth::id(),
            'service_id' => $service->id,
            'amount' => $service->price - ($service->price * ($service->discount / 100)),
            'payment_method' => $request->payment_method,
            'status' => 'completed',
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction completed successfully.');
    }
}
