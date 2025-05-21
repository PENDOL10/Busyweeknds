@extends('layouts.app')

@section('content')
    <!-- Background Image Section -->
    <div class="relative w-full h-40 md:h-48 lg:h-56 bg-cover bg-center" style="background-image: url('{{ asset('/assets/images/section.png') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-10"></div>
        <!-- Profile Title -->
        <div class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-4xl font-bold text-[#0009c4] text-center mt-12">PROFILE</h1>
        </div>
    </div>
    <!-- Main Content -->
    <main class="flex-grow">
        <div class="container mx-auto px-4 py-8">
            @if(session('error'))
                <div class="alert alert-error mb-4">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 mt-4">
                <div class="space-y-4">
                    <!-- Name -->
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="text-lg font-semibold text-black">{{ Auth::user()->name }}</p>
                    </div>

                    <!-- Email -->
                    <div class="border-b pb-2">
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="text-lg font-semibold text-black">{{ Auth::user()->email }}</p>
                    </div>

                    <!-- Password -->
                    <div class="border-b pb-2 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Password</p>
                            <p class="text-lg font-semibold text-black">********</p>
                        </div>
                        <button class="text-blue-600 hover:underline text-sm" onclick="document.getElementById('password-modal').showModal()">change</button>
                    </div>

                    <!-- Telephone -->
                    <div class="border-b pb-2 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Telephone</p>
                            <p class="text-lg font-semibold text-black">{{ Auth::user()->telephone }}</p>
                        </div>
                        <button class="text-blue-600 hover:underline text-sm" onclick="document.getElementById('telephone-modal').showModal()">change</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Password Change Modal -->
    <dialog id="password-modal" class="modal">
        <div class="modal-box bg-white relative">
            <h2 class="font-bold text-black">Change Password</h2>
            <!-- Ikon Silang untuk Menutup Modal -->
            <span class="absolute top-4 right-4 text-black text-4xl cursor-pointer" onclick="document.getElementById('password-modal').close()">&times;</span>
            <form method="POST" action="{{ route('account.update-password') }}">
                @csrf
                @method('PATCH')
                <div class="py-4 space-y-4">
                    <div>
                        <label class="label text-black">Current Password</label>
                        <input type="password" name="current_password" placeholder="Input Current Password" class="input input-bordered w-full border-black font-reguler text-gray-700 bg-white" required />
                    </div>
                    <div>
                        <label class="label text-black">New Password</label>
                        <input type="password" name="new_password" placeholder="New Password" class="input input-bordered w-full border-black font-reguler text-gray-700 bg-white" required />
                    </div>
                    <div>
                        <label class="label text-black">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" placeholder="Retype New Password" class="input input-bordered w-full border-black font-reguler text-gray-700 bg-white" required />
                    </div>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary w-full">Change Password</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Telephone Change Modal -->
    <dialog id="telephone-modal" class="modal">
        <div class="modal-box bg-white relative">
            <h2 class="font-bold text-black">Change Telephone</h2>
            <!-- Ikon Silang untuk Menutup Modal -->
            <span class="absolute top-4 right-4 text-black text-4xl cursor-pointer" onclick="document.getElementById('telephone-modal').close()">&times;</span>
            <form method="POST" action="{{ route('account.update-telephone') }}">
                @csrf
                @method('PATCH')
                <div class="py-4">
                    <label class="label text-black">New Telephone Number</label>
                    <input type="tel" name="telephone" placeholder="Retype New Telephone" class="input input-bordered w-full border border-black font-reguler text-gray-700 bg-white" value="{{ Auth::user()->telephone }}" required />
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary w-full">Change Telephone</button>
                </div>
            </form>
        </div>
    </dialog>
@endsection