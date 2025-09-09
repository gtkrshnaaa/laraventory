@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-ocean-600 to-mint-600 bg-clip-text text-transparent">
                {{ __('Daftar Produk') }}
            </h2>
            <p class="text-sm text-gray-600 mt-1">Kelola semua produk spare part elektronik</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-r from-ocean-500 to-mint-500 px-6 py-3 font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-ocean-500/25 hover:shadow-xl hover:scale-105">
            <span class="relative z-10 flex items-center space-x-2">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span>Tambah Produk</span>
            </span>
            <div class="absolute inset-0 bg-gradient-to-r from-ocean-600 to-mint-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white/80 backdrop-blur-sm shadow-xl border border-white/20 rounded-2xl">
                <div class="p-6 bg-gradient-to-br from-white/50 to-ocean-50/30">
                    <!-- Search and Filter -->
                    <div class="mb-8">
                        <form action="{{ route('admin.products.index') }}" method="GET">
                            <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                                <div class="flex-1">
                                    <label for="search" class="sr-only">Cari produk...</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
                                        </div>
                                        <input
                                            type="text"
                                            name="search"
                                            id="search"
                                            class="w-full pl-12 pr-4 py-3 bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:ring-2 focus:ring-ocean-500/20 focus:border-ocean-500 transition-all duration-200 placeholder-gray-400"
                                            placeholder="Cari produk berdasarkan nama atau SKU..."
                                            value="{{ request('search') }}"
                                        >
                                    </div>
                                </div>
                                <div class="w-full md:w-48">
                                    <label for="category" class="sr-only">Kategori</label>
                                    <select id="category" name="category" class="w-full py-3 px-4 bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:ring-2 focus:ring-ocean-500/20 focus:border-ocean-500 transition-all duration-200">
                                        <option value="">Semua Kategori</option>
                                        @foreach($categories ?? [] as $category)
                                            <option value="{{ is_array($category) ? $category['id'] : $category->id }}" {{ request('category') == (is_array($category) ? $category['id'] : $category->id) ? 'selected' : '' }}>
                                                {{ is_array($category) ? $category['name'] : $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-full md:w-48">
                                    <label for="status" class="sr-only">Status Stok</label>
                                    <select id="status" name="status" class="w-full py-3 px-4 bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:ring-2 focus:ring-ocean-500/20 focus:border-ocean-500 transition-all duration-200">
                                        <option value="">Semua Status</option>
                                        <option value="in_stock" {{ request('status') == 'in_stock' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="low_stock" {{ request('status') == 'low_stock' ? 'selected' : '' }}>Stok Sedikit</option>
                                        <option value="out_of_stock" {{ request('status') == 'out_of_stock' ? 'selected' : '' }}>Habis</option>
                                    </select>
                                </div>
                                <button type="submit" class="group relative overflow-hidden rounded-xl bg-white/80 backdrop-blur-sm border border-gray-200/50 px-6 py-3 font-medium text-gray-700 shadow-sm transition-all duration-300 hover:shadow-lg hover:scale-105 hover:bg-ocean-50">
                                    <span class="relative z-10 flex items-center space-x-2">
                                        <i data-lucide="filter" class="w-4 h-4"></i>
                                        <span>Filter</span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Products Table -->
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow-xl overflow-hidden border border-white/20 rounded-2xl bg-white/60 backdrop-blur-sm">
                                    <table class="min-w-full divide-y divide-gray-200/50">
                                        <thead class="bg-gradient-to-r from-ocean-50/80 to-mint-50/80 backdrop-blur-sm">
                                            <tr>
                                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-ocean-700 uppercase tracking-wider">
                                                    <div class="flex items-center space-x-2">
                                                        <i data-lucide="package" class="w-4 h-4"></i>
                                                        <span>Produk</span>
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-ocean-700 uppercase tracking-wider">
                                                    <div class="flex items-center space-x-2">
                                                        <i data-lucide="tag" class="w-4 h-4"></i>
                                                        <span>Kategori</span>
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-ocean-700 uppercase tracking-wider">
                                                    <div class="flex items-center space-x-2">
                                                        <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                                                        <span>Stok</span>
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-ocean-700 uppercase tracking-wider">
                                                    <div class="flex items-center space-x-2">
                                                        <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                                        <span>Harga</span>
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-ocean-700 uppercase tracking-wider">
                                                    <div class="flex items-center justify-end space-x-2">
                                                        <i data-lucide="settings" class="w-4 h-4"></i>
                                                        <span>Aksi</span>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white/40 backdrop-blur-sm divide-y divide-gray-200/30">
                                            @forelse($products as $product)
                                                <tr class="hover:bg-white/60 transition-colors duration-200">
                                                    <td class="px-6 py-5 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-12 w-12">
                                                                <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-ocean-100 to-mint-100 border border-white/50 shadow-sm overflow-hidden">
                                                                    <img class="h-full w-full object-cover" src="{{ $product->image_path ? asset('storage/'.$product->image_path) : 'https://via.placeholder.com/48' }}" alt="{{ $product->name }}">
                                                                </div>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                                                                <div class="text-xs text-gray-500 bg-gray-100/80 px-2 py-1 rounded-md inline-block mt-1">{{ $product->sku }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-5 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">{{ optional($product->category)->name ?? '-' }}</div>
                                                    </td>
                                                    <td class="px-6 py-5 whitespace-nowrap">
                                                        @if($product->stock <= 0)
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-xl bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-200/50">
                                                                <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                                                Habis
                                                            </span>
                                                        @elseif($product->stock < ($product->min_stock ?? 5))
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-xl bg-gradient-to-r from-yellow-100 to-orange-200 text-orange-800 border border-orange-200/50">
                                                                <i data-lucide="alert-triangle" class="w-3 h-3 mr-1"></i>
                                                                {{ $product->stock }} tersisa
                                                            </span>
                                                        @else
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-xl bg-gradient-to-r from-green-100 to-emerald-200 text-emerald-800 border border-emerald-200/50">
                                                                <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                                                {{ $product->stock }} tersedia
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-5 whitespace-nowrap">
                                                        <div class="text-sm font-semibold text-gray-900">{{ 'Rp ' . number_format($product->price ?? 0, 0, ',', '.') }}</div>
                                                    </td>
                                                    <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                                        <div class="flex justify-end space-x-2">
                                                            <a href="#" class="group relative p-2 text-ocean-600 hover:text-ocean-800 bg-ocean-50/50 hover:bg-ocean-100 rounded-lg transition-all duration-200 hover:scale-110" title="Lihat Detail">
                                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                                            </a>
                                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="group relative p-2 text-amber-600 hover:text-amber-800 bg-amber-50/50 hover:bg-amber-100 rounded-lg transition-all duration-200 hover:scale-110" title="Edit">
                                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                                            </a>
                                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="group relative p-2 text-red-600 hover:text-red-800 bg-red-50/50 hover:bg-red-100 rounded-lg transition-all duration-200 hover:scale-110" title="Hapus">
                                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="px-6 py-12 text-center">
                                                        <div class="flex flex-col items-center justify-center">
                                                            <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mb-4">
                                                                <i data-lucide="package" class="w-8 h-8 text-gray-400"></i>
                                                            </div>
                                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada produk yang ditemukan</h3>
                                                            <p class="text-gray-500 mb-6">Mulai dengan menambahkan produk pertama Anda</p>
                                                            <a href="{{ route('admin.products.create') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-r from-ocean-500 to-mint-500 px-6 py-3 font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-ocean-500/25 hover:shadow-xl hover:scale-105">
                                                                <span class="relative z-10 flex items-center space-x-2">
                                                                    <i data-lucide="plus" class="w-5 h-5"></i>
                                                                    <span>Tambah Produk Pertama</span>
                                                                </span>
                                                                <div class="absolute inset-0 bg-gradient-to-r from-ocean-600 to-mint-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                                            </a>
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

                    <!-- Pagination -->
                    @if(method_exists($products, 'links'))
                        <div class="mt-4 px-6">
                            {{ $products->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // In a real application, you would add JavaScript for search, filters, etc.
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize any JavaScript plugins or event listeners here
            });
        </script>
    @endpush
@endsection
