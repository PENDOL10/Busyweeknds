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

        // Terapkan filter kategori jika disediakan
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Terapkan filter ukuran jika disediakan
        if ($request->has('size')) {
            $query->where('size', 'like', '%' . $request->size . '%');
        }

        $products = $query->get();

        return view('customer-user.shop', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Ambil produk terkait (kategori sama)
        $relatedProducts = Product::where('category', $product->category)
                                ->where('id', '!=', $product->id)
                                ->take(4)
                                ->get();
        
        return view('customer-user.product-detail', compact('product', 'relatedProducts'));
    }
}