@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="w-full h-full space-y-8">
    <div class="mb-6">
        <h2 class="text-4xl font-bold text-slate-900">Welcome back, {{ Auth::user()->name }}!</h2>
        <p class="mt-2 text-lg text-slate-600">Get a stylish snapshot of your store's performance today.</p>

        {{-- Tombol untuk melihat halaman pengguna --}}
        @if(Auth::user()->utype === 'ADM')
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

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 p-6 text-white shadow-xl hover:-translate-y-2 transition-transform duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium">Monthly Revenue</p>
                    <p class="mt-2 text-3xl font-bold">IDR {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M327.027 65.816L229.79 128.23l9.856 5.397l86.51-55.53l146.735 83.116l-84.165 54.023l4.1 2.244v6.848l65.923-42.316l13.836 7.838l-79.76 51.195v11.723l64.633-41.487l15.127 8.57l-79.76 51.195v11.723l64.633-41.487l15.127 8.57l-79.76 51.195v11.723l100.033-64.21l-24.828-14.062l24.827-15.937l-24.828-14.064l24.827-15.937l-23.537-13.333l23.842-15.305zm31.067 44.74c-21.038 10.556-49.06 12.342-68.79 4.383l-38.57 24.757l126.903 69.47l36.582-23.48c-14.41-11.376-13.21-28.35 2.942-41.67zM227.504 147.5l-70.688 46.094l135.61 78.066l1.33-.85c2.5-1.61 6.03-3.89 10.242-6.613c8.42-5.443 19.563-12.66 30.674-19.86c16.002-10.37 24.248-15.72 31.916-20.694zm115.467 1.17a8.583 14.437 82.068 0 1 .003 0a8.583 14.437 82.068 0 1 8.32 1.945a8.583 14.437 82.068 0 1-.87 12.282a8.583 14.437 82.068 0 1-20.273 1.29a8.583 14.437 82.068 0 1 .87-12.28a8.583 14.437 82.068 0 1 11.95-3.237m-218.423 47.115L19.143 263.44l23.537 13.333l-23.842 15.305l24.828 14.063l-24.828 15.938l24.828 14.063l-24.828 15.938l166.135 94.106L285.277 381.8v-11.72l-99.433 63.824L39.11 350.787l14.255-9.15l131.608 74.547L285.277 351.8v-11.72l-99.433 63.824L39.11 320.787l14.255-9.15l131.608 74.547L285.277 321.8v-11.72l-99.433 63.824L39.11 290.787l13.27-8.52l132.9 75.28l99.997-64.188v-5.05l-5.48-3.154l-93.65 60.11l-146.73-83.116l94.76-60.824l-9.63-5.543zm20.46 11.78l-46.92 30.115c14.41 11.374 13.21 28.348-2.942 41.67l59.068 33.46c21.037-10.557 49.057-12.342 68.787-4.384l45.965-29.504l-123.96-71.358zm229.817 32.19c-8.044 5.217-15.138 9.822-30.363 19.688a36222 36222 0 0 1-30.69 19.873c-4.217 2.725-7.755 5.01-10.278 6.632c-.09.06-.127.08-.215.137v85.924l71.547-48.088zm-200.99 17.48a8.583 14.437 82.068 0 1 8.32 1.947a8.583 14.437 82.068 0 1-.87 12.28a8.583 14.437 82.068 0 1-20.27 1.29a8.583 14.437 82.068 0 1 .87-12.28a8.583 14.437 82.068 0 1 11.95-3.236z"></path>
                </svg>              
                </div>
            </div>
        </div>
        <div class="rounded-2xl bg-gradient-to-br from-green-500 to-green-700 p-6 text-white shadow-xl hover:-translate-y-2 transition-transform duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium">Total Orders</p>
                    <p class="mt-2 text-3xl font-bold">{{ $totalOrders }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 16 16">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M6 2.5H3.5v12h9v-12H10m-5 9h6m-5-8h4l.5-2h-5zM6 10l1.5-.5l3-3l-1-1l-3 3z" stroke-width="1"></path>
                </svg>                
                </div>
            </div>
        </div>
        <div class="rounded-2xl bg-gradient-to-br from-sky-500 to-sky-700 p-6 text-white shadow-xl hover:-translate-y-2 transition-transform duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium">Total Customers</p>
                    <p class="mt-2 text-3xl font-bold">{{ $totalCustomers }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                        <path d="M12 12a4 4 0 1 0 0-8a4 4 0 0 0 0 8"></path>
                        <path d="M22 17.28a2.28 2.28 0 0 1-.662 1.606c-.976.984-1.923 2.01-2.936 2.958a.597.597 0 0 1-.823-.017l-2.918-2.94a2.28 2.28 0 0 1 0-3.214a2.277 2.277 0 0 1 3.233 0l.106.107l.106-.107A2.277 2.277 0 0 1 22 17.28Z"></path>
                        <path d="M5 20v-1a7 7 0 0 1 10-6.326"></path>
                    </g>
                </svg>
                </div>
            </div>
        </div>
        <div class="rounded-2xl bg-gradient-to-br from-amber-500 to-amber-700 p-6 text-white shadow-xl hover:-translate-y-2 transition-transform duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium">Total Products</p>
                    <p class="mt-2 text-3xl font-bold">{{ $totalProducts }}</p>
                </div>
                <div class="rounded-full bg-white/20 p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 1024 1024">
                    <path fill="currentColor" fill-rule="evenodd" d="M464 144c8.837 0 16 7.163 16 16v304c0 8.836-7.163 16-16 16H160c-8.837 0-16-7.164-16-16V160c0-8.837 7.163-16 16-16zm-52 68H212v200h200zm493.333 87.686c6.248 6.248 6.248 16.379 0 22.627l-181.02 181.02c-6.248 6.248-16.378 6.248-22.627 0l-181.019-181.02c-6.248-6.248-6.248-16.379 0-22.627l181.02-181.02c6.248-6.248 16.378-6.248 22.627 0zm-84.853 11.313L713 203.52L605.52 311L713 418.48zM464 544c8.837 0 16 7.164 16 16v304c0 8.837-7.163 16-16 16H160c-8.837 0-16-7.163-16-16V560c0-8.836 7.163-16 16-16zm-52 68H212v200h200zm452-68c8.837 0 16 7.164 16 16v304c0 8.837-7.163 16-16 16H560c-8.837 0-16-7.163-16-16V560c0-8.836 7.163-16 16-16zm-52 68H612v200h200z"></path>
                </svg>                
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="rounded-2xl bg-white p-6 shadow-xl lg:col-span-2">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-slate-900">Sales Analytics</h3>
                <select id="sales-period-filter" class="rounded-xl border border-slate-300 text-sm focus:border-brand-500 focus:ring-brand-500 transition-all">
                    <option value="last_7_days">Last 7 Days</option>
                    <option value="last_30_days" selected>Last 30 Days</option>
                    <option value="last_6_months">Last 6 Months</option>
                    <option value="last_12_months">Last 12 Months</option>
                </select>
            </div>
            <div class="mt-4 h-72">
                <div id="chart-loading" class="flex h-full items-center justify-center">
                    <div class="flex flex-col items-center text-slate-400">
                        <svg class="animate-spin h-8 w-8 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span>Loading Chart...</span>
                    </div>
                </div>
                <canvas id="salesChart" style="display: none;"></canvas>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-xl">
            <h3 class="text-xl font-semibold text-slate-900">Low Stock Products</h3>
            <p class="text-sm text-slate-500 mt-1">Products with stock less than 5 units.</p>
            <div class="mt-4 space-y-4">
                @forelse($lowStockProducts as $product)
                <a href="{{ route('admin.products.edit', $product->id) }}" class="flex items-center gap-4 p-3 rounded-xl bg-brand-50 hover:bg-brand-100 transition-all group">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 rounded-lg object-cover border border-slate-200">
                    <div class="flex-1">
                        <p class="font-semibold text-slate-700 group-hover:text-brand-700 transition-colors">{{ $product->name }}</p>
                        <p class="text-sm text-slate-500">{{ $product->category->name ?? 'N/A' }}</p>
                    </div>
                    <div class="text-right">
                        <span class="font-bold text-red-500 text-lg">{{ $product->stock }}</span>
                        <p class="text-xs text-slate-400">in stock</p>
                    </div>
                </a>
                @empty
                <div class="flex flex-col items-center justify-center text-center py-6 h-full">
                    <div class="bg-green-100 rounded-full p-3 mb-2">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                    </div>
                    <p class="text-slate-500 font-medium">All stock is safe!</p>
                    <p class="text-sm text-slate-400">No products with low stock.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="rounded-2xl bg-white p-6 shadow-xl">
        <h3 class="text-xl font-semibold text-slate-900 mb-4">Recent Orders</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b-2 border-slate-200">
                    <tr class="text-sm font-semibold text-slate-600">
                        <th class="px-6 py-3">Order ID</th>
                        <th class="px-6 py-3">Customer</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-800">#{{ $order->id }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 text-slate-600">IDR {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span @class([
                                'inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium',
                                'bg-yellow-100 text-yellow-800' => $order->status == 'pending',
                                'bg-blue-100 text-blue-800' => $order->status == 'proses',
                                'bg-green-100 text-green-800' => $order->status == 'selesai',
                                'bg-red-100 text-red-800' => $order->status == 'dibatalkan',
                            ])>
                                <span @class([
                                    'h-2 w-2 rounded-full',
                                    'bg-yellow-600' => $order->status == 'pending',
                                    'bg-blue-600' => $order->status == 'proses',
                                    'bg-green-600' => $order->status == 'selesai',
                                    'bg-red-600' => $order->status == 'dibatalkan',
                                ])></span>
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center justify-center rounded-xl bg-brand-100 p-2 text-brand-700 hover:bg-brand-200 transition-all">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-slate-500">
                            No recent orders found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesPeriodFilter = document.getElementById('sales-period-filter');
    const chartLoading = document.getElementById('chart-loading');
    const chartCanvas = document.getElementById('salesChart');
    let salesChart;

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                mode: 'index',
                intersect: false,
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#fff',
                bodyColor: '#fff',
                borderColor: '#8f63e3',
                borderWidth: 1,
                callbacks: {
                    label: function(context) {
                        return 'Sales: IDR ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    padding: 10,
                    callback: function(value) {
                        if (value >= 1000000) {
                            return 'IDR ' + (value / 1000000).toFixed(1) + 'M';
                        }
                        if (value >= 1000) {
                            return 'IDR ' + (value / 1000).toFixed(0) + 'K';
                        }
                        return 'IDR ' + new Intl.NumberFormat('id-ID').format(value);
                    }
                },
                grid: {
                    drawBorder: false,
                    color: '#e2e8f0'
                }
            },
            x: {
                ticks: {
                    padding: 10
                },
                grid: {
                    display: false
                }
            }
        },
        interaction: {
            mode: 'nearest',
            intersect: false
        }
    };
    
    async function fetchSalesData() {
        // Show loading
        chartLoading.style.display = 'flex';
        chartCanvas.style.display = 'none';

        const period = salesPeriodFilter.value;
        
        try {
            const response = await fetch(`{{ route('admin.dashboard.sales-data') }}?period=${period}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            
            // Destroy existing chart
            if (salesChart) {
                salesChart.destroy();
            }

            // Create new chart
            salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: result.labels || [],
                    datasets: [{
                        label: 'Sales',
                        data: result.data || [],
                        borderColor: '#8f63e3',
                        backgroundColor: 'rgba(143, 99, 227, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#8f63e3',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#8f63e3',
                        pointHoverBorderWidth: 3,
                        pointHoverRadius: 7,
                    }]
                },
                options: chartOptions
            });

            // Hide loading and show chart
            chartLoading.style.display = 'none';
            chartCanvas.style.display = 'block';

        } catch (error) {
            console.error('Failed to fetch sales data:', error);
            
            // Hide loading
            chartLoading.style.display = 'none';
            
            // Show error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'flex h-full items-center justify-center';
            errorDiv.innerHTML = `
                <div class="flex flex-col items-center text-red-500">
                    <svg class="h-8 w-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.982 4c-.77-.833-2.072-.833-2.842 0L4.472 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    <span>Failed to load chart data</span>
                </div>
            `;
            chartCanvas.parentNode.appendChild(errorDiv);
        }
    }
    
    // Event listener for period filter
    salesPeriodFilter.addEventListener('change', fetchSalesData);
    
    // Initial load
    fetchSalesData();
});
</script>
@endsection