@extends('layouts.owner')

@section('title', 'Owner Settings')

@section('content')
<div class="w-full h-full p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-3xl font-bold text-slate-900 mb-6">Owner Settings</h2>
        
        <p class="text-lg text-slate-600 mb-8">Manage various settings for your business dashboard.</p>

        {{-- Pesan sukses setelah update --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="space-y-6">
            <div class="border-b border-slate-200 pb-6">
                <h3 class="text-xl font-semibold text-slate-800 mb-2">General Settings</h3>
                <p class="text-sm text-slate-500 mb-4">Update general preferences for your dashboard.</p>
                
                {{-- FORM INI YANG PERLU DIPERBAIKI --}}
                <form action="{{ route('owner.settings.update') }}" method="POST"> {{-- Tentukan route dan method --}}
                    @csrf {{-- Penting untuk keamanan --}}
                    <div class="mb-4">
                        <label for="report_period" class="block text-sm font-medium text-slate-700">Default Report Period</label>
                        <select name="report_period" id="report_period" class="mt-1 block w-full md:w-1/2 rounded-xl border border-slate-300 p-3 focus:border-brand-500 focus:ring-brand-500">
                            <option value="30" {{ old('report_period', session('owner_report_period', 30)) == 30 ? 'selected' : '' }}>Last 30 Days</option>
                            <option value="90" {{ old('report_period', session('owner_report_period', 30)) == 90 ? 'selected' : '' }}>Last 90 Days</option>
                            <option value="365" {{ old('report_period', session('owner_report_period', 30)) == 365 ? 'selected' : '' }}>Last 365 Days</option>
                        </select>
                        @error('report_period')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-[#010BEB] text-white px-4 py-2 rounded-lg hover:bg-blue-600">Save General Settings</button>
                </form>
            </div>

            <div class="border-b border-slate-200 pb-6">
                <h3 class="text-xl font-semibold text-slate-800 mb-2">Notification Preferences</h3>
                <p class="text-sm text-slate-500 mb-4">Configure how you receive notifications.</p>
                
                {{-- Form untuk notifikasi (jika terpisah atau ingin disubmit via JS/Ajax) --}}
                <form action="{{ route('owner.settings.update') }}" method="POST"> {{-- Bisa gunakan rute yang sama atau rute berbeda --}}
                    @csrf
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="email_notifications" id="email_notifications" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" {{ old('email_notifications', session('owner_email_notifications')) ? 'checked' : '' }}>
                        <label for="email_notifications" class="ml-2 block text-sm text-gray-900">Enable email notifications for new orders</label>
                    </div>
                    @error('email_notifications')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="bg-[#010BEB] text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update Notifications</button>
                </form>
            </div>
            
            {{-- Tambahkan bagian settings lainnya sesuai kebutuhan --}}

        </div>
    </div>
</div>
@endsection