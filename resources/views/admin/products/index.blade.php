@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Manage Products</h3>
        <div class="flex space-x-4">
            <a href="{{ route('admin.products.create') }}" class="bg-navy-900 text-white px-4 py-2 rounded-lg">Add Product</a>
            <select name="category" class="border rounded-lg px-4 py-2">
                <option value="">All Categories</option>
                @foreach (['T-Shirt', 'Sweater', 'Headwear'] as $category)
                <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
            <button onclick="this.closest('form').submit()" class="bg-navy-900 text-white px-4 py-2 rounded-lg">Filter</button>
        </div>
    </div>
    <table class="w-full">
        <thead>
            <tr class="text-left text-gray-600">
                <th class="pb-2">Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="border-t">
                <td class="py-2"><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td class="space-x-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="text-navy-600 hover:text-navy-800">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection