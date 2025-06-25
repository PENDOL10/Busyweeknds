@extends('layouts.admin')
@section('title', 'User Details')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow-lg max-w-2xl mx-auto">
    @if (session('success'))
        <div class="mb-4 p-2 bg-green-100 text-green-800 rounded text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-2 bg-red-100 text-red-800 rounded text-sm">
            {{ session('error') }}
        </div>
    @endif

    <h3 class="text-lg font-semibold text-gray-700 mb-4">User Details</h3>
    <div class="space-y-4">
        <div class="flex items-center space-x-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=e0e9ff&color=3145c5" class="w-16 h-16 rounded-full" alt="{{ $user->name }}">
            <div>
                <h4 class="text-xl font-bold text-navy-800">{{ $user->name }}</h4>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>
        </div>
        <div>
            <p class="text-sm text-gray-700">Status: 
                <span class="px-2 py-1 rounded text-sm {{ $user->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ ucfirst($user->status ?? 'active') }}
                </span>
            </p>
        </div>
        <div>
            <p class="text-sm text-gray-700">Joined: {{ $user->created_at->format('d M Y') }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-700">Telephone: {{ $user->telephone ?? 'Not set' }}</p>
        </div>
        <div class="flex space-x-4">
            @if ($user->status == 'active')
                <form method="POST" action="{{ route('admin.users.suspend', $user->id) }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-yellow-500 px-3 py-1.5 text-sm font-medium text-white shadow-sm transition-all hover:bg-yellow-600" onclick="return confirm('Are you sure you want to suspend this user?')">Suspend</button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.users.activate', $user->id) }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-green-500 px-3 py-1.5 text-sm font-medium text-white shadow-sm transition-all hover:bg-green-600" onclick="return confirm('Are you sure you want to activate this user?')">Activate</button>
                </form>
            @endif
            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?')">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-red-500 px-3 py-1.5 text-sm font-medium text-white shadow-sm transition-all hover:bg-red-600">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection