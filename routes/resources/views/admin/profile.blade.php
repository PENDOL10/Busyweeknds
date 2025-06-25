@extends('layouts.admin')

@section('title', 'Admin Profile')

@section('content')
<div class="w-full h-full p-6">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-3xl font-bold text-slate-900 mb-6">Profile</h2>
        <div class="flex items-center justify-center mb-6">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3a2592&color=fff" alt="{{ Auth::user()->name }}" class="w-32 h-32 rounded-full object-cover border-4 border-brand-500">
        </div>
        <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="mt-1 block w-full rounded-xl border border-slate-300 p-3 focus:border-brand-500 focus:ring-brand-500">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="mt-1 block w-full rounded-xl border border-slate-300 p-3 focus:border-brand-500 focus:ring-brand-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                <div class="mt-1 flex items-center">
                    <input type="password" name="password" id="password" value="" class="block w-full rounded-xl border border-slate-300 p-3 focus:border-brand-500 focus:ring-brand-500" disabled>
                    <button type="button" id="changePasswordBtn" class="ml-2 text-blue-600 hover:text-blue-800">change</button>
                </div>
            </div>
            <div>
                <label for="telephone" class="block text-sm font-medium text-slate-700">Telephone</label>
                <div class="mt-1 flex items-center">
                    <input type="text" name="telephone" id="telephone" value="{{ Auth::user()->telephone ?? '089786756454' }}" class="mt-1 block w-full rounded-xl border border-slate-300 p-3 focus:border-brand-500 focus:ring-brand-500">
                    <button type="button" id="changeTelephoneBtn" class="ml-2 text-blue-600 hover:text-blue-800">change</button>
                </div>
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
    const changePasswordBtn = document.getElementById('changePasswordBtn');
    const telephoneInput = document.getElementById('telephone');
    const changeTelephoneBtn = document.getElementById('changeTelephoneBtn');

    changePasswordBtn.addEventListener('click', function () {
        passwordInput.disabled = !passwordInput.disabled;
        passwordInput.focus();
    });

    changeTelephoneBtn.addEventListener('click', function () {
        telephoneInput.disabled = !telephoneInput.disabled;
        telephoneInput.focus();
    });
});
</script>
@endsection