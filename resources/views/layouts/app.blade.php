<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="mytheme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Busyweeknds') }}</title>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="bsyweeknds" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.8.0/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    @stack("styles")
</head>

<body>
  <!-- Header Nav -->
<header id="header" class="header header-fullwidth header-transparent-bg">
  <nav id="MainNavbar" class="navbar fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-in-out px-2 sm:px-5 py-1 flex flex-wrap justify-between items-center">
    <div class="flex items-center space-x-2 sm:space-x-4">
      <!-- Logo -->
      <a href="{{ route('index') }}" class="text-lg fw-bold">
        <img src="{{ asset('assets/images/Logo.png') }}" alt="Uomo" class="logo h-8 sm:h-12"/>
      </a>

      <!-- Nav Menu - Visible on all screens -->
      <ul class="flex sm:flex items-center gap-4 text-white font-semibold text-base sm:text-[17px]">
        <li><a href="{{ route('shop') }}" class="hover:border-b-3">Shop</a></li>
        <li><a href="{{ route('about') }}" class="hover:border-b-3">About Us</a></li>
      </ul>
    </div>

    <!-- Mobile menu button - Only visible on small screens -->
    <div class="sm:hidden">
      <button id="mobileMenuBtn" class="text-white">
        <iconify-icon icon="heroicons:menu" width="24" height="24" style="color: #fff"></iconify-icon>
      </button>
    </div>

    <!-- Icons -->
    <div class="flex items-center space-x-2 sm:space-x-4">
      <div class="icons flex items-center space-x-2 sm:space-x-3">
        <!-- icon search -->
        <a href="#" class="header-tools__item" aria-label="Search products">
            <iconify-icon icon="material-symbols:search-rounded" width="22" height="22" style="color: #fff"></iconify-icon>
        </a>
        <!-- icon cart -->
        <a href="#" class="header-tools__item" aria-label="View cart">
            <iconify-icon icon="uil:cart" width="22" height="22" style="color: #fff;"></iconify-icon>
        </a>
        <!--  -->
        @guest
        <!-- auth -->
        <a href="{{ route('login') }}" class="header-tools__item" aria-label="Login to account">
              <iconify-icon icon="ph:user-circle" width="22" height="22" style="color: #fff;"></iconify-icon>
        </a>
        @else
        
        <!-- action -->
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="header-tools__item flex items-center gap-2 cursor-pointer">
                <iconify-icon icon="ph:user-circle" width="22" height="22" style="color: #fff;"></iconify-icon>
                <span class="hidden sm:inline text-xs sm:text-sm font-semibold text-white truncate max-w-[80px] sm:max-w-full">{{ Auth::user()->name }}</span>
            </label>
            <ul tabindex="0" class="menu dropdown-content mt-2 p-2 shadow bg-base-100 rounded-box w-52">
                <!-- Dashboard -->
                <li>
                    @if(Auth::user()->utype === 'ADM')
                        <a href="{{ route('admin.index') }}">Profile Admin</a>
                    @else
                        <a href="{{ route('customer-user.index') }}">Profile User</a>
                    @endif
                </li>
                <li>
                    <!-- logout  -->
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="w-full text-left">Logout</button>
                  </form>
                </li>
            </ul>
        </div>
        @endguest
        </div>
      </div>
    </nav>

    <!-- Mobile Navigation Menu - Dropdown -->
    <div id="mobileMenu" class="hidden w-full bg-primary sm:hidden">
      <ul class="flex flex-col py-2 px-4">
        <li class="py-2"><a href="{{ route('shop') }}" class="text-white font-semibold">Shop</a></li>
        <li class="py-2"><a href="{{ route('about') }}" class="text-white font-semibold">About Us</a></li>
      </ul>
    </div>
</header>

<!-- Content Main -->
  <main>
  @yield("content")
  </main>

<!-- Footer -->
<footer class="text-base-content m-0 p-0" style="background-color: var(--tw-primary);">
  <!-- Bagian Atas Footer -->
  <div class="flex flex-col md:flex-row justify-between items-start px-4 sm:px-10 py-4 gap-6 h-auto">
    <!-- Kiri -->
    <nav class="w-full md:w-auto">
      <h3 class="mt-6 mb-3 text-white font-bold text-lg sm:text-xl">EXPLORE</h3>
      <ul>
        <li><a class="footer-link" href="{{ route('shop') }}">Shop</a></li>
        <li><a class="footer-link" href="{{ route('about') }}">About Us</a></li>
      </ul>

      <h3 class="mt-6 mb-3 text-white font-bold text-lg sm:text-xl">CONTACT US</h3>
      <ul>
        <li><a class="footer-link" href="#">+(62) 8259 9010</a></li>
        <li><a class="footer-link break-words" href="#">busyweekends@gmail.com</a></li>
        <li><a class="footer-link" href="#">Wonosobo, Central Java, Indonesia</a></li>
      </ul>
    </nav>

    <!-- Kanan (Logo Media Sosial) -->
    <div class="flex flex-col self-center md:self-end mt-4 md:mt-0">
      <div class="flex gap-4">
        <a>
          <iconify-icon icon="mingcute:instagram-line" width="25" height="25" style="color: #fff"></iconify-icon>
        </a>
        <a>
          <iconify-icon icon="ic:baseline-whatsapp" width="25" height="25" style="color: #fff"></iconify-icon>
        </a>
      </div>
    </div>
  </div>

  <!-- Copyright -->
  <div class="border-t border-gray-600 text-center py-4 mt-4">
    <p class="text-sm">© Copyright 2025 © Busy Weekends Jr</p>
  </div>
</footer>
<!-- End Footer -->

<div id="scrollTop" class="visually-hidden end-0"></div>

<!-- scripts -->
<script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/swiper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/countdown.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script>
  // Mobile menu toggle
  document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenuBtn && mobileMenu) {
      mobileMenuBtn.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
      });
    }
  });
</script>
@stack("scripts")

</body>
</html>