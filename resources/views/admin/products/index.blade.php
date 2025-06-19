@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div>
        <h2 class="text-3xl font-bold text-slate-800">Manage Products</h2>
        <p class="mt-1 text-slate-500">Add, edit, or delete products from your store.</p>
    </div>

    <div class="rounded-2xl bg-white p-6 shadow-lg">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-6">
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                {{-- Tambahkan input untuk pencarian --}}
                <form action="{{ route('admin.products.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}" class="w-full rounded-lg border-slate-300 pl-10 focus:border-navy-500 focus:ring-navy-500">
                </form>
            </div>
            <div class="flex items-center gap-4">
                {{-- Dropdown Filter Kategori --}}
                <form action="{{ route('admin.products.index') }}" method="GET" id="category-filter-form">
                    <input type="hidden" name="search" value="{{ request('search') }}"> {{-- Pertahankan parameter search --}}
                    <select name="category" onchange="document.getElementById('category-filter-form').submit()" class="rounded-lg border-slate-300 text-sm focus:border-navy-500 focus:ring-navy-500 transition">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                
                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#010BEB] px-4 py-2.5 text-sm font-medium text-white shadow-sm transition-all hover:bg-navy-800 focus:outline-none focus:ring-2 focus:ring-navy-500 focus:ring-offset-2">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    <span>Add New Product</span>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-sm font-semibold text-slate-500 border-b-2 border-slate-200">
                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Stock</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                        <td class="p-4">
                            @php
                                $imageUrl = '';
                                if ($product->image) {
                                    // Cek apakah path dimulai dengan 'products/' (dari storage, hasil upload)
                                    if (str_starts_with($product->image, 'products/')) {
                                        $imageUrl = asset('storage/' . $product->image);
                                    } else { // Asumsi path lain adalah dari public/assets (dari seeder)
                                        $imageUrl = asset($product->image);
                                    }
                                } else {
                                    $imageUrl = 'https://via.placeholder.com/64x64?text=No+Image'; // Placeholder jika tidak ada gambar
                                }
                            @endphp
                            {{-- Perbaikan gambar: gunakan object-contain agar tidak terpotong --}}
                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-16 h-16 object-contain rounded-md hover:scale-105 transition-transform duration-300">
                        </td>
                        <td class="p-4 font-medium text-slate-700">{{ $product->name }}</td>
                        <td class="p-4 text-slate-600">
                            {{-- Tampilkan nama kategori dari relasi --}}
                            {{ $product->category->name ?? 'N/A' }} 
                        </td>
                        <td class="p-4 text-slate-600">IDR {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="p-4 text-slate-600 font-medium">{{ $product->stock }}</td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-flex items-center justify-center rounded-lg border bg-slate-100 p-2 text-sm font-medium text-slate-700 shadow-sm transition-all hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2" title="Edit">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                </a>
                                <button 
                                    type="button" 
                                    @click="$dispatch('open-delete-modal', { deleteUrl: '{{ route('admin.products.destroy', $product->id) }}' })"
                                    class="inline-flex items-center justify-center rounded-lg border bg-red-50 p-2 text-sm font-medium text-red-600 shadow-sm transition-all hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2" title="Delete">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-slate-500">
                           No products found. <a href="{{ route('admin.products.create') }}" class="text-navy-700 hover:underline">Add one now</a>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection