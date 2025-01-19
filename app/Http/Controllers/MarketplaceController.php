<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarketplaceController extends Controller
{
    public function index(): View
    {
        $query = Product::query();
        // filter by category
        if (request()->has('category') && request('category') !== null) {
            $query->where('category_id', request('category'));
        }

        // filter by price
        if (request()->has('min_price') && request('min_price') !== null) {
            $query->where('price', '>=', request('min_price'));
        }
        if (request()->has('max_price') && request('max_price') !== null) {
            $query->where('price', '<=', request('max_price'));
        }


        // order by
        if (request()->has('order') && request('order') !== null) {
            $query->orderBy('price', request('order') == 'asc' ? 'asc' : 'desc');
        }

        $products = $query->paginate(10);
        $categories = \App\Models\Category::all();
        return view('marketplace.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('marketplace.show', compact('product'));
    }
}
