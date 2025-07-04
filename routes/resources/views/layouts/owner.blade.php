<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Busyweeknds') }} Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'brand': {
                            '50': '#f9f5ff', '100': '#ece6fb', '200': '#d8c9f6', '300': '#c0a8f0',
                            '400': '#a885ea', '500': '#8f63e3', '600': '#7a4ede', '700': '#653fd6',
                            '800': '#4e32b8', '900': '#3a2592', '950': '#2d1c6e',
                        },
                        'slate': {
                            '50': '#f8fafc', '100': '#f1f5f9', '200': '#e2e8f0', '300': '#cbd5e1',
                            '400': '#94a3b8', '500': '#64748b', '600': '#475569', '700': '#334155',
                            '800': '#1e293b', '900': '#0f172a', '950': '#020617'
                        }
                    }
                }
            }
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased w-full h-screen">
    <div x-data="{ 
            sidebarOpen: window.innerWidth > 1024,
            deleteModalOpen: false,
            deleteUrl: ''
        }" 
        @resize.window="sidebarOpen = window.innerWidth > 1024" 
        @open-delete-modal.window="deleteModalOpen = true; deleteUrl = $event.detail.deleteUrl"
        class="flex h-screen">

        <!-- Sidebar -->
        <aside 
            x-show="sidebarOpen" 
            x-cloak
            @click.outside="if(window.innerWidth < 1024) sidebarOpen = false"
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed lg:static z-40 w-64 h-full bg-[#010BEB] from-brand-900 to-brand-800 text-white shadow-2xl transition-all duration-300 ease-in-out">
            <div class="flex flex-start p-4 left-0 border-b border-brand-700">
                <a href="{{ route('owner.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/Logo.png') }}" alt="Logo" class="h-30 w-auto">
                    <span class="text-3xl font-bold text-white transition-opacity duration-300">Owner</span>
                </a>
            </div>
            <nav class="flex-1 space-y-2 px-4 py-6">
                <a href="{{ route('owner.dashboard') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 transition-all {{ Route::is('admin.dashboard') ? 'bg-[#5DA9FF] text-white' : 'hover:bg-[#5DA9FF]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6zm2-10h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2"></path>
                </svg>                    
                <span class="text-lg transition-opacity duration-300">Dashboard</span>
                <a href="{{ route('owner.settings') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 transition-all {{ Route::is('admin.dashboard') ? 'bg-[#5DA9FF] text-white' : 'hover:bg-[#5DA9FF]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 2048 2048">
                    <path fill="currentColor" d="M1783 988v18q0 9 1 18v18q0 9-1 18l259 161l-159 383l-297-68q-24 26-50 50l68 297l-383 159l-161-259h-18q-9 0-18 1h-18q-9 0-18-1l-161 259l-383-159l68-297q-26-24-50-50l-297 68L6 1221l259-161v-18q0-9-1-18v-18q0-9 1-18L6 827l159-383l297 68q24-26 50-50l-68-297L827 6l161 259h18q9 0 18-1h18q9 0 18 1L1221 6l383 159l-68 297q26 24 50 50l297-68l159 383zm-117 130q2-24 4-47t2-48q0-23-2-47t-4-47l236-147l-86-208l-271 63q-31-38-63-70t-71-64l63-271l-208-86l-148 236q-23-2-47-4t-47-2q-24 0-47 2t-48 4L782 146l-208 86l63 271q-38 31-70 63t-64 71l-271-63l-86 208l236 148q-2 24-4 47t-2 48q0 23 2 47t4 47l-236 147l86 208l271-63q31 38 63 70t71 64l-63 271l208 86l148-236q23 2 47 4t47 2q24 0 47-2t48-4l147 236l208-86l-63-271q38-31 70-63t64-71l271 63l86-208zm-642-470q78 0 146 29t120 81t80 119t30 147q0 78-29 146t-81 120t-119 80t-147 30q-78 0-146-29t-120-81t-80-119t-30-147q0-78 29-146t81-120t119-80t147-30m0 640q55 0 103-20t84-57t56-84t21-103q0-55-20-103t-57-84t-84-56t-103-21q-55 0-103 20t-84 57t-56 84t-21 103q0 55 20 103t57 84t84 56t103 21"></path>
                </svg>                   
                <span class="text-lg transition-opacity duration-300">Settings</span>
                </a>
                </a>
            </nav>
            <div class="p-4 border-t border-brand-700">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-red-200 transition-all hover:bg-red-700 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 14 14">
                        <path fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" d="M9.5 10.5v2a1 1 0 0 1-1 1h-7a1 1 0 0 1-1-1v-11a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v2M6.5 7h7m-2-2l2 2l-2 2" strokeWidth={1}></path>
                    </svg>           
                    <span class="text-lg transition-opacity duration-300">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col w-full">
            <header class="sticky top-0 z-20 bg-white/90 backdrop-blur-lg border-b border-slate-200 shadow-md">
                <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-slate-500 hover:text-brand-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                    <div class="flex-1 flex justify-center">
                        <input type="text" placeholder="Quick search..." class="w-full max-w-md rounded-xl border border-slate-300 px-4 py-2 focus:border-brand-500 focus:ring-brand-500 transition-all">
                    </div>
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-2 rounded-full bg-brand-100 p-2 hover:bg-brand-200 transition-all">
                            <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3a2592&color=fff" alt="Admin">
                            <span class="hidden sm:block font-medium text-slate-700">{{ Auth::user()->name }}</span>
                            <svg x-bind:class="{ 'rotate-180': dropdownOpen }" class="h-4 w-4 text-brand-700 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-cloak class="absolute right-0 mt-2 w-48 origin-top-right rounded-xl bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <a href="{{ route('owner.profile') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-brand-50">My Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-brand-50">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>

        <!-- Delete Modal -->
        <div x-show="deleteModalOpen" x-cloak
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
            <div x-show="deleteModalOpen"
                @click.outside="deleteModalOpen = false"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
                class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126z" /></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-slate-900">Delete Item</h3>
                        <p class="mt-1 text-sm text-slate-500">Are you sure you want to delete this item? This action cannot be undone.</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button @click="deleteModalOpen = false" type="button" class="rounded-xl border bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-md hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                        Cancel
                    </button>
                    <form :action="deleteUrl" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-xl bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            Yes, Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-cloak
                class="fixed bottom-5 right-5 z-50 rounded-xl bg-brand-800 px-5 py-3 text-white shadow-lg">
                <div class="flex items-center gap-3">
                    <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3.75m0 0l3-3.75m-3 3.75V3.375m0 16.5v-7.5m0 0l3-3.75m-3 3.75l-3-3.75" /></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @yield('scripts')
    </div>
</body>
</html>