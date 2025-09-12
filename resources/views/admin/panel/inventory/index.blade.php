@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-orange-700">
                Inventory Management
            </h2>
            <p class="text-sm text-gray-600 mt-1">Kelola stok dan pergerakan inventory produk</p>
        </div>
        <div x-data="{ showForm: false }" class="relative">
            <button @click="showForm = !showForm" class="relative group rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 px-6 py-3 font-medium text-white shadow-sm shadow-orange-200/50 hover:shadow-orange-200 transition-all duration-200 transform hover:-translate-y-0.5">
                <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                <span class="relative flex items-center space-x-2">
                    <i data-lucide="package-plus" class="w-5 h-5 text-white/90"></i>
                    <span>Adjust Stok</span>
                </span>
            </button>
            
            <div x-show="showForm" x-transition class="absolute right-0 top-full mt-2 w-96 bg-white/90 backdrop-blur-sm border border-orange-200/50 rounded-2xl p-6 z-50 shadow-lg shadow-orange-100/30">
                <form action="{{ route('admin.inventory.adjust') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Produk</label>
                        <select name="product_id" class="w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50" required>
                            <option value="">Pilih Produk</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->name }} (Stok: {{ $p->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                            <select name="type" class="w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50" required>
                                <option value="in">Masuk</option>
                                <option value="out">Keluar</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                            <input type="number" name="quantity" min="1" class="w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50 placeholder-gray-400" placeholder="Qty" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                        <input type="text" name="note" class="w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50 placeholder-gray-400" placeholder="Catatan (opsional)">
                    </div>
                    <div class="flex space-x-3">
                        <button type="submit" class="relative group flex-1 py-2.5 px-4 text-sm font-medium text-white rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-sm shadow-orange-200/50 hover:shadow-orange-200 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-orange-500/50 transition-all duration-200 transform hover:-translate-y-0.5">
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                            <span class="relative flex items-center justify-center space-x-2">
                                <i data-lucide="check" class="w-4 h-4"></i>
                                <span>Adjust</span>
                            </span>
                        </button>
                        <button type="button" @click="showForm = false" class="relative group flex-1 py-2.5 px-4 text-sm font-medium text-gray-700 bg-white/80 hover:bg-gray-50/80 border border-gray-200/50 rounded-xl shadow-sm shadow-gray-100/50 hover:shadow-gray-200/50 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-gray-300/50 transition-all duration-200 transform hover:-translate-y-0.5">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-6 h-full">
        <div class="h-full mx-auto max-w-7xl sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 flex flex-col bg-white/80 backdrop-blur-sm border border-orange-200/50 rounded-2xl overflow-hidden">
                <div class="p-6 bg-white/50 border-b border-orange-200/30">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-orange-600 rounded-xl flex items-center justify-center">
                                <i data-lucide="package" class="w-4 h-4 text-white"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Daftar Produk & Stok</h3>
                        </div>
                        
                        <!-- Search and Filter -->
                        <div class="w-full md:w-auto">
                            <form action="{{ route('admin.inventory.index') }}" method="GET" class="flex flex-col space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3">
                                <div class="relative flex-1">
                                    <input type="text" 
                                           name="search" 
                                           value="{{ request('search') }}" 
                                           class="w-full pl-10 pr-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50 placeholder-gray-400" 
                                           placeholder="Cari produk...">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                                    </div>
                                </div>
                                
                                <select name="stock_status" class="w-full sm:w-40 px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50">
                                    <option value="">Semua Stok</option>
                                    <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Stok Sedikit</option>
                                    <option value="out" {{ request('stock_status') == 'out' ? 'selected' : '' }}>Stok Habis</option>
                                    <option value="available" {{ request('stock_status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                                </select>
                                
                                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 rounded-xl shadow-sm shadow-orange-200/50 hover:shadow-orange-200 transition-all duration-200 transform hover:-translate-y-0.5">
                                    <i data-lucide="filter" class="w-4 h-4 inline-block mr-1"></i> Filter
                                </button>
                                
                                @if(request('search') || request('stock_status'))
                                    <a href="{{ route('admin.inventory.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200/50 hover:bg-gray-50/80 rounded-xl shadow-sm shadow-gray-100/50 hover:shadow-gray-200/50 transition-all duration-200 flex items-center justify-center">
                                        <i data-lucide="x" class="w-4 h-4 mr-1"></i> Reset
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="flex-1 overflow-hidden flex flex-col">
                    <div class="flex-1 overflow-auto p-6 pt-0">
                        <div class="border border-orange-200/30 rounded-2xl bg-white/60 backdrop-blur-sm overflow-hidden">
                            <table class="min-w-full divide-y divide-orange-200/30">
                                <thead class="bg-white/80 backdrop-blur-sm">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="package" class="w-4 h-4"></i>
                                            <span>Produk</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="tag" class="w-4 h-4"></i>
                                            <span>Kategori</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                                            <span>Stok Saat Ini</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                                            <span>Min Stok</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white/40 backdrop-blur-sm divide-y divide-gray-200/30">
                                @foreach($products as $p)
                                    <tr class="hover:bg-white/60 transition-colors duration-200 border-b border-orange-200/30 last:border-0">
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 bg-orange-50 rounded-xl flex items-center justify-center border border-transparent">
                                                        <i data-lucide="box" class="w-5 h-5 text-orange-600"></i>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-semibold text-gray-900">{{ $p->name }}</div>
                                                    <div class="text-xs text-gray-500">SKU: {{ $p->sku ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ optional($p->category)->name ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            @if($p->stock <= 0)
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-xl bg-orange-100 text-orange-800 border border-orange-200/50">
                                                    <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                                    {{ $p->stock }} (Habis)
                                                </span>
                                            @elseif($p->stock <= ($p->min_stock ?? 5))
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-xl bg-orange-100 text-orange-800 border border-orange-200/50">
                                                    <i data-lucide="alert-triangle" class="w-3 h-3 mr-1"></i>
                                                    {{ $p->stock }} (Rendah)
                                                </span>
                                            @else
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-xl bg-orange-50 text-orange-800 border border-orange-200/50">
                                                    <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                                    {{ $p->stock }} (Aman)
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $p->min_stock ?? 'Belum diset' }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if(method_exists($products, 'links'))
                    <div class="p-4 border-t border-orange-200/30 bg-white/50">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>

            <div class="flex flex-col bg-white/80 backdrop-blur-sm border border-orange-200/50 rounded-2xl overflow-hidden">
                <div class="p-6 bg-orange-50/80 border-b border-orange-200/30">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-600 rounded-xl flex items-center justify-center">
                            <i data-lucide="alert-triangle" class="w-4 h-4 text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Stok Menipis</h3>
                            <p class="text-xs text-gray-600">Produk yang perlu segera direstok</p>
                        </div>
                    </div>
                </div>
                <div class="flex-1 overflow-auto">
                    <div class="divide-y divide-orange-200/30">
                    @forelse($lowStock as $ls)
                        <div class="p-4 hover:bg-white/60 transition-colors duration-200 border-b border-orange-200/30 last:border-0">
                            <div class="space-y-4">
                                <!-- Product Info -->
                                <div class="flex items-start space-x-3">
                                    <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center border border-transparent flex-shrink-0">
                                        <i data-lucide="package-x" class="w-6 h-6 text-orange-600"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-gray-900 text-base mb-2 leading-tight">{{ $ls->name }}</h4>
                                        <div class="flex flex-col space-y-2">
                                            <div class="flex items-center space-x-2">
                                              <a href="{{ route('admin.products.edit', $ls->id) }}" class="group inline-flex items-center text-sm font-medium text-orange-600 hover:text-orange-700 transition-colors duration-200">
                    <span class="relative">
                        Atur Stok
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-600 group-hover:w-full transition-all duration-200"></span>
                    </span>
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200">
                                                    <i data-lucide="trending-down" class="w-3 h-3 mr-1"></i>
                                                    Stok: {{ $ls->stock }}
                                                </span>
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                                    <i data-lucide="alert-triangle" class="w-3 h-3 mr-1"></i>
                                                    Min: {{ $ls->min_stock }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Action Form -->
                                <div class="pt-2 border-t border-transparent">
                                    <form action="{{ route('admin.inventory.adjust') }}" method="POST" class="flex items-center justify-between space-x-3">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $ls->id }}">
                                        <input type="hidden" name="type" value="in">
                                        <div class="flex items-center space-x-2">
                                            <label class="text-sm font-medium text-gray-700">Jumlah:</label>
                                            <input type="number" name="quantity" min="1" value="1" 
                                                   class="px-2 py-1 bg-white/80 backdrop-blur-sm border border-transparent rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent w-16 text-center font-medium">
                                        </div>
                                        <button type="submit" class="rounded-lg bg-orange-600 hover:bg-orange-700 px-4 py-2 font-semibold text-white transition-colors duration-200 text-sm">
                                            <span class="flex items-center space-x-1">
                                                <i data-lucide="plus" class="w-4 h-4"></i>
                                                <span>+</span>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <div class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="check-circle" class="w-8 h-8 text-orange-600"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Semua Stok Aman</h3>
                            <p class="text-gray-500">Tidak ada produk dengan stok menipis</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
