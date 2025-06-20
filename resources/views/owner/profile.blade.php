@extends('layouts.owner') 

@section('title', 'Owner Profile')

@section('content')
<div class="w-full h-full p-6">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-3xl font-bold text-slate-900 mb-6">Owner Profile</h2>
        <div class="flex items-center justify-center mb-6">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3a2592&color=fff" alt="{{ Auth::user()->name }}" class="w-32 h-32 rounded-full object-cover border-4 border-purple-500">
        </div>
        
        {{-- Pesan sukses setelah update --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('owner.profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT') {{-- Gunakan PUT method untuk update --}}

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" class="mt-1 block w-full rounded-xl border border-slate-300 p-3 focus:border-brand-500 focus:ring-brand-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" class="mt-1 block w-full rounded-xl border border-slate-300 p-3 focus:border-brand-500 focus:ring-brand-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                <div class="mt-1 flex items-center">
                    <input type="password" name="password" id="password" value="" class="block w-full rounded-xl border border-slate-300 p-3 focus:border-brand-500 focus:ring-brand-500 @error('password') border-red-500 @enderror" disabled>
                    <button type="button" id="changePasswordBtn" class="ml-2 text-blue-600 hover:text-blue-800">change</button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" value="" class="mt-1 block w-full rounded-xl border border-slate-300 p-3 focus:border-brand-500 focus:ring-brand-500" disabled>
            </div>
            <div>
                <label for="telephone" class="block text-sm font-medium text-slate-700">Telephone</label>
                <div class="mt-1 flex items-center">
                    <input type="text" name="telephone" id="telephone" value="{{ old('telephone', Auth::user()->telephone) }}" class="mt-1 block w-full rounded-xl border border-slate-300 p-3 focus:border-brand-500 focus:ring-brand-500 @error('telephone') border-red-500 @enderror">
                </div>
                @error('telephone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full bg-[#010BEB] text-white p-3 rounded-xl hover:bg-blue-500 transition-colors">Save Changes</button>
        </form>
        <div class="mt-8 text-center text-sm text-slate-500">
            <p>Copyright © Busy Weekends Jr</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');
    const changePasswordBtn = document.getElementById('changePasswordBtn');
    
    // Perbaikan untuk telephone, tidak perlu tombol 'change' lagi jika langsung editable
    const telephoneInput = document.getElementById('telephone'); 

    changePasswordBtn.addEventListener('click', function () {
        passwordInput.disabled = !passwordInput.disabled;
        passwordConfirmationInput.disabled = !passwordConfirmationInput.disabled;
        if (!passwordInput.disabled) {
            passwordInput.focus();
        } else {
            passwordInput.value = ''; // Clear fields if disabled
            passwordConfirmationInput.value = '';
        }
    });
});
</script>
@endsection