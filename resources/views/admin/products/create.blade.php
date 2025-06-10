@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 max-w-2xl mx-auto">
    <h3 class="text-lg font-semibold text-gray-800 mb-6">Add New Product</h3>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-gray-600">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded-lg px-4 py-2" required>
                @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-600">Price</label>
                <input type="number" name="price" value="{{ old('price') }}" class="w-full border rounded-lg px-4 py-2" required>
                @error('price') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-600">Image</label>
                <input type="file" name="image" class="w-full border rounded-lg px-4 py-2" required>
                @error('image') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-600">Category</label>
                <select name="category" class="w-full border rounded-lg px-4 py-2" required>
                    <option value="T-Shirt">T-Shirt</option>
                    <option value="Sweater">Sweater</option>
                    <option value="Headwear">Headwear</option>
                </select>
                @error('category') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-600">Size</label>
                <input type="text" name="size" value="{{ old('size') }}" class="w-full border rounded-lg px-4 py-2" placeholder="e.g., S,M,L,XL">
                @error('size') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-600">Stock</label>
                <input type="number" name="stock" value="{{ old('stock') }}" class="w-full border rounded-lg px-4 py-2" required>
                @error('stock') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-600">Description</label>
                <textarea name="description" class="w-full border rounded-lg px-4 py-2">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="bg-navy-900 text-white px-6 py-2 rounded-lg hover:bg-navy-800">Save Product</button>
        </div>
    </form>
</div>
@endsection