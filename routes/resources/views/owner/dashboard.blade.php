@extends('layouts.owner')

@section('title', 'Owner Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-slate-200 mb-8">
        <div class="px-6 py-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Business Overview</h1>
                    <p class="text-slate-600 mt-1">Your store performance at a glance</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-slate-500">Today</p>
                        <p class="text-lg font-semibold text-slate-700">{{ now()->format('M d, Y') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
                    {{-- Tombol untuk melihat halaman pengguna --}}
        @if(Auth::user()->utype === 'OWN')
            <a href="{{ route('customer-user.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition-all hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 16 16">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.929">
                        <path d="M8 3.895C12.447 3.895 14.5 8 14.5 8s-2.053 4.105-6.5 4.105S1.5 8 1.5 8S3.553 3.895 8 3.895Z"></path>
                        <path d="M9.94 8a2 2 0 1 1-3.999 0a2 2 0 0 1 4 0Z"></path>
                    </g>
                </svg>          
                View My User Dashboard
            </a>
        @endif
        </div>
    </div>

    <div class="px-6 pb-8">
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Revenue Card -->
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm font-medium">Monthly Revenue</p>
                        <p class="text-2xl font-bold mt-2">IDR {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                        <p class="text-emerald-200 text-xs mt-1">+12% from last month</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-400 bg-opacity-30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Orders Card -->
            <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm font-medium">Total Orders</p>
                        <p class="text-2xl font-bold mt-2">{{ number_format($totalOrders) }}</p>
                        <p class="text-amber-200 text-xs mt-1">All time orders</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-400 bg-opacity-30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Products Card -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Products</p>
                        <p class="text-2xl font-bold mt-2">{{ number_format($totalProducts) }}</p>
                        <p class="text-blue-200 text-xs mt-1">Active products</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-400 bg-opacity-30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Customers Card -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Total Customers</p>
                        <p class="text-2xl font-bold mt-2">{{ number_format($totalCustomers) }}</p>
                        <p class="text-purple-200 text-xs mt-1">Registered users</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-400 bg-opacity-30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Tables Section -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Sales Chart -->
            <div class="xl:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-800">Sales Analytics</h3>
                            <p class="text-slate-600 text-sm">Revenue performance over time</p>
                        </div>
                        <select id="chartPeriod" class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 px-3 py-2">
                            <option value="last_7_days" {{ $salesPeriod == 'last_7_days' ? 'selected' : '' }}>Last 7 Days</option>
                            <option value="last_30_days" {{ $salesPeriod == 'last_30_days' ? 'selected' : '' }}>Last 30 Days</option>
                            <option value="last_6_months" {{ $salesPeriod == 'last_6_months' ? 'selected' : '' }}>Last 6 Months</option>
                            <option value="last_12_months" {{ $salesPeriod == 'last_12_months' ? 'selected' : '' }}>Last 12 Months</option>
                        </select>
                    </div>
                    <div class="h-80">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Low Stock Products -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Stock Alert</h3>
                        <p class="text-slate-600 text-sm">Products running low</p>
                    </div>
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                </div>
                
                @if($lowStockProducts->count() > 0)
                    <div class="space-y-4">
                        @foreach($lowStockProducts as $product)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                            <div class="flex-1">
                                <p class="font-medium text-slate-800 text-sm">{{ Str::limit($product->name, 20) }}</p>
                                <p class="text-xs text-slate-500">{{ $product->category->name ?? 'Uncategorized' }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    {{ $product->stock == 0 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $product->stock }} left
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <p class="text-slate-600 text-sm">All products are well stocked!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Orders & Export Section -->
        <div class="mt-8 grid grid-cols-1 xl:grid-cols-4 gap-8">
            <!-- Recent Orders Table -->
            <div class="xl:col-span-3">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-800">Recent Orders</h3>
                            <p class="text-slate-600 text-sm">Latest customer orders</p>
                        </div>
                        <a href="{{ route('owner.print-report') }}" target="_blank" 
                           class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export Report
                        </a>
                    </div>
                    
                    @if($recentOrders->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-slate-200">
                                        <th class="text-left py-3 px-4 font-medium text-slate-700 text-sm">Order ID</th>
                                        <th class="text-left py-3 px-4 font-medium text-slate-700 text-sm">Customer</th>
                                        <th class="text-left py-3 px-4 font-medium text-slate-700 text-sm">Total</th>
                                        <th class="text-left py-3 px-4 font-medium text-slate-700 text-sm">Status</th>
                                        <th class="text-left py-3 px-4 font-medium text-slate-700 text-sm">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders->take(5) as $order)
                                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors duration-150">
                                        <td class="py-4 px-4">
                                            <span class="font-mono text-sm text-slate-800">#{{ $order->id }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div>
                                                <p class="font-medium text-slate-800 text-sm">{{ $order->user->name ?? 'Guest' }}</p>
                                                <p class="text-xs text-slate-500">{{ $order->user->email ?? 'N/A' }}</p>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="font-semibold text-slate-800">IDR {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $order->status == 'selesai' ? 'bg-green-100 text-green-800' : 
                                                   ($order->status == 'proses' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="text-sm text-slate-600">{{ $order->created_at->format('M d, Y') }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <p class="text-slate-600">No orders yet</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div>
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-lg font-semibold text-slate-800 mb-6">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('owner.print-report') }}" target="_blank" 
                           class="flex items-center p-3 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="font-medium text-sm">Print Report</span>
                        </a>
                        
                        <button onclick="window.print()" 
                                class="w-full flex items-center p-3 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            <span class="font-medium text-sm">Print Dashboard</span>
                        </button>
                        
                        <div class="mt-6 p-4 bg-slate-50 rounded-lg">
                            <h4 class="font-medium text-slate-800 text-sm mb-2">Business Insights</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Your store is performing well this month with steady growth in both orders and revenue.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart configuration
    const ctx = document.getElementById('salesChart').getContext('2d');
    const labels = @json($salesLabels);
    const data = @json($salesData);
    
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue (IDR)',
                data: data,
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)'
                    },
                    ticks: {
                        color: '#64748b',
                        callback: function(value) {
                            return 'IDR ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)'
                    },
                    ticks: {
                        color: '#64748b'
                    }
                }
            },
            elements: {
                point: {
                    hoverBackgroundColor: '#10b981'
                }
            }
        }
    });

    // Period selector functionality
    document.getElementById('chartPeriod').addEventListener('change', function() {
        const period = this.value;
        window.location.href = '{{ route("owner.dashboard") }}?period=' + period;
    });
});
</script>
@endsection