<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Tailwind CSS (PlayCDN) -->
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
                        'fade-in': 'fade-in 0.6s ease-out'
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
                        }
                    }
                }
            }
        }
    </script>
    <style>
       /* Simple tilt badge utility */
       .tilt { transform: rotate(-8deg); }
       .tilt-r { transform: rotate(8deg); }
       
       /* Background pattern kotak-kotak transparant */
       body {
            background-color: white;
            background-image: 
                repeating-linear-gradient(0deg, rgba(14, 165, 233, 0.08) 0px, rgba(14, 165, 233, 0.08) 1px, transparent 1px, transparent 50px),
                repeating-linear-gradient(90deg, rgba(16, 185, 129, 0.06) 0px, rgba(16, 185, 129, 0.06) 1px, transparent 1px, transparent 50px),
                repeating-linear-gradient(45deg, rgba(6, 182, 212, 0.04) 0px, rgba(6, 182, 212, 0.04) 1px, transparent 1px, transparent 100px);
        }
        
       /* Dark mode pattern override */
       .dark body {
         background-color: #0b0b0e;
         background-image:
           repeating-linear-gradient(0deg, rgba(14, 165, 233, 0.08) 0px, rgba(14, 165, 233, 0.08) 1px, transparent 1px, transparent 40px),
           repeating-linear-gradient(90deg, rgba(16, 185, 129, 0.06) 0px, rgba(16, 185, 129, 0.06) 1px, transparent 1px, transparent 40px),
           repeating-linear-gradient(45deg, rgba(14, 165, 233, 0.04) 0px, rgba(14, 165, 233, 0.04) 1px, transparent 1px, transparent 80px);
       }
     </style>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @stack('styles')
</head>
<body class="min-h-full flex flex-col font-body">
    <!-- Header -->
    <header class="sticky top-0 z-50 backdrop-blur-xl bg-white/80 border-b border-ocean-200/50 shadow-sm" x-data="{ mobileMenuOpen: false }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-ocean-500 to-mint-500 rounded-xl flex items-center justify-center animate-glow">
                        <i data-lucide="package" class="w-5 h-5 text-white"></i>
                    </div>
                    <a href="/" class="font-display font-bold text-xl bg-gradient-to-r from-ocean-600 to-mint-600 bg-clip-text text-transparent">
                        {{ config('app.name') }}
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="/" class="relative group px-3 py-2 text-sm font-medium text-ocean-700 hover:text-ocean-900 transition-colors duration-200">
                        Home
                        <span class="absolute inset-x-0 -bottom-px h-px bg-gradient-to-r from-ocean-500 to-mint-500 scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="group relative overflow-hidden rounded-full bg-gradient-to-r from-ocean-500 to-mint-500 px-6 py-2 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                        <span class="relative z-10 flex items-center space-x-2">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                            <span>Admin Panel</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-ocean-600 to-mint-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                </nav>

                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg text-ocean-600 hover:bg-ocean-50 transition-colors duration-200">
                    <i data-lucide="menu" class="w-6 h-6" x-show="!mobileMenuOpen"></i>
                    <i data-lucide="x" class="w-6 h-6" x-show="mobileMenuOpen" style="display: none;"></i>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="md:hidden py-4 border-t border-ocean-200/50" style="display: none;">
                <div class="space-y-2">
                    <a href="/" class="block px-3 py-2 text-base font-medium text-ocean-700 hover:text-ocean-900 hover:bg-ocean-50 rounded-lg transition-colors duration-200">Home</a>
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-base font-medium text-white bg-gradient-to-r from-ocean-500 to-mint-500 rounded-lg shadow-lg">Admin Panel</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="flex-1 animate-fade-in">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 relative overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-ocean-50/30 to-mint-50/30 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-gradient-to-tr from-mint-50/20 to-ocean-50/20 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2"></div>
        </div>
        
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
                
                <!-- Brand Section -->
                <div class="lg:col-span-5">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-ocean-500 to-mint-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <i data-lucide="package" class="w-6 h-6 text-white"></i>
                        </div>
                        <span class="font-display font-black text-2xl bg-gradient-to-r from-ocean-600 to-mint-600 bg-clip-text text-transparent">
                            {{ config('app.name') }}
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        PT. Mitra Elektronik Nusantara
                    </h3>
                    
                    <p class="text-gray-600 mb-6 text-lg leading-relaxed max-w-md">
                        Distributor terpercaya spare part alat rumah tangga sejak 1995. 
                        Melayani seluruh Indonesia dengan komitmen kualitas dan kepuasan pelanggan.
                    </p>
                    
                    <!-- Contact Info -->
                    <div class="space-y-3 mb-8">
                        <div class="flex items-center space-x-3 text-gray-600">
                            <div class="w-8 h-8 bg-ocean-100 rounded-lg flex items-center justify-center">
                                <i data-lucide="map-pin" class="w-4 h-4 text-ocean-600"></i>
                            </div>
                            <span>Jl. Industri Raya No. 123, Jakarta Pusat 10560</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-600">
                            <div class="w-8 h-8 bg-ocean-100 rounded-lg flex items-center justify-center">
                                <i data-lucide="phone" class="w-4 h-4 text-ocean-600"></i>
                            </div>
                            <span>+62 21 1234-5678</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-600">
                            <div class="w-8 h-8 bg-ocean-100 rounded-lg flex items-center justify-center">
                                <i data-lucide="mail" class="w-4 h-4 text-ocean-600"></i>
                            </div>
                            <span>info@mitraelektronik.co.id</span>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="flex space-x-4">
                        <a href="#" class="group w-12 h-12 bg-gray-100 hover:bg-gradient-to-br hover:from-ocean-500 hover:to-ocean-600 rounded-xl flex items-center justify-center transition-all duration-300 hover:shadow-lg hover:scale-105">
                            <i data-lucide="facebook" class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#" class="group w-12 h-12 bg-gray-100 hover:bg-gradient-to-br hover:from-ocean-500 hover:to-ocean-600 rounded-xl flex items-center justify-center transition-all duration-300 hover:shadow-lg hover:scale-105">
                            <i data-lucide="twitter" class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#" class="group w-12 h-12 bg-gray-100 hover:bg-gradient-to-br hover:from-ocean-500 hover:to-ocean-600 rounded-xl flex items-center justify-center transition-all duration-300 hover:shadow-lg hover:scale-105">
                            <i data-lucide="instagram" class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#" class="group w-12 h-12 bg-gray-100 hover:bg-gradient-to-br hover:from-ocean-500 hover:to-ocean-600 rounded-xl flex items-center justify-center transition-all duration-300 hover:shadow-lg hover:scale-105">
                            <i data-lucide="linkedin" class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Navigation Links -->
                <div class="lg:col-span-7">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-8 lg:gap-12">
                        
                        <!-- Products -->
                        <div>
                            <h4 class="font-bold text-gray-900 mb-6 text-lg">
                                Produk
                            </h4>
                            <ul class="space-y-4">
                                <li><a href="#" class="text-gray-600 hover:text-ocean-600 transition-colors duration-200 flex items-center space-x-2 group">
                                    <i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Spare Part AC</span>
                                </a></li>
                                <li><a href="#" class="text-gray-600 hover:text-ocean-600 transition-colors duration-200 flex items-center space-x-2 group">
                                    <i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Komponen Kulkas</span>
                                </a></li>
                                <li><a href="#" class="text-gray-600 hover:text-ocean-600 transition-colors duration-200 flex items-center space-x-2 group">
                                    <i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Parts Mesin Cuci</span>
                                </a></li>
                                <li><a href="#" class="text-gray-600 hover:text-ocean-600 transition-colors duration-200 flex items-center space-x-2 group">
                                    <i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Aksesoris TV</span>
                                </a></li>
                            </ul>
                        </div>
                        
                        <!-- Services -->
                        <div>
                            <h4 class="font-bold text-gray-900 mb-6 text-lg">
                                Layanan
                            </h4>
                            <ul class="space-y-4">
                                <li><a href="#" class="text-gray-600 hover:text-ocean-600 transition-colors duration-200 flex items-center space-x-2 group">
                                    <i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Konsultasi Teknis</span>
                                </a></li>
                                <li><a href="#" class="text-gray-600 hover:text-ocean-600 transition-colors duration-200 flex items-center space-x-2 group">
                                    <i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Pengiriman Express</span>
                                </a></li>
                                <li><a href="#" class="text-gray-600 hover:text-ocean-600 transition-colors duration-200 flex items-center space-x-2 group">
                                    <i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Garansi Resmi</span>
                                </a></li>
                                <li><a href="#" class="text-gray-600 hover:text-ocean-600 transition-colors duration-200 flex items-center space-x-2 group">
                                    <i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Support 24/7</span>
                                </a></li>
                            </ul>
                        </div>
                        
                        <!-- Company -->
                        <div>
                            <h4 class="font-bold text-gray-900 mb-6 text-lg">
                                Perusahaan
                            </h4>
                            <ul class="space-y-4">
                                <li><a href="#" class="text-gray-600 hover:text-ocean-600 transition-colors duration-200 flex items-center space-x-2 group">
                                    <i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Tentang Kami</span>
                                </a></li>
                                <li><a href="#" class="text-gray-600 hover:text-ocean-600 transition-colors duration-200 flex items-center space-x-2 group">
                                    <i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Karir</span>
                                </a></li>
                                <li><a href="#" class="text-gray-600 hover:text-ocean-600 transition-colors duration-200 flex items-center space-x-2 group">
                                    <i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Partnership</span>
                                </a></li>
                                <li><a href="#" class="text-gray-600 hover:text-ocean-600 transition-colors duration-200 flex items-center space-x-2 group">
                                    <i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Hubungi Kami</span>
                                </a></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
            <!-- Bottom Section -->
            <div class="border-t border-gray-200 mt-16 pt-8">
                <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                    <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-6 text-sm text-gray-500">
                        <p>&copy; {{ date('Y') }} PT. Mitra Elektronik Nusantara. All rights reserved.</p>
                        <div class="flex items-center space-x-4">
                            <a href="#" class="hover:text-ocean-600 transition-colors">Privacy Policy</a>
                            <span class="text-gray-300">•</span>
                            <a href="#" class="hover:text-ocean-600 transition-colors">Terms of Service</a>
                            <span class="text-gray-300">•</span>
                            <a href="#" class="hover:text-ocean-600 transition-colors">Sitemap</a>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <span>Powered by</span>
                        <div class="flex items-center space-x-1">
                            <span class="font-semibold text-red-500">Laravel</span>
                            <i data-lucide="heart" class="w-4 h-4 text-red-500 fill-current"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
