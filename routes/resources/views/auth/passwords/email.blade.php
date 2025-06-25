@extends('layouts.app')

@section('content')
<div class="relative min-h-screen w-full overflow-x-hidden font-poppins">
    <div class="absolute inset-0 -z-10">
        <img src="{{ asset('/assets/images/bg-login.png') }}" alt="background-login" class="w-full h-full object-cover">
    </div>

    <div class="flex flex-col items-center justify-center min-h-screen py-10 px-4">
        <div class="w-90 max-w-md space-y-8">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-3xl font-semibold text-black mb-4">{{ __('Reset Password') }}</h2>
                <p class="text-black mb-6">Enter your email to receive a password reset link.</p>

                @if (session('status'))
                    <div class="alert alert-success mb-4 text-sm"> {{-- Menggunakan alert-success DaisyUI --}}
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-6">
                        <input id="email" type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus
                               class="input input-bordered border border-black w-full mt-1 text-gray-700 bg-white @error('email') border-red-500 @enderror" />
                        @error('email')
                            <p class="text-red-500 text-xs mt-1" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn w-full bg-[#010BEB] text-white hover:bg-[#0009c4] transition-colors duration-300 border-none focus:outline-none">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection