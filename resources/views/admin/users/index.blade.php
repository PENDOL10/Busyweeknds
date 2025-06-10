@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Manage Users</h3>
        <div class="flex space-x-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." class="border rounded-lg px-4 py-2">
            <select name="status" class="border rounded-lg px-4 py-2">
                <option value="">All Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
            </select>
            <button onclick="this.closest('form').submit()" class="bg-navy-900 text-white px-4 py-2 rounded-lg">Filter</button>
        </div>
    </div>
    <table class="w-full">
        <thead>
            <tr class="text-left text-gray-600">
                <th class="pb-2">Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="border-t">
                <td class="py-2"><img src="{{ $user->avatar ?? '/assets/images/default-avatar.png' }}" alt="Avatar" class="w-10 h-10 rounded-full"></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
                <td class="space-x-2">
                    <a href="{{ route('admin.users.show', $user) }}" class="text-navy-600 hover:text-navy-800">View</a>
                    <form action="{{ route('admin.users.suspend', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('POST')
                        <button type="submit" class="text-yellow-600 hover:text-yellow-800">{{ $user->status === 'active' ? 'Suspend' : 'Activate' }}</button>
                    </form>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection