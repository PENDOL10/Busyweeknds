@extends('layouts.app')

@section('content')
<main class=" mt-[110px] container mx-auto px-4 md:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-16">
            <div class="flex flex-col">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">{{ $product->name }}</h1>

                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Description</h2>
                    <p class="text-gray-600 leading-relaxed text-justify max-w-[250px] md:max-w-[350px] break-words">{{ $product->description ?? 'No description available.' }}</p>
                </div>
                <div class="flex justify-between items-center mb-3 mr-[30px]">
                    <h2 class="text-xl font-semibold text-gray-900">Size Guide</h2>
                    <button id="size-guide-toggle" class="text-sm text-blue-600 hover:underline">Size Guide</button>
                </div>
                <div id="size-guide" class="text-sm text-gray-500 mt-1 hidden">
                    <ul class="list-disc list-inside">
                        <li>XS: W 46 cm, L 68 cm</li>
                        <li>S: W 48 cm, L 70 cm</li>
                        <li>M: W 50 cm, L 72 cm</li>
                        <li>L: W 52 cm, L 74 cm</li>
                        <li>XL: W 54 cm, L 76 cm</li>
                        <li>XXL: W 56 cm, L 78 cm</li>
                        <li>One Size</li>
                    </ul>
                </div>
            </div>

        <div class="flex flex-col items-center gap-6">
            @php
                // Logika untuk menentukan path gambar yang benar untuk tampilan produk
                $imageUrl = '';
                if ($product->image) {
                    // Cek apakah path dimulai dengan 'products/' (dari storage, hasil upload)
                    if (str_starts_with($product->image, 'products/')) {
                        $imageUrl = asset('storage/' . $product->image);
                    } else { // Asumsi path lain adalah dari public/assets (dari seeder)
                        $imageUrl = asset($product->image);
                    }
                } else {
                    $imageUrl = 'https://via.placeholder.com/500x500?text=No+Image'; // Placeholder jika tidak ada gambar
                }
            @endphp
            <div class="w-auto h-auto hover:shadow-lg transition-shadow">
                <img src="{{ $imageUrl }}" 
                     alt="{{ $product->name }}" 
                     class="w-auto h-auto object-cover rounded-lg">
            </div>
            
            <div class="w-auto h-auto hover:shadow-lg transition-shadow">
                <img src="{{ $imageUrl }}" 
                     alt="{{ $product->name }} Back View" 
                     class="w-auto h-auto object-cover rounded-lg">
            </div>
        </div>

        <div class="flex flex-col justify-between">
            <div>
                <h1 class="text-2xl font-bold md:text-3xl text-gray-800 mb-6">IDR {{ number_format($product->price, 0, ',', '.') }}</h1>

                <p class="text-sm text-gray-600 mb-4">
                    @if($product->stock > 0)
                        <span class="text-green-600 font-medium">In Stock ({{ $product->stock }} left)</span>
                    @else
                        <span class="text-red-600 font-medium">Out of Stock</span>
                    @endif
                </p>

                <div class="mb-6">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-xl font-semibold text-gray-900">Size</h2>
                    </div>
                    @if(!empty($product->sizes))
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->sizes as $availableSize)
                                <button type="button" class="size-btn border border-gray-300 text-gray-800 rounded-md px-4 py-2 text-sm hover:bg-blue-600 transition-colors" data-size="{{ $availableSize }}" onclick="selectSize(this)">
                                    {{ $availableSize }}
                                </button>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No size information available.</p>
                    @endif
                </div>

                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">Amount</h2>
                    <div class="flex items-center space-x-3">
                        <button type="button" onclick="updateAmount(-1)" class="border border-gray-300 rounded-md px-3 py-1 text-gray-600 hover:bg-gray-100">-</button>
                        <input type="number" id="amount" min="1" max="{{ $product->stock }}" value="1" class="border border-gray-300 rounded-md px-2 py-2 w-20 text-center focus:outline-none focus:ring-2 focus:ring-blue-500" style="background-color: white;" readonly>
                        <button type="button" onclick="updateAmount(1)" class="border border-gray-300 rounded-md px-3 py-1 text-gray-600 hover:bg-gray-100">+</button>
                    </div>
                </div>

                <button id="add-to-cart" class="w-full bg-[#010BEB] text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    Add to Cart
                </button>
            </div>
        </div>
    </div>

    @if($relatedProducts->isNotEmpty())
        <div class="mt-[80px] mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">You Might Also Like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="p-4 text-center hover:shadow-lg transition-shadow">
                        <a href="{{ route('product.show', $relatedProduct->id) }}">
                            @php
                                $relatedImageUrl = '';
                                if ($relatedProduct->image) {
                                    if (str_starts_with($relatedProduct->image, 'products/')) {
                                        $relatedImageUrl = asset('storage/' . $relatedProduct->image);
                                    } else {
                                        $relatedImageUrl = asset($relatedProduct->image);
                                    }
                                } else {
                                    $relatedImageUrl = 'https://via.placeholder.com/150x150?text=No+Image';
                                }
                            @endphp
                            <img src="{{ $relatedImageUrl }}" alt="{{ $relatedProduct->name }}" class="w-68 h-38 object-cover mb-4 rounded-lg ml-10">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $relatedProduct->name }}</h3>
                            <p class="text-gray-600">IDR {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div id="cart-popup" class="fixed top-0 right-0 h-full w-full max-w-sm bg-white shadow-2xl transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex flex-col h-full">
            <div class="flex justify-between items-center p-6 mt-[50px]">
                <h2 class="underline underline-offset-4 text-2xl font-bold text-gray-900">Cart</h2>
                <button id="close-cart" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div id="cart-items" class="flex-1 overflow-y-auto p-6 space-y-4">
                </div>

            <div class="p-6">
                <div class="flex justify-between items-center mb-4 border-t border-gray-600">
                    <span class="text-lg font-semibold text-gray-900">SUB TOTAL</span>
                    <span id="cart-subtotal" class="text-lg font-semibold text-gray-900">IDR 0</span>
                </div>
                <button id="proceed-to-checkout" class="block w-full bg-[#010BEB] text-white text-center px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>

    <div id="cart-overlay" class="fixed inset-0 bg-black opacity-0 pointer-events-none transition-opacity duration-300 z-40"></div>
</main>
@endsection

@push('scripts')
<script>
// Base URLs from Blade that JavaScript can use
const ASSET_BASE_URL = "{{ asset('/') }}";
const STORAGE_BASE_URL = "{{ asset('storage/') }}";

document.getElementById('proceed-to-checkout').addEventListener('click', function() {
    @guest
        alert('Please login to proceed to checkout.');
        window.location.href = '{{ route("login") }}';
    @else
        if (cart.length > 0) {
            fetch('{{ route("cart.save-for-checkout") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ cart: cart })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '{{ route("checkout.index") }}';
                } else {
                    alert('Failed to save cart. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        } else {
            alert('Your cart is empty.');
        }
    @endguest
});

let selectedSize = null;
let cart = JSON.parse(localStorage.getItem('cart')) || [];

document.addEventListener('DOMContentLoaded', function() {
    updateCartUI();
    // Select the first size button by default if available
    const firstSizeBtn = document.querySelector('.size-btn');
    if (firstSizeBtn) {
        selectSize(firstSizeBtn);
    }
});

function selectSize(button) {
    selectedSize = button.getAttribute('data-size');
    const sizeButtons = document.querySelectorAll('.size-btn');
    sizeButtons.forEach(btn => {
        btn.classList.remove('bg-[#010BEB]', 'text-white', 'border-blue-600');
        btn.classList.add('border-gray-300', 'text-gray-800', 'hover:bg-gray-100');
    });
    button.classList.remove('border-gray-300', 'text-gray-800', 'hover:bg-gray-100');
    button.classList.add('bg-[#010BEB]', 'text-white', 'border-blue-600');
    document.getElementById('size-guide').classList.remove('hidden'); // Show size guide on size selection
}

function updateAmount(change) {
    const amountInput = document.getElementById('amount');
    let amount = parseInt(amountInput.value);
    amount += change;
    if (amount < 1) amount = 1; // Minimum quantity is 1
    if (amount > {{ $product->stock }}) amount = {{ $product->stock }};
    amountInput.value = amount;
}

document.getElementById('size-guide-toggle').addEventListener('click', function() {
    const sizeGuide = document.getElementById('size-guide');
    sizeGuide.classList.toggle('hidden');
});

// Helper function to get correct image URL for JavaScript
function getProductImageUrl(imagePath) {
    if (!imagePath) {
        return 'https://via.placeholder.com/150'; // Placeholder if no image path
    }
    // Check if path starts with 'products/' (from storage)
    if (imagePath.startsWith('products/')) {
        return STORAGE_BASE_URL + '/' + imagePath;
    } 
    // Check if path starts with '/' (from public/assets)
    else if (imagePath.startsWith('/')) {
        return ASSET_BASE_URL + imagePath.substring(1); // asset() handles leading slash correctly
    }
    // Fallback or other cases
    return ASSET_BASE_URL + imagePath; 
}


document.getElementById('add-to-cart').addEventListener('click', function() {
    @guest
        alert('Please login to add items to your cart.');
        window.location.href = '{{ route("login") }}';
    @else
        if (this.disabled) return;

        const amount = parseInt(document.getElementById('amount').value);
        if (!selectedSize) {
            alert('Please select a size.');
            return;
        }
        if (amount <= 0 || amount > {{ $product->stock }}) {
            alert('Please enter a valid amount (up to {{ $product->stock }}).');
            return;
        }

        const product = {
            id: {{ $product->id }},
            name: "{{ $product->name }}",
            price: {{ $product->price }},
            size: selectedSize,
            quantity: amount,
            image: "{{ $product->image }}" // Pass the raw image path
        };

        const existingItemIndex = cart.findIndex(item => item.id === product.id && item.size === product.size);
        if (existingItemIndex !== -1) {
            cart[existingItemIndex].quantity += product.quantity;
        } else {
            cart.push(product);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartUI();
        showCartPopup();
    @endguest
});

function updateCartUI() {
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = ''; // Clear existing items

    @guest
        cartItemsContainer.innerHTML = '<p class="text-gray-500 text-center">Please login to view your cart.</p>';
        document.getElementById('cart-subtotal').textContent = 'IDR 0';
        return;
    @else
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p class="text-gray-500 text-center">Your cart is empty.</p>';
            document.getElementById('cart-subtotal').textContent = 'IDR 0';
            return;
        }

        let subtotal = 0;
        cart.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;

            // Use the new helper function for image URL
            const cartItemImageUrl = getProductImageUrl(item.image);
            
            const itemElement =
                `<div class="flex items-start space-x-4 border-b pb-4">
                    <img src="${cartItemImageUrl}" alt="${item.name}" class="w-20 h-20 object-cover rounded-lg border-2 border-blue-600">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">${item.name}</h3>
                        <p class="text-sm text-gray-600 mb-2">IDR ${item.price.toLocaleString('id-ID')}</p>
                        <p class="text-sm text-gray-600 mb-2">Size: <span class="bg-blue-600 text-white px-2 py-1 rounded mb-2">${item.size}</span></p>
                        <div class="flex items-center space-x-2 mt-2">
                            <button onclick="updateCartItem(${index}, -1)" class="border border-gray-300 rounded-md px-2 py-1 text-gray-600 hover:bg-gray-100">-</button>
                            <span class="text-gray-800">${item.quantity}</span>
                            <button onclick="updateCartItem(${index}, 1)" class="border border-gray-300 rounded-md px-2 py-1 text-gray-600 hover:bg-gray-100">+</button>
                        </div>
                    </div>
                    <button onclick="removeCartItem(${index})" class="text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>`;
            cartItemsContainer.innerHTML += itemElement;
        });

        document.getElementById('cart-subtotal').textContent = `IDR ${subtotal.toLocaleString('id-ID')}`;
    @endguest
}

function updateCartItem(index, change) {
    // Ensure product stock is not exceeded when increasing quantity
    // This part requires access to the *original* product stock, which is currently
    // only available directly for the product on the page.
    // For cart items from local storage, we'd ideally fetch this or store it in cart.
    // For simplicity, we'll use the product stock from the current page for now.
    // A more robust solution would store `max_stock` in the cart item itself or fetch from API.
    const productMaxStock = {{ $product->stock }}; 
    const currentQuantity = cart[index].quantity;

    if (change > 0 && (currentQuantity + change) > productMaxStock) {
        alert('Cannot add more than available stock.');
        return;
    }

    cart[index].quantity += change;
    if (cart[index].quantity <= 0) {
        // If quantity drops to 0 or below, remove the item
        cart.splice(index, 1);
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartUI(); // Re-render the cart UI
}

function removeCartItem(index) {
    cart.splice(index, 1); // Remove item from array
    localStorage.setItem('cart', JSON.stringify(cart)); // Update local storage
    updateCartUI(); // Update UI to reflect changes
}

function showCartPopup() {
    const cartPopup = document.getElementById('cart-popup');
    const overlay = document.getElementById('cart-overlay');
    cartPopup.classList.remove('translate-x-full');
    overlay.classList.remove('opacity-0', 'pointer-events-none');
    overlay.classList.add('opacity-50', 'pointer-events-auto');
}

function hideCartPopup() {
    const cartPopup = document.getElementById('cart-popup');
    const overlay = document.getElementById('cart-overlay');
    cartPopup.classList.add('translate-x-full');
    overlay.classList.add('opacity-0', 'pointer-events-none');
    overlay.classList.remove('opacity-50', 'pointer-events-auto');
}

document.getElementById('close-cart').addEventListener('click', hideCartPopup);
document.getElementById('cart-overlay').addEventListener('click', hideCartPopup);
</script>
@endpush