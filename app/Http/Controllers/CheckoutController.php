<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function saveCartForCheckout(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Please login to proceed.']);
        }

        $cart = $request->input('cart', []);
        
        if (!is_array($cart) || empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Invalid cart data']);
        }

        Cookie::queue('cart', json_encode($cart), 1440);

        return response()->json(['success' => true]);
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }

        $cart = json_decode(request()->cookie('cart') ?? '[]', true);
        $subtotal = array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
        $shippingCost = 40000;
        $total = $subtotal + $shippingCost;

        return view('customer-user.checkout', compact('cart', 'subtotal', 'shippingCost', 'total'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to complete your purchase.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'phone' => 'required|string|max:15',
            'payment_proof' => 'required|image|max:2048',
        ]);
        
        $cart = json_decode(request()->cookie('cart') ?? '[]', true);
        $subtotal = array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
        $shippingCost = 40000;
        $total = $subtotal + $shippingCost;

        $order = Order::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'apartment' => $request->apartment,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'shipping_cost' => $shippingCost,
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $order->update(['payment_proof' => $path]);
        }

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'size' => $item['size'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            $product = Product::find($item['id']);
            if ($product) {
                $product->decrement('stock', $item['quantity']);
            }
        }

        Cookie::queue(Cookie::forget('cart'));

        return redirect()->route('order.success')->with('success', 'Order placed successfully!');
    }

    public function success()
    {
        return view('customer-user.order-success');
    }

    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add items to your cart.');
        }

        $cart = json_decode(request()->cookie('cart') ?? '[]', true);

        $item = [
            'id' => $request->product_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'size' => $request->size,
            'quantity' => $request->quantity ?? 1,
        ];

        $itemExists = false;
        foreach ($cart as &$cartItem) {
            if ($cartItem['id'] == $item['id'] && $cartItem['size'] == $item['size']) {
                $cartItem['quantity'] += $item['quantity'];
                $itemExists = true;
                break;
            }
        }

        if (!$itemExists) {
            $cart[] = $item;
        }

        Cookie::queue('cart', json_encode($cart), 1440);

        return redirect()->back()->with('success', 'Item added to cart!');
    }
}