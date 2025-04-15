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

public function shop()
    {
        $products = Product::all();
        return view('customer-user.shop', compact('products'));
    }
}