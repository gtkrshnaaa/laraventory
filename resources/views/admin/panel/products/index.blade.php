@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-orange-700">
                {{ __('Daftar Produk') }}
            </h2>
            <p class="text-sm text-gray-600 mt-1">Kelola semua produk spare part elektronik</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="rounded-xl bg-orange-600 hover:bg-orange-700 px-6 py-3 font-semibold text-white transition-colors duration-200">
            <span class="flex items-center space-x-2">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span>Tambah Produk</span>
            </span>
        </a>
    </div>
@endsection

@section('content')
    <div class="py-6 h-full">
        <div class="h-full mx-auto max-w-full">
            <div class="h-full flex flex-col bg-white/80 backdrop-blur-sm border border-orange-200/50 rounded-2xl">
                <div class="p-6 bg-white/50">
                    <!-- Enhanced Search and Filter -->
                    <div class="mb-8" x-data="{
                        searchQuery: '{{ request('search') }}',
                        selectedCategory: '{{ request('category') }}',
                        selectedStatus: '{{ request('status') }}',
                        showFilters: false,
                        hasActiveFilters: {{ request('search') || request('category') || request('status') ? 'true' : 'false' }},
                        
                        init() {
                            // Auto-submit form when filters change (except for search input)
                            this.$watch('selectedCategory', value => this.$nextTick(() => this.submitForm()));
                            this.$watch('selectedStatus', value => this.$nextTick(() => this.submitForm()));
                            
                            // Debounce search input
                            this.$watch('searchQuery', value => {
                                if (this.searchDebounce) clearTimeout(this.searchDebounce);
                                this.searchDebounce = setTimeout(() => {
                                    this.submitForm();
                                }, 500);
                            });
                        },
                        
                        submitForm() {
                            const form = this.$refs.searchForm;
                            const url = new URL(form.action);
                            
                            // Update URL parameters
                            if (this.searchQuery) {
                                url.searchParams.set('search', this.searchQuery);
                            } else {
                                url.searchParams.delete('search');
                            }
                            
                            if (this.selectedCategory) {
                                url.searchParams.set('category', this.selectedCategory);
                            } else {
                                url.searchParams.delete('category');
                            }
                            
                            if (this.selectedStatus) {
                                url.searchParams.set('status', this.selectedStatus);
                            } else {
                                url.searchParams.delete('status');
                            }
                            
                            // Update URL without page reload for better UX
                            window.history.pushState({}, '', url);
                            
                            // Submit the form
                            form.submit();
                        },
                        
                        clearFilters() {
                            this.searchQuery = '';
                            this.selectedCategory = '';
                            this.selectedStatus = '';
                            this.showFilters = false;
                            this.hasActiveFilters = false;
                            this.submitForm();
                        }
                    }">
                        <form x-ref="searchForm" action="{{ route('admin.products.index') }}" method="GET" class="space-y-4">
                            <!-- Hidden inputs to maintain form submission -->
                            <input type="hidden" name="search" :value="searchQuery">
                            <input type="hidden" name="category" :value="selectedCategory">
                            <input type="hidden" name="status" :value="selectedStatus">
                            
                            <!-- Search Bar -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input
                                    type="text"
                                    x-model="searchQuery"
                                    class="w-full pl-12 pr-12 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50 placeholder-gray-400"
                                    placeholder="Cari produk berdasarkan nama atau SKU..."
                                >
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <template x-if="searchQuery">
                                        <button type="button" @click="searchQuery = ''" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                                            <i data-lucide="x" class="w-4 h-4"></i>
                                        </button>
                                    </template>
                                </div>
                            </div>
                            
                            <!-- Filters Toggle -->
                            <div class="flex items-center justify-between">
                                <button type="button" 
                                        @click="showFilters = !showFilters" 
                                        class="inline-flex items-center text-sm font-medium text-orange-600 hover:text-orange-800 transition-colors duration-200">
                                    <i data-lucide="sliders-horizontal" class="w-4 h-4 mr-1"></i>
                                    <span x-text="showFilters ? 'Sembunyikan Filter' : 'Tampilkan Filter'"></span>
                                    <template x-if="hasActiveFilters">
                                        <span class="ml-1.5 px-2 py-0.5 text-xs font-medium bg-orange-100 text-orange-800 rounded-full">
                                            {{ (request('category') ? 1 : 0) + (request('status') ? 1 : 0) }}
                                        </span>
                                    </template>
                                </button>
                                
                                <template x-if="hasActiveFilters">
                                    <button type="button" 
                                            @click="clearFilters()" 
                                            class="inline-flex items-center text-sm text-gray-600 hover:text-gray-800 transition-colors duration-200">
                                        <i data-lucide="x" class="w-3 h-3 mr-1"></i>
                                        <span>Hapus Semua Filter</span>
                                    </button>
                                </template>
                            </div>
                            
                            <!-- Filter Panel -->
                            <div x-show="showFilters" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 -translate-y-2"
                                 class="p-4 bg-white/50 border border-gray-100 rounded-xl space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                        <select x-model="selectedCategory" 
                                                class="w-full py-2.5 px-4 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50">
                                            <option value="">Semua Kategori</option>
                                            @foreach($categories ?? [] as $category)
                                                <option value="{{ is_array($category) ? $category['id'] : $category->id }}">
                                                    {{ is_array($category) ? $category['name'] : $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Stok</label>
                                        <select x-model="selectedStatus" 
                                                class="w-full py-2.5 px-4 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50">
                                            <option value="">Semua Status</option>
                                            <option value="in_stock">Tersedia</option>
                                            <option value="low_stock">Stok Sedikit</option>
                                            <option value="out_of_stock">Habis</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="flex justify-end pt-2">
                                    <button type="button" 
                                            @click="clearFilters()" 
                                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200/50 hover:bg-gray-50/80 rounded-xl shadow-sm shadow-gray-100/50 hover:shadow-gray-200/50 transition-all duration-200 mr-2">
                                        Reset
                                    </button>
                                    <button type="button" 
                                            @click="showFilters = false" 
                                            class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 rounded-xl shadow-sm shadow-orange-200/50 hover:shadow-orange-200 transition-all duration-200">
                                        Terapkan
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Active Filters -->
                            <div x-show="hasActiveFilters" class="flex flex-wrap gap-2">
                                <template x-if="selectedCategory">
                                    @php
                                        $category = collect($categories ?? [])->first(function($cat) {
                                            $id = is_array($cat) ? $cat['id'] : $cat->id;
                                            return $id == request('category');
                                        });
                                        $categoryName = $category ? (is_array($category) ? $category['name'] : $category->name) : null;
                                    @endphp
                                    @if($categoryName)
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200">
                                            Kategori: {{ $categoryName }}
                                            <button type="button" @click="selectedCategory = ''" class="ml-1.5 text-orange-500 hover:text-orange-700">
                                                <i data-lucide="x" class="w-3 h-3"></i>
                                            </button>
                                        </span>
                                    @endif
                                </template>
                                
                                <template x-if="selectedStatus">
                                    @php
                                        $statusLabels = [
                                            'in_stock' => 'Tersedia',
                                            'low_stock' => 'Stok Sedikit',
                                            'out_of_stock' => 'Habis'
                                        ];
                                        $statusLabel = $statusLabels[request('status')] ?? null;
                                    @endphp
                                    @if($statusLabel)
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                            Status: {{ $statusLabel }}
                                            <button type="button" @click="selectedStatus = ''" class="ml-1.5 text-blue-500 hover:text-blue-700">
                                                <i data-lucide="x" class="w-3 h-3"></i>
                                            </button>
                                        </span>
                                    @endif
                                </template>
                            </div>
                        </form>
                    </div>

                    <!-- Products Table -->
                    <div class="flex-1 flex flex-col min-h-0">
                        <div class="flex-1 overflow-auto">
                            <div class="py-2">
                                <div class="border border-orange-200/30 rounded-2xl bg-white/60 backdrop-blur-sm overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200/50">
                                        <thead class="bg-white backdrop-blur-sm">
                                            <tr>
                                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-orange-700 uppercase tracking-wider">
                                                    <div class="flex items-center space-x-2">
                                                        <i data-lucide="package" class="w-4 h-4"></i>
                                                        <span>Produk</span>
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-orange-700 uppercase tracking-wider">
                                                    <div class="flex items-center space-x-2">
                                                        <i data-lucide="tag" class="w-4 h-4"></i>
                                                        <span>Kategori</span>
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-orange-700 uppercase tracking-wider">
                                                    <div class="flex items-center space-x-2">
                                                        <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                                                        <span>Stok</span>
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-orange-700 uppercase tracking-wider">
                                                    <div class="flex items-center space-x-2">
                                                        <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                                        <span>Harga</span>
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-orange-700 uppercase tracking-wider">
                                                    <div class="flex items-center justify-end space-x-2">
                                                        <i data-lucide="settings" class="w-4 h-4"></i>
                                                        <span>Aksi</span>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white/40 backdrop-blur-sm divide-y divide-gray-200/30">
                                            @forelse($products as $product)
                                                <tr class="hover:bg-orange-50/30 transition-colors duration-200 border-b border-orange-100/30 last:border-0">
                                                    <td class="px-6 py-5 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-12 w-12">
                                                                <div class="h-12 w-12 rounded-xl bg-orange-50/50 border border-orange-200/30 overflow-hidden">
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
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-xl bg-orange-100 text-orange-800 border border-orange-200/50">
                                                                <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                                                Habis
                                                            </span>
                                                        @elseif($product->stock < ($product->min_stock ?? 5))
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-xl bg-orange-100 text-orange-800 border border-orange-200/50">
                                                                <i data-lucide="alert-triangle" class="w-3 h-3 mr-1"></i>
                                                                {{ $product->stock }} tersisa
                                                            </span>
                                                        @else
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-xl bg-orange-50 text-orange-800 border border-orange-200/50">
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
                                                            <a href="#" class="p-2 text-orange-600 hover:text-orange-800 bg-orange-50/30 hover:bg-orange-100/50 rounded-lg border border-orange-200/30 hover:border-orange-300/50 transition-colors duration-200" title="Lihat Detail">
                                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                                            </a>
                                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 text-blue-600 hover:text-blue-800 bg-blue-50/30 hover:bg-blue-100/50 rounded-lg border border-blue-200/30 hover:border-blue-300/50 transition-colors duration-200" title="Edit">
                                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                                            </a>
                                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="p-2 text-red-600 hover:text-red-800 bg-red-50/30 hover:bg-red-100/50 rounded-lg border border-red-200/30 hover:border-red-300/50 transition-colors duration-200" title="Hapus">
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
                                                            <div class="w-16 h-16 bg-orange-50/50 rounded-2xl border border-orange-200/30 flex items-center justify-center mb-4">
                                                                <i data-lucide="package" class="w-8 h-8 text-gray-400"></i>
                                                            </div>
                                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada produk yang ditemukan</h3>
                                                            <p class="text-gray-500 mb-6">Mulai dengan menambahkan produk pertama Anda</p>
                                                            <button type="submit" class="relative group w-full py-2.5 px-4 text-sm font-medium text-white rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-sm shadow-orange-200/50 hover:shadow-orange-200 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-orange-500/50 transition-all duration-200 transform hover:-translate-y-0.5">
                                                                <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                                                <span class="relative flex items-center justify-center">
                                                                    <span class="flex items-center space-x-2">
                                                                        <i data-lucide="plus" class="w-5 h-5"></i>
                                                                        <span>Tambah Produk Pertama</span>
                                                                    </span>
                                                                </span>
                                                            </button>
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
                        <div class="px-6 py-4 border-t border-orange-200/30 bg-white/50">
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
