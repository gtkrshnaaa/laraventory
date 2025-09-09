@extends('layouts.admin')

@section('header')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-display font-bold bg-gradient-to-r from-ocean-600 to-mint-600 bg-clip-text text-transparent">
                Dashboard
            </h1>
            <p class="mt-2 text-gray-600">Selamat datang kembali! Berikut ringkasan sistem inventori Anda.</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="group relative overflow-hidden rounded-xl bg-gradient-to-r from-ocean-500 to-mint-500 px-4 py-2 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                <span class="relative z-10 flex items-center space-x-2">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    <span>Export Data</span>
                </span>
            </button>
            <button class="p-2 rounded-xl text-ocean-600 hover:bg-ocean-50 transition-colors duration-200">
                <i data-lucide="refresh-cw" class="w-5 h-5"></i>
            </button>
        </div>
    </div>
@endsection

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <!-- Total Produk -->
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-ocean-500 rounded-2xl blur-xl opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
            <div class="relative bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Produk</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_products'] ?? 0) }}</p>
                        <div class="flex items-center mt-2">
                            <i data-lucide="trending-up" class="w-4 h-4 text-emerald-500 mr-1"></i>
                            <span class="text-sm font-semibold text-emerald-600">+12%</span>
                            <span class="text-sm text-gray-500 ml-1">dari bulan lalu</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-ocean-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="package" class="w-8 h-8 text-white"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-ocean-600 hover:text-ocean-500 transition-colors duration-200 flex items-center">
                        Lihat semua produk
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

                <!-- Total Stok -->
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl blur-xl opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
            <div class="relative bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Stok</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_stock'] ?? 0) }}</p>
                        <div class="flex items-center mt-2">
                            <i data-lucide="trending-up" class="w-4 h-4 text-emerald-500 mr-1"></i>
                            <span class="text-sm font-semibold text-emerald-600">+5.4%</span>
                            <span class="text-sm text-gray-500 ml-1">dari bulan lalu</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="boxes" class="w-8 h-8 text-white"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.inventory.index') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-500 transition-colors duration-200 flex items-center">
                        Kelola stok
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl blur-xl opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
            <div class="relative bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Kategori</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_categories'] ?? 0) }}</p>
                        <div class="flex items-center mt-2">
                            <i data-lucide="minus" class="w-4 h-4 text-gray-400 mr-1"></i>
                            <span class="text-sm text-gray-500">Stabil</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="tag" class="w-8 h-8 text-white"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.categories.index') }}" class="text-sm font-medium text-amber-600 hover:text-amber-500 transition-colors duration-200 flex items-center">
                        Kelola kategori
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Supplier -->
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl blur-xl opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
            <div class="relative bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Supplier</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_suppliers'] ?? 0) }}</p>
                        <div class="flex items-center mt-2">
                            <i data-lucide="trending-up" class="w-4 h-4 text-emerald-500 mr-1"></i>
                            <span class="text-sm font-semibold text-emerald-600">+2.3%</span>
                            <span class="text-sm text-gray-500 ml-1">dari bulan lalu</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="truck" class="w-8 h-8 text-white"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.suppliers.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-500 transition-colors duration-200 flex items-center">
                        Lihat supplier
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Activities -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 mb-8">
        <!-- Chart -->
        <div class="lg:col-span-2">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-xl">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Ringkasan Stok</h3>
                        <p class="text-sm text-gray-600">Tren pergerakan stok 30 hari terakhir</p>
                    </div>
                    <div class="relative">
                        <select class="block w-full pl-3 pr-10 py-2 text-sm border border-gray-200 focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent rounded-xl bg-white/50 backdrop-blur-sm">
                            <option>30 Hari Terakhir</option>
                            <option>3 Bulan Terakhir</option>
                            <option>Tahun Ini</option>
                        </select>
                    </div>
                </div>
                <div class="h-80 bg-gradient-to-br from-ocean-50 to-mint-50 rounded-xl flex items-center justify-center border border-ocean-100">
                    <div class="text-center">
                        <i data-lucide="bar-chart-3" class="w-16 h-16 text-ocean-400 mx-auto mb-4"></i>
                        <p class="text-gray-600 font-medium">Grafik Analytics</p>
                        <p class="text-sm text-gray-500">Chart akan ditampilkan di sini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-xl">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Aktivitas Terbaru</h3>
                        <p class="text-sm text-gray-600">Update sistem real-time</p>
                    </div>
                    <button class="p-2 rounded-xl text-ocean-600 hover:bg-ocean-50 transition-colors duration-200">
                        <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                    </button>
                </div>
                
                @if(count($recent_activities ?? []) > 0)
                    <div class="space-y-4">
                        @foreach($recent_activities as $index => $activity)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    @if($activity['type'] === 'product')
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-ocean-500 rounded-xl flex items-center justify-center">
                                            <i data-lucide="package" class="w-5 h-5 text-white"></i>
                                        </div>
                                    @elseif($activity['type'] === 'stock')
                                        <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center">
                                            <i data-lucide="boxes" class="w-5 h-5 text-white"></i>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 bg-gradient-to-r from-gray-500 to-gray-600 rounded-xl flex items-center justify-center">
                                            <i data-lucide="info" class="w-5 h-5 text-white"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">{!! $activity['message'] !!}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $activity['time_ago'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <button class="w-full px-4 py-2 text-sm font-medium text-ocean-600 hover:text-ocean-500 hover:bg-ocean-50 rounded-xl transition-colors duration-200">
                            Lihat Semua Aktivitas
                        </button>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i data-lucide="activity" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
                        <p class="text-gray-500 font-medium">Tidak ada aktivitas terbaru</p>
                        <p class="text-sm text-gray-400">Aktivitas akan muncul di sini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Low Stock Products -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-xl">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-xl font-bold text-gray-900">Produk Stok Sedikit</h3>
                <p class="text-sm text-gray-600">Produk dengan stok di bawah ambang batas minimum</p>
            </div>
            <button class="group relative overflow-hidden rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 px-4 py-2 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                <span class="relative z-10 flex items-center space-x-2">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Tambah Stok</span>
                </span>
            </button>
        </div>
        
        @if(count($low_stock_products ?? []) > 0)
            <div class="space-y-3">
                @foreach($low_stock_products as $product)
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl border border-amber-200/50 hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-500 rounded-xl flex items-center justify-center">
                                <i data-lucide="alert-triangle" class="w-6 h-6 text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ $product['name'] }}</h4>
                                <div class="flex items-center space-x-4 mt-1">
                                    <span class="text-sm text-gray-600 flex items-center">
                                        <i data-lucide="tag" class="w-4 h-4 mr-1"></i>
                                        {{ $product['category'] }}
                                    </span>
                                    <span class="text-sm text-gray-600 flex items-center">
                                        <i data-lucide="boxes" class="w-4 h-4 mr-1"></i>
                                        Min: {{ $product['min_stock'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                                Stok: {{ $product['stock'] }}
                            </span>
                            <button class="p-2 rounded-xl text-amber-600 hover:bg-amber-100 transition-colors duration-200">
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border border-emerald-200/50">
                <i data-lucide="check-circle" class="w-16 h-16 text-emerald-500 mx-auto mb-4"></i>
                <p class="text-emerald-800 font-semibold text-lg">Semua Stok Aman! 🎉</p>
                <p class="text-emerald-600 text-sm">Tidak ada produk dengan stok sedikit</p>
            </div>
        @endif
    </div>
@endsection
