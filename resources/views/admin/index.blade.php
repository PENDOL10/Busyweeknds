@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-primary">Admin Dashboard</h1>
            <span class="badge badge-primary p-3">Administrator</span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Stats Card -->
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <h3 class="font-semibold mb-2">Total Products</h3>
                <p class="text-2xl font-bold">0</p>
            </div>
            
            <!-- Stats Card -->
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <h3 class="font-semibold mb-2">Total Users</h3>
                <p class="text-2xl font-bold">1</p>
            </div>
            
            <!-- Stats Card -->
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <h3 class="font-semibold mb-2">Total Orders</h3>
                <p class="text-2xl font-bold">0</p>
            </div>
        </div>
        
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
            <div class="flex flex-wrap gap-4">
                <button class="btn btn-primary">Add New Product</button>
                <button class="btn btn-secondary">View Orders</button>
                <button class="btn">Manage Users</button>
            </div>
        </div>
    </div>
</div>
@endsection