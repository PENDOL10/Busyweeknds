@extends('layouts.admin')
@section('title', 'Order Details')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow-lg max-w-2xl mx-auto">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Order #{{ $order->id }}</h3>
    <div class="space-y-4">
        <div>
            <p class="mb-2 text-sm text-gray-700">Customer: {{ $order->user->name }}</p>
            <p class="mb-2 text-sm text-gray-700">Total: IDR {{ number_format($order->total_amount, 0, ',', '.') }}</p>
            <p class="mb-2 text-sm text-gray-700">Status: 
                <span class="mb-2 px-2 py-1 rounded text-sm {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($order->status == 'proses' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p class="text-sm text-gray-700">Date: {{ $order->created_at->format('d M Y') }}</p>
        </div>
        <div>
            <h4 class="text-md font-semibold text-gray-700 mb-2">Items</h4>
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-600">
                        <th class="p-3">Product</th>
                        <th class="p-3">Size</th>
                        <th class="p-3">Qty</th>
                        <th class="p-3">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-t">
                            <td class="p-3">{{ $item->product->name }}</td>
                            <td class="p-3">{{ $item->size }}</td>
                            <td class="p-3">{{ $item->quantity }}</td>
                            <td class="p-3">IDR {{ number_format($item->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
            @csrf
            <div class="flex space-x-4 items-center">
                <label class="text-sm font-medium text-gray-700">Update Status:</label>
                <select name="status" class="select select-bordered" onchange="this.form.submit()">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
        </form>
    </div>
</div>
@endsection