@extends('layouts.app')
@section('content')

<main class="mt-12">
<!-- Hero Section -->
<section class="relative w-full text-white overflow-hidden">
  <img src=" {{ asset('/assets/images/home/landingpage/section.png') }}" alt="Hero Image" class="absolute inset-0 w-full h-full object-cover"/>
  <div class="relative z-10 flex flex-col justify-start h-[60vh] sm:h-[80vh] md:h-[100vh] lg:h-[115vh] pt-4 px-4 sm:px-6 mt-[30px]">

    <!-- Judul -->
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold" style="color: var(--tw-primary);" >
    <span>Busy</span><br>
    <span>
      Week<span class="text-white" style="-webkit-text-stroke: 1px;">nds.</span>
    </span>
  </h1>

  <!-- Button Hero -->
      <button onclick="window.location.href='{{ url('/shop') }}'" class="mt-4 px-4 sm:px-6 py-2 bg-white font-bold rounded w-max" style="color: var(--tw-primary)">
        See More
      </button>
  </div>
</section>
<!-- End Section -->

<!-- Elevate Your Wardrobe Section -->
<section class="py-8 sm:py-10 mt-2">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-8 text-black">
            / ELEVATE YOUR WARDROBE
        </h1>
        <div class="flex justify-end mb-4">
            <a href="{{ url('shop') }}" class="relative group text-sm text-black font-semibold cursor-pointer">
                SHOP ALL
                <span class="absolute left-0 -bottom-1 w-full h-[2px] bg-black transition-transform duration-300 group-hover:translate-x-full"></span>
            </a>
        </div>   
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
            @forelse ($products as $product)
                <div class="flex flex-col items-center">
                    @if (Auth::check())
                        <!-- If user is logged in, allow access to product detail -->
                        <a href="{{ route('product.show', $product->id) }}" class="block">
                            <img alt="{{ $product->name }}" class="product w-full max-w-[300px] h-auto" src="{{ asset($product->image) }}" loading="lazy"/>
                            <h3 class="mt-4 text-lg sm:text-xl font-bold text-black text-center">
                                {{ $product->name }}
                            </h3>
                            <p class="text-black text-center">
                                IDR {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </a>
                    @else
                        <!-- If user is not logged in, redirect to login -->
                        <a href="{{ route('login') }}" class="block">
                            <img alt="{{ $product->name }}" class="product w-full max-w-[300px] h-auto" src="{{ asset($product->image) }}" loading="lazy"/>
                            <h3 class="mt-4 text-lg sm:text-xl font-bold text-black text-center">
                                {{ $product->name }}
                            </h3>
                            <p class="text-black text-center">
                                IDR {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <p class="text-blue-500 text-center mt-2">
                                Login to view details
                            </p>
                        </a>
                    @endif
                </div>
            @empty
                <p class="text-black text-center col-span-1 sm:col-span-2 md:col-span-3 text-xl sm:text-2xl">
                    We Are So Sorry! <br> The Product is Out of Stock Right Now <br> Please Stay Tune With Us..
                </p>
            @endforelse
        </div>
    </div>
</section>
<!-- End Section -->

<!-- / 'THE ALMOST FORGOTTEN, NOW REDEFINED' -->
<section class="about py-8 sm:py-10">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 items-start gap-6 sm:gap-8">

      <!-- Kiri: Teks dan Gambar Kecil -->
      <div>
        <h1 class="text-xl sm:text-2xl md:text-3xl font-bold mb-4 text-blue-700 whitespace-normal sm:whitespace-nowrap">
          / 'THE ALMOST FORGOTTEN, NOW REDEFINED'
        </h1>
        <p class="text-sm sm:text-base text-justify break-words leading-relaxed max-w-full md:max-w-3xl">
          Introducing the Busy Weekends collection—where minimalism meets bold expression. Inspired by the fast-paced weekend rhythm, we craft timeless silhouettes, premium materials, and exclusive details, striking the perfect balance between urban elegance and individuality.
        </p>
        <div class="flex items-center gap-3 mt-4">
          <a href="{{ url('about') }}" class="read-more text-black hover:underline">Read More</a>
          <a href="{{ url('about') }}">
            <iconify-icon icon="solar:arrow-right-linear" width="24" height="24" style="color: black;" class="mt-2"></iconify-icon>
          </a>
        </div>

        <!-- Layout gambar model baru: 3 gambar kecil horizontal di bawah teks -->
        <div class="flex justify-start gap-12 sm:gap-12 mt-6">
          <img src="{{ asset ('assets/images/home/landingpage/model1.jpg') }}" alt="Model 1" class="w-[160px] sm:w-[200px] md:w-[220px] h-auto object-cover"/>
          <img src="{{ asset ('assets/images/home/landingpage/model2.jpg') }}" alt="Model 2" class="w-[160px] sm:w-[200px] md:w-[220px] h-auto object-cover"/>
          <img src="{{ asset ('assets/images/home/landingpage/model3.jpg') }}" alt="Model 3" class="w-[160px] sm:w-[200px] md:w-[220px] h-auto object-cover"/>
        </div>
      </div>

      <!-- Kanan: Gambar besar -->
      <div class="flex justify-center md:justify-end items-start mt-4 sm:mt-8">
        <img src="{{ asset ('assets/images/home/landingpage/model4.png') }}" alt="Model Large" class="h-auto w-full max-w-[420px] md:max-w-[440px] lg:max-w-[480px] object-cover" />
      </div>
    </div>
  </div>
</section>
<!-- End Section -->
 
  <!--  / NOT JUST FASHION–A CULTURE -->
  <section id="privilege" class="section-padding py-8 sm:py-10 mb-4">
    <div class="container mx-auto px-4">

      <!-- Judul -->
      <h1 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-8 text-black">
        / NOT JUST FASHION–A CULTURE
      </h1>

      <div class="grid grid-cols-1 md:grid-cols-2 items-start gap-8">
        <!-- Kolom kiri: Gambar -->
        <div class="relative w-full flex justify-center">
          <img src="{{ asset ('assets/images/home/landingpage/privilage.jpg') }}" alt="Privilege Image"
            class="w-full max-w-[300px] sm:max-w-[380px] h-auto sm:h-[480px] object-cover ml-0 md:ml-[-50px]" />

          <!-- Info box -->
          <div class="info-box absolute bottom-[-20px] sm:bottom-[-30px] md:bottom-[-50px] right-0 md:right-[-100px] lg:right-[-250px] text-white flex flex-wrap sm:flex-nowrap items-center justify-evenly sm:justify-between px-3 sm:px-6 py-3 sm:py-4 w-full sm:w-[350px] md:w-[450px] h-auto sm:h-[100px] shadow-lg">
            <div class="text-center p-2">
              <div class="font-bold text-base sm:text-lg">2019</div>
              <div class="text-xs sm:text-sm">The Beginning</div>
            </div>
            <div class="hidden sm:block w-px h-8 bg-white mx-2 sm:mx-4"></div>
            <div class="text-center p-2">
              <div class="font-bold text-base sm:text-lg">300+</div>
              <div class="text-xs sm:text-sm">Loyal Wearers</div>
            </div>
            <div class="hidden sm:block w-px h-8 bg-white mx-2 sm:mx-4"></div>
            <div class="text-center p-2">
              <div class="font-bold text-base sm:text-lg">666+</div>
              <div class="text-xs sm:text-sm">Sold Out Drops</div>
            </div>
          </div>
        </div>

      <!-- Kolom kanan: Informasi -->
      <div class="mt-12 sm:mt-8 md:mt-4 ml-0 md:ml-[-55px]">
        <h3 class="text-xl sm:text-2xl font-bold text-blue-700 mb-4">Essential. Timeless. Yours.</h3>
        <p class="text-justify leading-relaxed text-black max-w-full md:max-w-md break-words whitespace-normal">
          Inspired by the fast-paced energy of weekends, our collections feature timeless silhouettes, high-quality materials, and exclusive details that seamlessly fit into modern life.
        </p>
        <p class="mt-4 font-bold text-black break-words">
          More than fashion—it's a statement.
        </p>
      </div>
    </div>
  </div>
</section>
<!-- End Section -->
 
<!-- Subscribe Section -->
<section class="bg-black text-white py-8 sm:py-10 mt-[50px] sm:mt-[70px]">
    <div class="container mx-auto text-center px-4">
        <iconify-icon icon="material-symbols-light:mail-outline" width="30" height="30" style="color: #fff"></iconify-icon>
        <p class="text-xs sm:text-sm font-poppins tracking-wider">for early access to product drops</p>
        <h3 class="text-base sm:text-xl mb-4">SUBSCRIBE TO BUSYWEEKNDS</h3>

      <!-- Form Input Subsriber  -->
        <form action="{{ route('subscribe.store') }}" method="POST" class="flex justify-center">
            @csrf
            <div class="flex w-full max-w-xs sm:max-w-md">
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                    class="w-full px-3 sm:px-4 py-2 rounded-l-md border border-white bg-transparent text-white placeholder-white focus:outline-none font-poppins text-sm">
                <button type="submit" class="bg-white text-black px-3 sm:px-4 py-2 rounded-r-md border border-white border-l-0 hover:bg-gray-600">
                    <iconify-icon icon="solar:arrow-right-linear" width="24" height="24" style="color: black;"></iconify-icon>
                </button>
            </div>
        </form>

        <!-- Action -->
        @if ($errors->has('email'))
            <p class="text-red-500 text-xs sm:text-sm mt-2 font-poppins">{{ $errors->first('email') }}</p>
        @endif
        @if (session('success'))
            <p class="text-green-500 text-xs sm:text-sm mt-2 font-poppins">{{ session('success') }}</p>
        @endif
    </div>
</section>
<!-- End Section -->
</main>

@endsection