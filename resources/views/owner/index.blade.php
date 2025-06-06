@extends('app')

@section('content')
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Owner Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }}! You are logged in as an Owner.</p>
        
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="#" class="bg-purple-500 text-white p-4 rounded-lg hover:bg-purple-600">
                    View Reports
                </a>
                <a href="#" class="bg-indigo-500 text-white p-4 rounded-lg hover:bg-indigo-600">
                    Manage Admins
                </a>
                <a href="#" class="bg-teal-500 text-white p-4 rounded-lg hover:bg-teal-600">
                    Financial Overview
                </a>
            </div>
        </div>
    </div>
@endsection