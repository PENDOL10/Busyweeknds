@extends('layouts.app')

@section('content')
<main class="mt-12 container mx-auto px-4">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 mb-6" aria-label="Breadcrumb">
        <ol class="flex space-x-2">
            <li><a href="{{ route('index') }}" class="hover:underline">Beranda</a></li>
            <li><span>/</span></li>
            <li><a href="{{ route('shop') }}" class="hover:underline">Toko</a></li>
            <li><span>/</span></li>
            <li>{{ $product->name }}</li>
        </ol>
    </nav>

    <!-- Detail Produk -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg">
        </div>
        <div>
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-2xl text-gray-800 mb-4">IDR {{ number_format($product->price, 0, ',', '.') }}</p>

            <!-- Deskripsi -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
                <p>{{ $product->description ?? 'Tidak ada deskripsi tersedia' }}</p>
            </div>

            <!-- Ukuran -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Ukuran</h2>
                @if($product->size)
                    @foreach(explode(',', $product->size) as $availableSize)
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm mr-2 mb-2">{{ trim($availableSize) }}</span>
                    @endforeach
                @else
                    <p>Tidak ada informasi ukuran</p>
                @endif
            </div>

            <!-- Stok -->
            <div class="mb-6">
                <p>{{ isset($product->stock) && $product->stock > 0 ? 'Tersedia (' . $product->stock . ' item)' : 'Habis' }}</p>
            </div>

            <!-- Tombol Tambah ke Keranjang -->
            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Tambah ke Keranjang</button>
        </div>
    </div>

    <!-- Produk Terkait -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6">Anda Mungkin Juga Suka</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
                <div class="border rounded-lg p-4 text-center">
                    <a href="{{ route('product.show', $relatedProduct->id) }}">
                        <img src="{{ asset($relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="w-full h-48 object-cover mb-4 rounded">
                        <h3 class="text-lg font-semibold">{{ $relatedProduct->name }}</h3>
                        <p class="text-gray-600">IDR {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection

@push('scripts')
    <!-- Tambahkan skrip tambahan di sini jika diperlukan -->
@endpush    