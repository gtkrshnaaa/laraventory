<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name').' Admin')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Tailwind CSS (PlayCDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js (PlayCDN) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col font-sans bg-white" x-data="{ sidebarOpen: false, userMenuOpen: false }">
    <!-- Top navigation -->
    <nav class="sticky top-0 z-50 backdrop-blur-xl bg-white/90 border-b border-transparent flex-shrink-0">
        <div class="mx-auto max-w-full px-4">
            <div class="flex h-16 items-center justify-between">
                <!-- Left side -->
                <div class="flex items-center space-x-4">
                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-xl text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center">
                            <i data-lucide="package" class="w-5 h-5 text-white"></i>
                        </div>
                        <div class="flex flex-col">
                            <a href="{{ route('admin.dashboard') }}" class="font-bold text-lg text-blue-700">
                                Laraventory
                            </a>
                            <span class="text-xs text-blue-500 font-medium">Admin Panel</span>
                        </div>
                    </div>
                </div>

                <!-- Right side -->
                <div class="flex items-center space-x-4">
                    @auth('admin')
                        <!-- Notifications -->
                        <button class="relative p-2 rounded-xl text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                            <i data-lucide="bell" class="w-6 h-6"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <!-- User menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-3 p-2 rounded-xl hover:bg-blue-50 transition-colors duration-200">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-semibold text-white">{{ substr(auth('admin')->user()->name, 0, 1) }}</span>
                                </div>
                                <div class="hidden sm:block text-left">
                                    <div class="text-sm font-medium text-gray-900">{{ auth('admin')->user()->name }}</div>
                                    <div class="text-xs text-gray-500">Administrator</div>
                                </div>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"></i>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-xl border-2 border-transparent py-2" style="display: none;">
                                <a href="{{ route('admin.profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 transition-colors duration-200">
                                    <i data-lucide="user" class="w-4 h-4 mr-3"></i>
                                    Profile
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 transition-colors duration-200">
                                    <i data-lucide="settings" class="w-4 h-4 mr-3"></i>
                                    Settings
                                </a>
                                <hr class="my-2 border-transparent">
                                <form action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <i data-lucide="log-out" class="w-4 h-4 mr-3"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    @guest('admin')
                        <a href="{{ route('admin.login') }}" class="rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition-colors duration-200 hover:bg-blue-700">
                            <span class="relative z-10 flex items-center space-x-2">
                                <i data-lucide="log-in" class="w-4 h-4"></i>
                                <span>Login</span>
                            </span>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <aside class="fixed inset-y-16 left-0 z-40 w-64 transform transition-transform duration-300 lg:relative lg:inset-y-0 lg:translate-x-0" :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }" x-show="sidebarOpen || window.innerWidth >= 1024" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
            <div class="h-full bg-white/80 backdrop-blur-sm border-2 border-transparent p-4">
                <nav class="space-y-2">
                    @php
                        $menuItems = [
                            ['route' => 'admin.dashboard', 'icon' => 'layout-dashboard', 'label' => 'Dashboard', 'pattern' => 'admin.dashboard'],
                            ['route' => 'admin.products.index', 'icon' => 'package', 'label' => 'Products', 'pattern' => 'admin.products.*'],
                            ['route' => 'admin.categories.index', 'icon' => 'tag', 'label' => 'Categories', 'pattern' => 'admin.categories.*'],
                            ['route' => 'admin.suppliers.index', 'icon' => 'truck', 'label' => 'Suppliers', 'pattern' => 'admin.suppliers.*'],
                            ['route' => 'admin.inventory.index', 'icon' => 'boxes', 'label' => 'Inventory', 'pattern' => 'admin.inventory.*'],
                            ['route' => 'admin.reports.stock', 'icon' => 'bar-chart-3', 'label' => 'Reports', 'pattern' => 'admin.reports.*'],
                            ['route' => 'admin.profile.edit', 'icon' => 'user-circle', 'label' => 'Profile', 'pattern' => 'admin.profile.*']
                        ];
                    @endphp

                    @foreach($menuItems as $item)
                        <a href="{{ route($item['route']) }}" class="group flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors duration-200 {{ request()->routeIs($item['pattern']) ? 'bg-blue-600 text-white' : 'text-blue-700 hover:bg-blue-50 hover:text-blue-900' }}">
                            <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5 {{ request()->routeIs($item['pattern']) ? 'text-white' : 'text-blue-500 group-hover:text-blue-700' }}"></i>
                            <span>{{ $item['label'] }}</span>
                            @if(request()->routeIs($item['pattern']))
                                <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                    @endforeach
                </nav>

                <!-- Sidebar footer -->
                <div class="absolute bottom-4 left-4 right-4">
                    <div class="bg-white rounded-xl p-4 border-2 border-transparent">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center">
                                <i data-lucide="sparkles" class="w-5 h-5 text-white"></i>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">Pro Tips</div>
                                <div class="text-xs text-gray-600">Keyboard shortcuts available</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-gray-900/50 lg:hidden" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;"></div>

        <!-- Main content -->
        <main class="flex-1 overflow-auto">
            <div class="p-6 max-w-full">
                <!-- Flash messages -->
                @if (session('status'))
                    <div class="mb-6 rounded-xl bg-blue-50 border-2 border-gray-200 p-4">
                        <div class="flex items-center">
                            <i data-lucide="check-circle" class="w-5 h-5 text-blue-500 mr-3"></i>
                            <span class="text-blue-800 font-medium">{{ session('status') }}</span>
                        </div>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 border-2 border-red-200 p-4">
                        <div class="flex items-start">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 mr-3 mt-0.5 flex-shrink-0"></i>
                            <div>
                                <h3 class="text-red-800 font-medium mb-2">Terjadi kesalahan:</h3>
                                <ul class="list-disc pl-5 space-y-1 text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Page heading -->
                @hasSection('header')
                    <div class="mb-8">
                        @yield('header')
                    </div>
                @endif

                <!-- Main content -->
                <div>
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    @stack('scripts')
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Auto-close mobile sidebar on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                Alpine.store('sidebarOpen', false);
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case '/':
                        e.preventDefault();
                        // Focus search if available
                        const searchInput = document.querySelector('input[type="search"], input[name="search"]');
                        if (searchInput) searchInput.focus();
                        break;
                    case 'k':
                        e.preventDefault();
                        // Toggle sidebar
                        Alpine.store('sidebarOpen', !Alpine.store('sidebarOpen'));
                        break;
                }
            }
        });
    </script>
</body>
</html>