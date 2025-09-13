@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-blue-700">
                Laporan Stok
            </h2>
            <p class="text-sm text-gray-600 mt-1">Laporan lengkap status stok semua produk</p>
        </div>
        <div class="flex space-x-3">
            <button class="rounded-xl bg-blue-600 hover:bg-blue-700 px-6 py-3 font-semibold text-white transition-colors duration-200">
                <span class="flex items-center space-x-2">
                    <i data-lucide="download" class="w-5 h-5"></i>
                    <span>Export Excel</span>
                </span>
            </button>
            <button class="rounded-xl bg-blue-600 hover:bg-blue-700 px-6 py-3 font-semibold text-white transition-colors duration-200">
                <span class="flex items-center space-x-2">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    <span>Export PDF</span>
                </span>
            </button>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-full">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white/80 backdrop-blur-sm border-2 border-gray-200/50 rounded-2xl p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                <i data-lucide="package" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Total Produk</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $products->count() }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/80 backdrop-blur-sm border-2 border-gray-200/50 rounded-2xl p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                <i data-lucide="check-circle" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Stok Aman</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $products->where('stock', '>', 5)->count() }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/80 backdrop-blur-sm border-2 border-gray-200/50 rounded-2xl p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                <i data-lucide="alert-triangle" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Stok Rendah</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $products->where('stock', '<=', 5)->where('stock', '>', 0)->count() }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/80 backdrop-blur-sm border-2 border-gray-200/50 rounded-2xl p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                <i data-lucide="x-circle" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Stok Habis</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $products->where('stock', '<=', 0)->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="overflow-hidden bg-white/80 backdrop-blur-sm border-2 border-gray-200/50 rounded-2xl">
                <div class="p-6 bg-white">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center">
                                <i data-lucide="bar-chart-3" class="w-4 h-4 text-white"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Detail Laporan Stok</h3>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full"></div>
                                <span class="text-sm text-gray-600">Aman</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-gradient-to-r from-yellow-400 to-blue-500 rounded-full"></div>
                                <span class="text-sm text-gray-600">Rendah</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-gradient-to-r from-red-400 to-pink-500 rounded-full"></div>
                                <span class="text-sm text-gray-600">Habis</span>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <div class="overflow-hidden border-2 border-transparent rounded-2xl bg-white/60 backdrop-blur-sm">
                            <table class="min-w-full divide-y divide-gray-200/50">
                                <thead class="bg-white backdrop-blur-sm">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="package" class="w-4 h-4"></i>
                                                <span>Produk</span>
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="hash" class="w-4 h-4"></i>
                                                <span>SKU</span>
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="tag" class="w-4 h-4"></i>
                                                <span>Kategori</span>
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                                                <span>Stok Saat Ini</span>
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                                                <span>Min Stok</span>
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="activity" class="w-4 h-4"></i>
                                                <span>Status</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200/30">
                                    @forelse($products as $p)
                                        <tr class="hover:bg-white/60 transition-colors duration-200">
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <div class="h-10 w-10 bg-blue-50 rounded-xl flex items-center justify-center border-2 border-gray-200/50">
                                                        <i data-lucide="box" class="w-5 h-5 text-blue-600"></i>
                                                    </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-semibold text-gray-900">{{ $p->name }}</div>
                                                        <div class="text-xs text-gray-500">ID: #{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 bg-gray-100/80 px-3 py-1 rounded-lg inline-block">
                                                    {{ $p->sku ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ optional($p->category)->name ?? '-' }}</div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="text-lg font-bold text-gray-900">{{ number_format($p->stock) }}</div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-600">{{ $p->min_stock ?? 'Belum diset' }}</div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                @if($p->stock <= 0)
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-xl bg-blue-100 text-blue-800 border-2 border-gray-200/50">
                                                        <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                                        Habis
                                                    </span>
                                                @elseif($p->stock <= ($p->min_stock ?? 5))
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-xl bg-blue-100 text-blue-800 border-2 border-gray-200/50">
                                                        <i data-lucide="alert-triangle" class="w-3 h-3 mr-1"></i>
                                                        Rendah
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-xl bg-blue-50 text-blue-800 border-2 border-gray-200/50">
                                                        <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                                        Aman
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mb-4">
                                                        <i data-lucide="package" class="w-8 h-8 text-gray-400"></i>
                                                    </div>
                                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada data produk</h3>
                                                    <p class="text-gray-500">Belum ada produk untuk ditampilkan dalam laporan</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
