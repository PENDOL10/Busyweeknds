@extends('layouts.app')

@section('content')
<main class="bg-white mt-12">
    <!-- Shop Header -->
    <div class="px-4 md:px-18 py-12 mx-2">
        <h1 class="text-4xl font-bold text-black">All Product</h1>
    </div>

    <div class="px-4 md:px-18 mx-2 flex flex-col lg:flex-row gap-12">
        <!-- Filter Sidebar -->
        <aside class="w-full lg:w-1/5">
            <!-- Category -->
            <div class="mb-8 text-black">
                <h2 class="text-2xl font-bold mb-4">Category</h2>
                <ul class="space-y-2">
                    <li><a href="{{ route('shop') }}" class="hover:underline {{ !request('category') ? 'font-bold' : '' }}">All</a></li>
                    <li><a href="{{ route('shop', ['category' => 'T-Shirt']) }}" class="hover:underline {{ request('category') == 'T-Shirt' ? 'font-bold' : '' }}">T-Shirt</a></li>
                    <li><a href="{{ route('shop', ['category' => 'Sweater']) }}" class="hover:underline {{ request('category') == 'Sweater' ? 'font-bold' : '' }}">Sweater</a></li>
                    <li><a href="{{ route('shop', ['category' => 'Headwear']) }}" class="hover:underline {{ request('category') == 'Headwear' ? 'font-bold' : '' }}">Headwear</a></li>
                </ul>
            </div>
            
            <!-- Size -->
            <div class="text-black">
                <h2 class="text-2xl font-bold mb-4">Size</h2>
                <ul class="space-y-2">
                    <li><a href="{{ route('shop', array_merge(request()->except('size'), ['size' => 'S'])) }}" class="hover:underline {{ request('size') == 'S' ? 'font-bold' : '' }}">S</a></li>
                    <li><a href="{{ route('shop', array_merge(request()->except('size'), ['size' => 'M'])) }}" class="hover:underline {{ request('size') == 'M' ? 'font-bold' : '' }}">M</a></li>
                    <li><a href="{{ route('shop', array_merge(request()->except('size'), ['size' => 'L'])) }}" class="hover:underline {{ request('size') == 'L' ? 'font-bold' : '' }}">L</a></li>
                    <li><a href="{{ route('shop', array_merge(request()->except('size'), ['size' => 'XL'])) }}" class="hover:underline {{ request('size') == 'XL' ? 'font-bold' : '' }}">XL</a></li>
                    <li><a href="{{ route('shop', array_merge(request()->except('size'), ['size' => 'XXL'])) }}" class="hover:underline {{ request('size') == 'XXL' ? 'font-bold' : '' }}">XXL</a></li>
                </ul>
            </div>
        </aside>

        <!-- Products Grid -->
        <section class="w-full lg:w-4/5">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($products as $product)
                <div class="product-card mb-12">
                    <a href="{{ route('product.show', $product->id) }}" class="block">
                        <div class="mb-4 overflow-hidden">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-lg font-medium mb-1">{{ $product->name }}</h3>
                        <p class="text-sm">IDR {{ number_format($product->price, 0, ',', '.') }}</p>
                    </a>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-xl text-gray-500">No products available.</p>
                </div>
                @endforelse
            </div>
        </section>
    </div>
</main>
@endsection