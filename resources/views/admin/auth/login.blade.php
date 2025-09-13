<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masuk - Laraventory</title>

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
        
        /* Custom checkbox styling */
        input[type="checkbox"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            display: inline-block;
            vertical-align: middle;
            background-origin: border-box;
            user-select: none;
            flex-shrink: 0;
            height: 1rem;
            width: 1rem;
            border-width: 1px;
            border-radius: 0.25rem;
        }
        
        input[type="checkbox"]:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
            background-color: #f97316;
            border-color: #f97316;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="h-full font-sans bg-white relative" x-data="{ showPassword: false }">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-br from-white to-gray-100"></div>

    <div class="relative min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <!-- Logo -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center mb-10">
            <h1 class="text-3xl font-bold text-blue-600">Laraventory</h1>
            <p class="mt-2 text-sm text-gray-600">Smart Inventory Management System</p>
        </div>

        <!-- Login Form -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white/80 py-10 px-8 sm:rounded-xl sm:px-12 border border-blue-200/60">
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
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
                                <i data-lucide="mail" class="w-5 h-5 text-blue-500"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none focus:border-blue-300 focus:ring-1 focus:ring-blue-100 transition-all duration-200 bg-white/50"
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
                                <i data-lucide="lock" class="w-5 h-5 text-blue-400"></i>
                            </div>
                            <input id="password" name="password" :type="showPassword ? 'text' : 'password'" autocomplete="current-password" required 
                                class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none focus:border-blue-300 focus:ring-1 focus:ring-blue-100 transition-all duration-200 bg-white/50"
                                placeholder="••••••••">
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-blue-500 hover:text-blue-700 transition-colors duration-200">
                                <i data-lucide="eye" class="w-5 h-5" x-show="!showPassword"></i>
                                <i data-lucide="eye-off" class="w-5 h-5" x-show="showPassword" style="display: none;"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" 
                                class="h-4 w-4 border-gray-300 rounded focus:ring-blue-200 text-blue-500 transition-all duration-200"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="ml-2 block text-sm text-gray-700">
                                Ingat Saya
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600 transition-all duration-200">
                                Lupa Password?
                            </a>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <div>
                        <button type="submit" 
                            class="w-full rounded-2xl bg-blue-600 py-3 px-4 text-sm font-semibold text-white transition-colors duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <span class="flex items-center justify-center space-x-2">
                                <i data-lucide="log-in" class="w-5 h-5"></i>
                                <span>Masuk ke Dashboard</span>
                            </span>
                        </button>
                    </div>
                </form>

                

                
            </div>
        </div>

        <!-- Demo Credentials -->
        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-blue-50 rounded-lg p-4 border border-blue-200/60" id="demoCard">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 bg-blue-500/10 rounded-lg flex items-center justify-center">
                        <i data-lucide="info" class="w-4 h-4 text-blue-500"></i>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-800">Demo Credentials</div>
                        <div class="text-xs text-gray-500 mt-0.5">Email: admin@example.com | Password: password</div>
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
