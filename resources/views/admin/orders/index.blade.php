@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Manage Orders</h3>
        <div class="flex space-x-4">
            <select name="status" class="border rounded-lg px-4 py-2">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            <button onclick="this.closest('form').submit()" class="bg-navy-900 text-white px-4 py-2 rounded-lg">Filter</button>
        </div>
    </div>
    <table class="w-full">
        <thead>
            <tr class="text-left text-gray-600">
                <th class="pb-2">Order ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr class="border-t">
                <td class="py-2">{{ $order->id }}</td>
                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                <td>
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
                <td class="space-x-2">
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-navy-600 hover:text-navy-800">View</a>
                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="inline">
                        @csrf
                        @method('POST')
                        <select name="status" onchange="this.form.submit()" class="border rounded-lg px-2 py-1 text-sm">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection