@extends('layouts.app')

@section('content')
<main class="bg-white mt-[70px] container mx-auto px-4 md:px-6 lg:px-8 py-12">
    <div class="text-center">
        <iconify-icon icon="ic:twotone-shopping-cart-checkout" width="70" height="70" style="color: #31d231"></iconify-icon>
        <h1 class="text-3xl font-bold text-black mb-6">Order Successful!</h1>
        <p class="text-gray-600 mb-4">Thank you for your purchase. Your order has been placed successfully.</p>
        <a href="{{ route('shop') }}" class="bg-[#010BEB] text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-colors font-semibold">Continue Shopping</a>
    </div>

    @if (session('success'))
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full relative">
            <button class="absolute right-2 top-2 text-gray-500 hover:text-gray-700" onclick="closeModal()">
                <iconify-icon icon="weui:close-outlined" width="30" height="30" style="color: #000"></iconify-icon>
            </button>
            <div class="flex justify-center mb-4">
                <iconify-icon icon="mdi:success-circle-outline" width="60" height="60" style="color: #31d231"></iconify-icon>
            </div>
            <h2 class="text-3xl font-bold text-center mb-4">Payment Successful!</h2>
            <p class="text-black text-sm mb-2">We're Processing The Shipping Of Product</p>
            <p class="text-black text-sm mb-4">We Will Send The Invoice via WhatsApp</p>
            <p class="text-black text-xl font-semibold mb-4">Thank U For Waiting...</p>
            <div class="text-end">
                <p class="text-sm text-black font-semibold mt-2">Busy Weekends Jr.</p>
            </div>
        </div>
    </div>
    @endif
</main>
<script>
    // Function to close the modal
    function closeModal() {
        const modal = document.getElementById('successModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Automatically show the modal on page load
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('successModal');
        if (modal) {
            modal.style.display = 'flex';

            // Close modal after 10 seconds
            setTimeout(() => {
                modal.style.display = 'none';
            }, 10000);
        }

        localStorage.removeItem('cart');


        // Memanggil fungsi updateCartUI() dari app.blade.php
        if (typeof window.updateCartUI === 'function') {
            window.updateCartUI(); 
        }

    });
</script>
@endsection
