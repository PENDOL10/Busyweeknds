@extends('layouts.app')

@section('content')

<!-- About Us Section -->
<section class="py-12 sm:py-16 md:py-20 bg-white mt-8 mb-[90px]">
    <div class="container mx-auto px-4 sm:px-6 md:px-8 lg:px-20">
        <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
            
            <!-- Left: Images -->
            <div class="relative flex-shrink-0 w-full md:w-1/2 flex flex-col md:flex-row items-center">
                <!-- Gambar about pertama -->
                <img src="{{ asset('assets/images/about/about1.jpg') }}" alt="About 1"
                     class="w-[240px] sm:w-[280px] h-[320px] sm:h-[360px] object-cover rounded shadow-lg relative z-10 mb-8 mt-12 md:mb-0">
                
                <!-- Gambar about kedua with gap -->
                <img src="{{ asset('assets/images/about/about2.png') }}" alt="About 2"
                     class="w-[240px] sm:w-[280px] h-[320px] sm:h-[360px] object-cover rounded relative md:top-32 md:left-8 lg:top-32 lg:left-8 z-0">
            </div>

            <!-- Right: Text Content -->
            <div class="w-full md:w-1/2 text-left">
                <p class="text-blue-700 text-sm font-semibold mb-2 ml-4">A BIT</p>
                <h2 class="text-2xl sm:text-3xl font-bold text-black mb-4 sm:mb-6 ml-4">ABOUT US</h2>
                <p class="text-black leading-relaxed text-justify text-sm sm:text-base ml-4">
                    Busy Weeknds Jr. brings minimalist and fresh streetwear designs for those who embrace effortless style.
                    Our collection blends comfort, quality, and modern aesthetics to elevate your everyday look.
                    From casual essentials to statement pieces, we redefine street fashion with a unique identity.
                    Explore our latest drops and stay ahead of the trend. Shop now and be part of the movement.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- End Section -->

@endsection