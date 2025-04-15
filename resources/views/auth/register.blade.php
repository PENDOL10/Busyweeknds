<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="mytheme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - {{ config('app.name', 'Laravel') }}</title>

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
        <img src="{{ asset('/assets/images/bg-register.png') }}" alt="background-register" class="w-full h-full object-cover">
    </div>
    <div class="flex flex-col items-center justify-center min-h-screen py-10 px-4">
        <div class="w-90 max-w-md space-y-8">
            <!-- Register Form -->
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-3xl font-semibold text-black mb-4">Register</h2>
                <p class="text-black mb-6">Don't have an account? Click the button below to register</p>

            <!-- Display Errors -->
            @if ($errors->any())
                <div class="alert alert-error mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form Input -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-2">
                        <input id="name" type="name" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus
                            class="input input-bordered border border-black w-full mt-1 text-gray-700 bg-white" />
                    </div>

                    <!-- Email -->
                    <div class="mb-2">
                        <input id="email" type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus
                            class="input input-bordered border border-black w-full mt-1 text-gray-700 bg-white" />
                    </div>

                    <!-- Password -->
                    <div class="mb-2">
                        <input id="password" type="password" name="password" placeholder="Password" required
                            class="input input-bordered border border-black w-full mt-1 text-gray-700 bg-white" />
                    </div>

                    <!-- Telephone -->
                    <div class="mb-8">
                        <input id="Telephone" type="Telephone" name="Telephone" placeholder="Telephone" required
                            class="input input-bordered border border-black w-full mt-1 text-gray-700 bg-white"/>
                    </div>

                    <!-- Button Submit -->
                    <button type="submit" class="btn btn-primary w-full">Register</button>
                </form>
                
                <!-- Login Link -->
                @if (Route::has('login'))
                    <p class="mt-4 text-center text-sm text-gray-600">
                        Already have an account? <a href="{{ route('login') }}" class="text-primary hover:underline">Login</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
    </body>