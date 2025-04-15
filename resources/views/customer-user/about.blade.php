@extends('layouts.app')

@section('content')

<!-- About Us Section -->
<section class="py-20 bg-white mt-12 mb-[70px]">
    <div class="container mx-auto px-6 md:px-20 flex flex-col md:flex-row items-center gap-12">
        
        <!-- Left: Images -->
        <div class="relative flex-shrink-0">
            <!-- Gambar about pertama -->
            <img src="{{ asset ('assets/images/about/about1.jpg') }}" alt="About 1"
                 class="w-[280px] h-[360px] object-cover rounded shadow-lg relative right-12 z-10 ml-8">
            
            <!-- Gambar about kedua -->
            <img src="{{ asset ('assets/images/about/about2.png') }}" alt="About 2"
                 class="w-[280px] h-[360px] object-cover absolute rounded top-24 left-84 z-0">
        </div>

        <!-- Right: Text Content -->
        <div class="max-w-xl text-left ml-[340px]">
            <p class="text-blue-700 text-sm font-semibold mb-2">A BIT</p>
            <h2 class="text-3xl font-bold text-black mb-6">ABOUT US</h2>
            <p class="text-black leading-relaxed text-justify">
                Busy Weeknds Jr. brings minimalist and fresh streetwear designs for those who embrace effortless style.
                Our collection blends comfort, quality, and modern aesthetics to elevate your everyday look.
                From casual essentials to statement pieces, we redefine street fashion with a unique identity.
                Explore our latest drops and stay ahead of the trend. Shop now and be part of the movement.
            </p>
        </div>
    </div>
</section>
<!-- End Sextion -->

@endsection

