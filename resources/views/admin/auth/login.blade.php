<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masuk - {{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS via CDN (No Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js (PlayCDN) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    
    
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full font-sans bg-white relative overflow-hidden" x-data="{ showPassword: false }">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden"></div>

    <div class="relative min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <a href="{{ route('home') }}" class="group flex items-center space-x-3">
                    <div class="w-12 h-12 bg-orange-600 rounded-2xl flex items-center justify-center">
                        <i data-lucide="package" class="w-7 h-7 text-white"></i>
                    </div>
                    <span class="text-3xl font-bold text-orange-700">
                        {{ config('app.name') }}
                    </span>
                </a>
            </div>

            <!-- Welcome Text -->
            <div class="text-center">
                <h2 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-3">
                    Selamat Datang Kembali! 👋
                </h2>
                <p class="text-lg text-gray-600 mb-2">
                    Masuk ke <span class="font-semibold text-orange-600">Admin Panel</span>
                </p>
                <p class="text-sm text-gray-500">
                    Kelola inventori Anda dengan mudah dan efisien
                </p>
            </div>
        </div>

        <!-- Login Form -->
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white/80 backdrop-blur-sm py-10 px-6 sm:rounded-3xl sm:px-12 border border-transparent">
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl">
                        <div class="flex items-start">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 mr-3 mt-0.5 flex-shrink-0"></i>
                            <div>
                                <h3 class="text-sm font-semibold text-red-800 mb-2">Terjadi kesalahan!</h3>
                                <ul class="list-disc pl-5 space-y-1 text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form class="space-y-6" action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="mail" class="w-5 h-5 text-orange-400"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="block w-full pl-12 pr-4 py-3 border border-transparent rounded-2xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                placeholder="admin@example.com"
                                value="{{ old('email') }}"
                                autofocus>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="w-5 h-5 text-orange-400"></i>
                            </div>
                            <input id="password" name="password" :type="showPassword ? 'text' : 'password'" autocomplete="current-password" required 
                                class="block w-full pl-12 pr-12 py-3 border border-transparent rounded-2xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                placeholder="••••••••">
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-orange-400 hover:text-orange-600 transition-colors duration-200">
                                <i data-lucide="eye" class="w-5 h-5" x-show="!showPassword"></i>
                                <i data-lucide="eye-off" class="w-5 h-5" x-show="showPassword" style="display: none;"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" 
                                class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-transparent rounded transition-colors duration-200"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="ml-3 block text-sm font-medium text-gray-700">
                                Ingat saya
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-semibold text-orange-600 hover:text-orange-500 transition-colors duration-200">
                                Lupa password?
                            </a>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <div>
                        <button type="submit" 
                            class="w-full rounded-2xl bg-orange-600 py-3 px-4 text-sm font-semibold text-white transition-colors duration-200 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                            <span class="flex items-center justify-center space-x-2">
                                <i data-lucide="log-in" class="w-5 h-5"></i>
                                <span>Masuk ke Dashboard</span>
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-transparent"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white/80 text-gray-500 font-medium">
                                Atau masuk dengan
                            </span>
                        </div>
                    </div>

                    <!-- Social Login -->
                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <button class="w-full inline-flex justify-center items-center py-3 px-4 border border-transparent rounded-2xl bg-white/50 backdrop-blur-sm text-sm font-medium text-gray-700 hover:bg-white transition-colors duration-200">
                            <i data-lucide="chrome" class="w-5 h-5 text-red-500 group-hover:scale-110 transition-transform duration-200"></i>
                            <span class="ml-2">Google</span>
                        </button>
                        <button class="w-full inline-flex justify-center items-center py-3 px-4 border border-transparent rounded-2xl bg-white/50 backdrop-blur-sm text-sm font-medium text-gray-700 hover:bg-white transition-colors duration-200">
                            <i data-lucide="github" class="w-5 h-5 text-gray-900 group-hover:scale-110 transition-transform duration-200"></i>
                            <span class="ml-2">GitHub</span>
                        </button>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-xs text-gray-500">
                        Butuh bantuan? 
                        <a href="#" class="font-semibold text-orange-600 hover:text-orange-500 transition-colors duration-200">
                            Hubungi Administrator
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Demo Credentials -->
        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-orange-50 rounded-2xl p-4 border border-orange-200/50" id="demoCard">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center">
                        <i data-lucide="info" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-900">Demo Credentials</div>
                        <div class="text-xs text-gray-600">Email: admin@example.com | Password: password</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Auto-fill demo credentials on click
        document.addEventListener('DOMContentLoaded', function() {
            const demoCard = document.getElementById('demoCard');
            if (demoCard) {
                demoCard.addEventListener('click', function() {
                    document.getElementById('email').value = 'admin@example.com';
                    document.getElementById('password').value = 'password';
                });
            }
        });
    </script>
</body>
</html>
