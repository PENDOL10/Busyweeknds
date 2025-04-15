@extends('layouts.app')
@section('content')

<main class="mt-12">
<!-- Hero Section -->
<section class="relative w-full text-white overflow-hidden">
  <img src="/assets/images/home/landingpage/section.png" alt="Hero Image"class="absolute inset-0 w-full h-full object-cover"/>
  <div class="relative z-10 flex flex-col justify-start h-[115vh] pt-4 px-6 mt-[30px]">

    <!-- Judul -->
    <h1 class="text-5xl font-bold" style="font-size: 70px; color: var(--tw-primary);" >
    <span>Busy</span><br>
    <span>
      Week<span class="text-white" style="-webkit-text-stroke: 1px;">nds.</span>
    </span>
  </h1>

  <!-- Button Hero -->
    </h1>
    <button class="mt-4 px-6 py-2 bg-white font-bold rounded w-max" style="color: var(--tw-primary)">
      See More
    </button>
  </div>
</section>
<!-- End Section -->

<!-- Elevate Your Wardrobe Section -->
<section class="py-10 mt-2">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold mb-8 text-black">
                / ELEVATE YOUR WARDROBE
            </h1>
              <div class="flex justify-end">
                <a href="{{ url('customer-user.shop') }}" class="relative group text-sm text-black font-semibold cursor-pointer">
                  SHOP ALL
                  <!-- Garis bawah animasi -->
                  <span class="absolute left-0 -bottom-1 w-full h-[2px] bg-black transition-transform duration-300 group-hover:translate-x-full"></span>
                </a>
              </div>   
        </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($products as $product)
                    <div class="flex flex-col items-center">
                      <!-- Dinamis Product -->
                        <img alt="{{ $product->name }}" class="product" height="300" src="{{ asset($product->image) }}" width="300" loading="lazy"/>
                        <h3 class="mt-4 text-xl font-bold text-black text-center">
                            {{ $product->name }}
                        </h3>
                        <p class="text-black text-center">
                            IDR {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                @empty
                    <p class="text-black text-center col-span-3 text-2xl">
                      We Are So Sorry! <br> The Product is Out of Stock Right Now <br> Please Stay Tune With Us..
                    </p>
                @endforelse
            </div>
        </div>
    </section>
<!-- End Section -->

<!-- / ‘THE ALMOST FORGOTTEN, NOW REDEFINED’ -->
<section class="about py-10">
  <div class="container mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 items-start gap-8">

      <!-- Kiri: Teks dan Gambar Kecil -->
      <div>
        <h1 class="text-3xl font-bold mb-4 text-blue-700 whitespace-nowrap">
          / ‘THE ALMOST FORGOTTEN, NOW REDEFINED’
        </h1>
        <p class="max-w-3xl text-justify break-words leading-relaxed">
          Introducing the Busy Weekends collection—where minimalism meets bold expression. Inspired by the fast-paced weekend rhythm, we craft timeless silhouettes, premium materials, and exclusive details, striking the perfect balance between urban elegance and individuality.
        </p>
        <div class="flex items-center gap-3 mt-4">
          <a href="{{ url('about') }}" class="read-more text-black hover:underline">Read More</a>
          <a href="{{ url('about') }}">
            <iconify-icon icon="solar:arrow-right-linear" width="24" height="24" style="color: black;" class="mt-2"></iconify-icon>
          </a>
        </div>

        <!-- Tiga gambar kecil horizontal -->
        <div class="flex justify-start gap-14 mt-6 space-x-8">
          <img src="{{ asset ('assets/images/home/landingpage/model1.jpg') }}" alt="Model 1" class="w-[200px] h-auto object-contain" />
          <img src="{{ asset ('assets/images/home/landingpage/model2.jpg') }}" alt="Model 2" class="w-[200px] h-auto object-contain" />
          <img src="{{ asset ('assets/images/home/landingpage/model3.jpg') }}" alt="Model 3" class="w-[200px] h-auto object-contain" />
        </div>
      </div>

      <!-- Kanan: Gambar besar -->
      <div class="flex justify-end items-start mt-8 pr-4">
        <img src="{{ asset ('assets/images/home/landingpage/model4.png') }}" alt="Model Large" class="h-[560px] object-contain" />
      </div>
    </div>
  </div>
</section>
<!-- End Section -->

  <!--  / NOT JUST FASHION–A CULTURE -->
  <section id="privilege" class="section-padding py-10 mb-4">
    <div class="container mx-auto">

      <!-- Judul -->
      <h1 class="text-3xl font-bold mb-8 text-black">
        / NOT JUST FASHION–A CULTURE
      </h1>

      <div class="grid grid-cols-1 md:grid-cols-2 items-start gap-4">
        <!-- Kolom kiri: Gambar -->
        <div class="relative w-full flex justify-center">
          <img src="{{ asset ('assets/images/home/landingpage/privilage.jpg') }}" alt="Privilege Image"
            class="w-[380px] h-[480px] object-cover ml-[-50px]" />

          <!-- Info box di pojok kanan bawah gambar -->
          <div class="absolute bottom-[-90px] right-[-250px] text-white flex items-center justify-between mb-12 px-6 py-4 w-[450px] h-[100px] shadow-lg ml-8" style="background-color: var(--tw-neutral)">
            <div class="text-center">
              <div class="font-bold text-lg">2019</div>
              <div class="text-sm">The Beginning</div>
            </div>
            <div class="w-px h-8 bg-white mx-4"></div>
            <div class="text-center">
              <div class="font-bold text-lg">300+</div>
              <div class="text-sm">Loyal Wearers</div>
            </div>
            <div class="w-px h-8 bg-white mx-4"></div>
            <div class="text-center">
              <div class="font-bold text-lg">666+</div>
              <div class="text-sm">Sold Out Drops</div>
            </div>
          </div>
        </div>

      <!-- Kolom kanan: Informasi -->
      <div class="mt-4 md:mt-0 ml-[-55px]">
        <h3 class="text-2xl font-bold text-blue-700 mb-4">Essential. Timeless. Yours.</h3>
        <p class="text-justify leading-relaxed text-black max-w-md break-words whitespace-normal">
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
<section class="bg-black text-white py-10 mt-[70px]">
    <div class="container mx-auto text-center">
        <iconify-icon icon="material-symbols-light:mail-outline" width="30" height="30" style="color: #fff"></iconify-icon>
        <p class="text-sm font-poppins tracking-wider">for early access to product drops</p>
        <h3 class="text-sm mb-4 text-xl">SUBSCRIBE TO BUSYWEEKNDS</h3>

      <!-- Form Input Subsriber  -->
        <form action="{{ route('subscribe.store') }}" method="POST" class="flex justify-center">
            @csrf
            <div class="flex w-full max-w-md">
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                    class="w-full px-4 py-2 rounded-l-md border border-white bg-transparent text-white placeholder-white focus:outline-none font-poppins">
                <button type="submit" class="bg-white text-black px-4 py-2 rounded-r-md border border-white border-l-0 hover:bg-gray-600">
                    <iconify-icon icon="solar:arrow-right-linear" width="30" height="30" style="color: black;"></iconify-icon>
                </button>
            </div>
        </form>

        <!-- Action -->
        @if ($errors->has('email'))
            <p class="text-red-500 text-sm mt-2 font-poppins">{{ $errors->first('email') }}</p>
        @endif
        @if (session('success'))
            <p class="text-green-500 text-sm mt-2 font-poppins">{{ session('success') }}</p>
        @endif
    </div>
</section>
<!-- End Section -->
</main>

@endsection