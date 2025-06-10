<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,processing,completed']);
        $order->update(['status' => $request->status]);
        return redirect()->route('admin.orders.index')->with('success', 'Order status updated.');
    }
}