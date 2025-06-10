@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-gray-600">Total Products</h3>
            <p class="text-2xl font-bold text-navy-900">{{ $totalProducts }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-gray-600">Total Orders</h3>
            <p class="text-2xl font-bold text-navy-900">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-gray-600">Total Customers</h3>
            <p class="text-2xl font-bold text-navy-900">{{ $totalCustomers }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-gray-600">This Month's Revenue</h3>
            <p class="text-2xl font-bold text-navy-900">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Sales Last 6 Months</h3>
        <canvas id="salesChart" class="w-full h-64"></canvas>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Orders</h3>
        <table class="w-full">
            <thead>
                <tr class="text-left text-gray-600">
                    <th class="pb-2">Order ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentOrders as $order)
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Low Stock Alerts -->
    @if ($lowStockProducts->count())
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Low Stock Alerts</h3>
        <ul class="space-y-2">
            @foreach ($lowStockProducts as $product)
            <li class="text-red-600">Product "{{ $product->name }}" has only {{ $product->stock }} units left.</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($salesData['labels']),
            datasets: [{
                label: 'Sales (Rp)',
                data: @json($salesData['data']),
                borderColor: '#1e3a8a',
                backgroundColor: 'rgba(30, 58, 138, 0.1)',
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection