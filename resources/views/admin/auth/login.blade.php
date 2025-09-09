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
    
    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ocean': {
                            50: '#f0f9ff',
                            100: '#e0f2fe', 
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49'
                        },
                        'mint': {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a'
                        }
                    },
                    fontFamily: {
                        'display': ['Inter', 'system-ui', 'sans-serif'],
                        'body': ['Inter', 'system-ui', 'sans-serif']
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'slide-up': 'slide-up 0.5s ease-out',
                        'fade-in': 'fade-in 0.6s ease-out',
                        'bounce-gentle': 'bounce-gentle 2s ease-in-out infinite'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 5px rgba(14, 165, 233, 0.5)' },
                            '100%': { boxShadow: '0 0 20px rgba(14, 165, 233, 0.8)' }
                        },
                        'slide-up': {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        },
                        'fade-in': {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        'bounce-gentle': {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-5px)' }
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full font-body bg-gradient-to-br from-ocean-50 via-white to-mint-50 relative overflow-hidden" x-data="{ showPassword: false }">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-ocean-200/30 rounded-full blur-3xl animate-float"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-mint-200/30 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-r from-ocean-100/40 to-mint-100/40 rounded-full blur-2xl animate-bounce-gentle"></div>
    </div>

    <div class="relative min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md animate-slide-up">
            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <a href="{{ route('home') }}" class="group flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-ocean-500 to-mint-500 rounded-2xl flex items-center justify-center animate-glow group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="package" class="w-7 h-7 text-white"></i>
                    </div>
                    <span class="text-3xl font-display font-bold bg-gradient-to-r from-ocean-600 to-mint-600 bg-clip-text text-transparent">
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
                    Masuk ke <span class="font-semibold text-ocean-600">Admin Panel</span>
                </p>
                <p class="text-sm text-gray-500">
                    Kelola inventori Anda dengan mudah dan efisien
                </p>
            </div>
        </div>

        <!-- Login Form -->
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md animate-slide-up" style="animation-delay: 0.1s;">
            <div class="bg-white/80 backdrop-blur-sm py-10 px-6 shadow-2xl sm:rounded-3xl sm:px-12 border border-white/20">
                @if($errors->any())
                    <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 rounded-2xl animate-slide-up">
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
                                <i data-lucide="mail" class="w-5 h-5 text-ocean-400"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm"
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
                                <i data-lucide="lock" class="w-5 h-5 text-ocean-400"></i>
                            </div>
                            <input id="password" name="password" :type="showPassword ? 'text' : 'password'" autocomplete="current-password" required 
                                class="block w-full pl-12 pr-12 py-3 border border-gray-200 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                placeholder="••••••••">
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-ocean-400 hover:text-ocean-600 transition-colors duration-200">
                                <i data-lucide="eye" class="w-5 h-5" x-show="!showPassword"></i>
                                <i data-lucide="eye-off" class="w-5 h-5" x-show="showPassword" style="display: none;"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" 
                                class="h-4 w-4 text-ocean-600 focus:ring-ocean-500 border-gray-300 rounded transition-colors duration-200"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="ml-3 block text-sm font-medium text-gray-700">
                                Ingat saya
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-semibold text-ocean-600 hover:text-ocean-500 transition-colors duration-200">
                                Lupa password?
                            </a>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <div>
                        <button type="submit" 
                            class="group relative w-full overflow-hidden rounded-2xl bg-gradient-to-r from-ocean-500 to-mint-500 py-3 px-4 text-sm font-semibold text-white shadow-2xl transition-all duration-300 hover:shadow-ocean-500/25 hover:shadow-2xl hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:ring-offset-2">
                            <span class="relative z-10 flex items-center justify-center space-x-2">
                                <i data-lucide="log-in" class="w-5 h-5"></i>
                                <span>Masuk ke Dashboard</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-ocean-600 to-mint-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white/80 text-gray-500 font-medium">
                                Atau masuk dengan
                            </span>
                        </div>
                    </div>

                    <!-- Social Login -->
                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <button class="group relative overflow-hidden w-full inline-flex justify-center items-center py-3 px-4 border border-gray-200 rounded-2xl shadow-sm bg-white/50 backdrop-blur-sm text-sm font-medium text-gray-700 hover:bg-white hover:shadow-lg transition-all duration-200">
                            <i data-lucide="chrome" class="w-5 h-5 text-red-500 group-hover:scale-110 transition-transform duration-200"></i>
                            <span class="ml-2">Google</span>
                        </button>
                        <button class="group relative overflow-hidden w-full inline-flex justify-center items-center py-3 px-4 border border-gray-200 rounded-2xl shadow-sm bg-white/50 backdrop-blur-sm text-sm font-medium text-gray-700 hover:bg-white hover:shadow-lg transition-all duration-200">
                            <i data-lucide="github" class="w-5 h-5 text-gray-900 group-hover:scale-110 transition-transform duration-200"></i>
                            <span class="ml-2">GitHub</span>
                        </button>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-xs text-gray-500">
                        Butuh bantuan? 
                        <a href="#" class="font-semibold text-ocean-600 hover:text-ocean-500 transition-colors duration-200">
                            Hubungi Administrator
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Demo Credentials -->
        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md animate-slide-up" style="animation-delay: 0.2s;">
            <div class="bg-gradient-to-r from-ocean-50 to-mint-50 rounded-2xl p-4 border border-ocean-200/50">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-ocean-400 to-mint-400 rounded-xl flex items-center justify-center">
                        <i data-lucide="info" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-ocean-900">Demo Credentials</div>
                        <div class="text-xs text-ocean-600">Email: admin@example.com | Password: password</div>
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
            const demoCard = document.querySelector('.bg-gradient-to-r.from-ocean-50');
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
