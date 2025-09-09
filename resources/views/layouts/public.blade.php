<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tailwind CSS (PlayCDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js (PlayCDN) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body class="min-h-full flex flex-col">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="/" class="font-semibold text-blue-600">{{ config('app.name') }}</a>
            <nav class="flex gap-4 text-sm text-gray-700">
                <a href="/" class="hover:text-blue-600">Home</a>
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Admin</a>
            </nav>
        </div>
    </header>

    <!-- Main -->
    <main class="flex-1 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between text-sm text-gray-500">
            <span>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</span>
            <span>Powered by Laravel</span>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
