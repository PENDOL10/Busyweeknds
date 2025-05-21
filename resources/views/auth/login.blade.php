<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="mytheme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Busyweeknds') }}</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="bsyweeknds" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.8.0/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative min-h-screen w-full overflow-x-hidden font-poppins">
    <!-- Background image full screen -->
    <div class="absolute inset-0 -z-10">
        <img src="{{ asset('/assets/images/bg-login.png') }}" alt="background-login" class="w-full h-full object-cover">
    </div>

    <div class="flex flex-col items-center justify-center min-h-screen py-10 px-4">
        <div class="w-90 max-w-md space-y-8">
            <!-- Login Form -->
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-3xl font-semibold text-black mb-4">Login</h2>
                <p class="text-black mb-6">Enter your email or telephone and password below if you already have an account</p>

                @if ($errors->any())
                    <div class="alert alert-error mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-2">
                        <input id="login" type="text" name="login" placeholder="Email or Telephone" value="{{ old('login') }}" required autofocus
                            class="input input-bordered border border-black w-full mt-1 text-gray-700 bg-white" />
                    </div>

                    <div class="mb-6">
                        <input id="password" type="password" name="password" placeholder="Password" required
                            class="input input-bordered border border-black w-full mt-1 text-gray-700 bg-white" />
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="checkbox checkbox-primary" {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
                                Forgot Password?
                            </a>
                        @endif
                    </div>
                    <!-- Button Submit -->
                    <button type="submit" class="btn w-full bg-[#010BEB] text-white hover:bg-[#0009c4] transition-colors duration-300 border-none focus:outline-none">
                        Login
                    </button>
                </form>
            </div>

            <!-- Register Link -->
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-3xl font-semibold text-black mb-4">Register</h2>
                <p class="text-black mb-6">Don't have an account? Click the button below to register</p>
                
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn w-full bg-[#010BEB] text-white hover:bg-[#0009c4] transition-colors duration-300 border-none focus:outline-none">
                        Register
                    </a>           
                @endif
            </div>
        </div>
    </div>
</body>
</html>