<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::take(3)->get();
        return view('index', compact('products'));
    }

    public function about()
    {
        return view('customer-user.about');
    }

    public function shop(Request $request)
    {
        $query = Product::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('size')) {
            $query->where('size', 'like', '%' . $request->size . '%');
        }

        $products = $query->paginate(9);

        return view('customer-user.shop', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        $relatedProducts = Product::where('category', $product->category)
                                ->where('id', '!=', $product->id)
                                ->take(4)
                                ->get();
        
        return view('customer-user.product-detail', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q', '');

        $products = Product::where('name', 'like', "%{$query}%")
                           ->orWhere('category', 'like', "%{$query}%")
                           ->take(5)
                           ->get();

        return response()->json($products);
    }
}