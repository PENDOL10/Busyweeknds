<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Apply category filter if provided
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Apply size filter if provided
        if ($request->has('size')) {
            $query->where('size', 'like', '%' . $request->size . '%');
        }

        $products = $query->get();

        return view('customer-user.shop', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Get related products (same category)
        $relatedProducts = Product::where('category', $product->category)
                                ->where('id', '!=', $product->id)
                                ->take(4)
                                ->get();
        
        return view('customer-user.product-detail', compact('product', 'relatedProducts'));
    }
}