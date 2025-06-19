@extends('layouts.admin')
@section('title', 'Manage Customers')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    <div>
        <h2 class="text-3xl font-bold text-slate-800">Customers</h2>
        <p class="mt-1 text-slate-500">View, search, and manage customer accounts.</p>
    </div>

    <div class="rounded-2xl bg-white p-6 shadow-lg">
        <form action="{{ route('admin.users.index') }}" method="GET">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-6">
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                    <input type="text" name="search" placeholder="Search by name or email..." value="{{ request('search') }}" class="w-full rounded-lg border-slate-300 pl-10 focus:border-navy-500 focus:ring-navy-500">
                </div>
                <div class="flex items-center gap-4">
                    <select name="status" class="rounded-lg border-slate-300 text-sm focus:border-navy-500 focus:ring-navy-500 transition">
                        <option value="">All Status</option>
                        <option value="active" @selected(request('status') == 'active')>Active</option>
                        <option value="suspended" @selected(request('status') == 'suspended')>Suspended</option>
                    </select>
                    <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-[#010BEB] px-4 py-2.5 text-sm font-medium text-white shadow-sm transition-all hover:bg-brand-800">Filter</button>
                </div>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-sm font-semibold text-slate-500 border-b-2 border-slate-200">
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Joined Date</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=e0e9ff&color=3145c5" class="w-10 h-10 rounded-full" alt="{{ $user->name }}">
                                <span class="font-medium text-slate-700">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="p-4 text-slate-600">{{ $user->email }}</td>
                        <td class="p-4 text-slate-600">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="p-4">
                             <span @class([
                                'inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium',
                                'bg-green-100 text-green-800' => ($user->status ?? 'active') == 'active',
                                'bg-red-100 text-red-800' => ($user->status ?? 'active') == 'suspended',
                            ])>
                                <span @class(['h-1.5 w-1.5 rounded-full', 'bg-green-600' => ($user->status ?? 'active') == 'active', 'bg-red-600' => ($user->status ?? 'active') == 'suspended'])></span>
                                {{ ucfirst($user->status ?? 'active') }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="inline-flex items-center justify-center rounded-lg bg-blue-500 px-3 py-1.5 text-sm font-medium text-white shadow-sm transition-all hover:bg-blue-600">View</a>
                                <form method="POST" action="{{ route('admin.users.suspend', $user->id) }}" onsubmit="return confirm('Are you sure you want to suspend this user?')" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-yellow-500 px-3 py-1.5 text-sm font-medium text-white shadow-sm transition-all hover:bg-yellow-600">Suspend</button>
                                </form>
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-red-600 px-3 py-1.5 text-sm font-medium text-white shadow-sm transition-all hover:bg-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-slate-500">No customers found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
</div>
<script>
    function searchUsers() {
        let input = document.getElementById('searchInput').value.toLowerCase();
        let table = document.getElementById('userTable');
        let rows = table.getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {
            let name = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
            let email = rows[i].getElementsByTagName('td')[2].textContent.toLowerCase();
            if (name.includes(input) || email.includes(input)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
    function filterUsers() {
        let status = document.getElementById('statusFilter').value;
        let table = document.getElementById('userTable');
        let rows = table.getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {
            let statusCell = rows[i].getElementsByTagName('td')[3].textContent.toLowerCase();
            if (status === '' || statusCell.includes(status)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
    function sortTable(column) {
        let table = document.getElementById('userTable');
        let rows = Array.from(table.getElementsByTagName('tr'));
        let sorted = rows.sort((a, b) => {
            let aVal = a.getElementsByTagName('td')[1].textContent;
            let bVal = b.getElementsByTagName('td')[1].textContent;
            return aVal.localeCompare(bVal);
        });
        table.innerHTML = '';
        sorted.forEach(row => table.appendChild(row));
    }
</script>
@endsection