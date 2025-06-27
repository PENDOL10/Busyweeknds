@extends('layouts.admin')

@section('title', 'Add New Product')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Add New Product</h2>
            <p class="text-gray-600">Fill in the details to add a new product to your store.</p>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">General Information</h3>

                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name of Product</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 @error('name') border-red-500 @enderror"
                                   value="{{ old('name') }}"
                                   placeholder="product">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description Product</label>
                            <textarea id="description"
                                     name="description"
                                     rows="4"
                                     class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 @error('description') border-red-500 @enderror"
                                     placeholder="the description">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Size</label>
                            <p class="text-xs text-gray-500 mb-3">Pick Available Size</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['XS', 'S', 'M', 'L', 'XL', 'XXL', 'One Size'] as $size)
                                    <label class="relative">
                                        <input type="checkbox"
                                               name="sizes[]"
                                               value="{{ $size }}"
                                               class="sr-only peer @error('sizes') border-red-500 @enderror"
                                               {{ in_array($size, old('sizes', [])) ? 'checked' : '' }}>
                                        <div class="px-4 py-2 text-sm font-medium border border-gray-200 rounded-lg cursor-pointer
                                                                    peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600
                                                                    hover:border-blue-300 transition-all duration-200">
                                            {{ $size }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('sizes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Gender</label>
                            <p class="text-xs text-gray-500 mb-3">Pick Available Gender</p>
                            <div class="flex gap-4">
                                @foreach(['Men', 'Women', 'Unisex'] as $gender)
                                    <label class="flex items-center">
                                        <input type="radio"
                                               name="gender"
                                               value="{{ $gender }}"
                                               class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 @error('gender') border-red-500 @enderror"
                                               {{ old('gender') == $gender ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700">{{ $gender }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('gender')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    {{-- Front Image Upload --}}
                    <div class="bg-white rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Front Image</h3>
                        <div class="border-2 border-dashed border-gray-200 rounded-lg p-8 text-center cursor-pointer hover:border-blue-300 transition-colors"
                             onclick="document.getElementById('image_front').click()">
                            <div class="space-y-3">
                                <div class="mx-auto w-12 h-12 text-gray-400">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Upload Front Photo</p>
                                    <p class="text-xs text-gray-500 mt-1">Drag and Drop files here</p>
                                    <p class="text-xs text-gray-400 mt-1">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                        </div>
                        <input id="image_front" name="image_front" type="file" class="sr-only" accept="image/*">
                        @error('image_front')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror

                        <div id="image-front-preview-container" class="mt-4 hidden">
                            <img id="image-front-preview" class="rounded-lg w-full h-auto" src="#" alt="Front Image Preview">
                        </div>
                    </div>

                    {{-- Back Image Upload --}}
                    <div class="bg-white rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Back Image (Optional)</h3>
                        <div class="border-2 border-dashed border-gray-200 rounded-lg p-8 text-center cursor-pointer hover:border-blue-300 transition-colors"
                             onclick="document.getElementById('image_back').click()">
                            <div class="space-y-3">
                                <div class="mx-auto w-12 h-12 text-gray-400">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Upload Back Photo</p>
                                    <p class="text-xs text-gray-500 mt-1">Drag and Drop files here</p>
                                    <p class="text-xs text-gray-400 mt-1">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                        </div>
                        <input id="image_back" name="image_back" type="file" class="sr-only" accept="image/*">
                        @error('image_back')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror

                        <div id="image-back-preview-container" class="mt-4 hidden">
                            <img id="image-back-preview" class="rounded-lg w-full h-auto" src="#" alt="Back Image Preview">
                        </div>
                    </div>

                    {{-- Category Section (moved here for better layout) --}}
                    <div class="bg-white rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Category</h3>
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Pick Product Category</label>
                            <select id="category_id"
                                    name="category_id"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 @error('category_id') border-red-500 @enderror">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <div class="bg-white rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Pricing And Stock</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Normal Price</label>
                                <input type="number"
                                       id="price"
                                       name="price"
                                       step="0.01"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 @error('price') border-red-500 @enderror"
                                       value="{{ old('price') }}"
                                       placeholder="-">
                                @error('price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stock</label>
                                <input type="number"
                                       id="stock"
                                       name="stock"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 @error('stock') border-red-500 @enderror"
                                       value="{{ old('stock') }}"
                                       placeholder="-">
                                @error('stock')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="discount" class="block text-sm font-medium text-gray-700 mb-2">Discount</label>
                                <input type="number"
                                       id="discount"
                                       name="discount"
                                       step="0.01"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 @error('discount') border-red-500 @enderror"
                                       value="{{ old('discount') }}"
                                       placeholder="-">
                                @error('discount')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="shipping_cost" class="block text-sm font-medium text-gray-700 mb-2">Shipping Cost</label>
                                <input type="number"
                                       id="shipping_cost"
                                       name="shipping_cost"
                                       step="0.01"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 @error('shipping_cost') border-red-500 @enderror"
                                       value="{{ old('shipping_cost') }}"
                                       placeholder="-">
                                @error('shipping_cost')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3 flex justify-end pt-6">
                    <button type="submit"
                            class="inline-flex items-center justify-center px-8 py-3 text-base font-medium text-white bg-[#010BEB] rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                        Add Product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Front Image Preview
    document.getElementById('image_front').addEventListener('change', function(event) {
        const file = event.target.files && event.target.files.item(0);
        const imagePreview = document.getElementById('image-front-preview');
        const imagePreviewContainer = document.getElementById('image-front-preview-container');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreviewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '#';
            imagePreviewContainer.classList.add('hidden');
        }
    });

    // Back Image Preview
    document.getElementById('image_back').addEventListener('change', function(event) {
        const file = event.target.files && event.target.files.item(0);
        const imagePreview = document.getElementById('image-back-preview');
        const imagePreviewContainer = document.getElementById('image-back-preview-container');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreviewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '#';
            imagePreviewContainer.classList.add('hidden');
        }
    });

    // Automatically hide success alert after 3 seconds
    setTimeout(() => {
        const successAlert = document.querySelector('.bg-green-100');
        if (successAlert) {
            successAlert.remove();
        }
    }, 3000);
</script>
@endsection