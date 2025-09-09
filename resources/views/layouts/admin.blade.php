<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name').' Admin')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tailwind CSS (PlayCDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js (PlayCDN) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body class="h-full">
    <!-- Top navigation -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-40">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="font-semibold text-blue-600">{{ config('app.name') }}</a>
                    <span class="text-gray-300">|</span>
                    <span class="text-gray-600">Admin Panel</span>
                </div>

                <div class="flex items-center gap-3">
                    @auth('admin')
                        <span class="text-sm text-gray-600">{{ auth('admin')->user()->name }}</span>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                Logout
                            </button>
                        </form>
                    @endauth

                    @guest('admin')
                        <a href="{{ route('admin.login') }}" class="inline-flex items-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Login
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Flash messages -->
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-50 p-4 text-red-800">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Page heading -->
            @hasSection('header')
                <div class="mb-6">
                    @yield('header')
                </div>
            @endif

            <!-- Main content -->
            <div class="grid grid-cols-12 gap-6">
                <!-- Sidebar -->
                <aside class="col-span-12 lg:col-span-3">
                    <div class="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-200">
                        <nav class="space-y-1">
                            <a href="{{ route('admin.dashboard') }}" class="block rounded px-3 py-2 text-sm hover:bg-gray-50 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('admin.products.index') }}" class="block rounded px-3 py-2 text-sm hover:bg-gray-50 {{ request()->routeIs('admin.products.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                                Products
                            </a>
                            <a href="{{ route('admin.categories.index') }}" class="block rounded px-3 py-2 text-sm hover:bg-gray-50 {{ request()->routeIs('admin.categories.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                                Categories
                            </a>
                            <a href="{{ route('admin.suppliers.index') }}" class="block rounded px-3 py-2 text-sm hover:bg-gray-50 {{ request()->routeIs('admin.suppliers.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                                Suppliers
                            </a>
                            <a href="{{ route('admin.inventory.index') }}" class="block rounded px-3 py-2 text-sm hover:bg-gray-50 {{ request()->routeIs('admin.inventory.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                                Inventory
                            </a>
                            <a href="{{ route('admin.reports.stock') }}" class="block rounded px-3 py-2 text-sm hover:bg-gray-50 {{ request()->routeIs('admin.reports.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                                Reports
                            </a>
                            <a href="{{ route('admin.profile.edit') }}" class="block rounded px-3 py-2 text-sm hover:bg-gray-50 {{ request()->routeIs('admin.profile.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                                Profile
                            </a>
                        </nav>
                    </div>
                </aside>

                <!-- Content -->
                <main class="col-span-12 lg:col-span-9">
                    <div class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>