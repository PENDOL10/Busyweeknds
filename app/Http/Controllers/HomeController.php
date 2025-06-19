<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Pastikan ini ada
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
            $categorySlug = $request->input('category');
            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        if ($request->has('size')) {
            // Updated to use whereJsonContains as 'sizes' is a JSON array
            $query->whereJsonContains('sizes', $request->size);
        }

        // Add sorting options if needed (e.g., price, latest)
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'latest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest(); // Default sort by latest
        }

        $products = $query->paginate(9);
        $categories = Category::all(); // Pass all categories to the view for filter options

        return view('customer-user.shop', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Use category_id for related products query
        $relatedProducts = Product::where('category_id', $product->category_id)
                                 ->where('id', '!=', $product->id)
                                 ->take(4)
                                 ->get();
        
        return view('customer-user.product-detail', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q', '');

        // You might want to search by category name too, which requires a join or separate query
        $products = Product::where('name', 'like', "%{$query}%")
                            // Example of searching by category name if needed:
                            // ->orWhereHas('category', function ($q) use ($query) {
                            //     $q->where('name', 'like', "%{$query}%");
                            // })
                           ->take(5)
                           ->get();

        return response()->json($products);
    }
}