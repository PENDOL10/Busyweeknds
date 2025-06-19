@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-slate-200">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h3 class="text-2xl font-bold text-slate-800">Orders</h3>
            <p class="text-sm text-slate-500 mt-1">Manage and track all customer orders.</p>
        </div>
        <form action="{{ route('admin.orders.index') }}" method="GET">
            <div class="flex items-center gap-2">
                <select name="status" class="rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Processing</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Completed</option>
                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="bg-[#010BEB] text-white px-4 py-2 rounded-lg hover:bg-brand-700 transition-colors text-sm">Filter</button>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50">
                <tr class="text-xs text-slate-600 uppercase">
                    <th class="px-5 py-3 font-semibold">Order</th>
                    <th class="px-5 py-3 font-semibold">Date</th>
                    <th class="px-5 py-3 font-semibold">Customer</th>
                    <th class="px-5 py-3 font-semibold">Total</th>
                    <th class="px-5 py-3 font-semibold text-center">Status</th>
                    <th class="px-5 py-3 font-semibold text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-b border-slate-200 hover:bg-slate-50 transition-colors">
                    <td class="px-5 py-4">
                        <p class="font-bold text-slate-800">#{{ $order->id }}</p>
                    </td>
                    <td class="px-5 py-4 text-slate-600">{{ $order->created_at->format('d M Y, H:i') }}</td>
                    <td class="px-5 py-4">{{ $order->user->name }}</td>
                    <td class="px-5 py-4 font-medium">IDR {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="px-5 py-4 text-center">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'proses' => 'bg-blue-100 text-blue-800',
                                'selesai' => 'bg-green-100 text-green-800',
                                'dibatalkan' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        <span class="px-3 py-1 text-xs font-semibold rounded-full inline-block {{ $statusClasses[$order->status] ?? 'bg-slate-100 text-slate-800' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex justify-center items-center gap-2">
                             <a href="{{ route('admin.orders.show', $order->id) }}" class="p-2 text-slate-500 hover:bg-slate-200 hover:text-indigo-600 rounded-full transition-colors" data-tooltip="View Details">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </a>
                            </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-16 text-slate-500">
                        <p>No orders found for the selected filter.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection