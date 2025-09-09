@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar Produk') }}
        </h2>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i class="uil uil-plus mr-1"></i> Tambah Produk
        </a>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Search and Filter -->
                    <div class="mb-6">
                        <form action="{{ route('admin.products.index') }}" method="GET">
                            <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                                <div class="flex-1">
                                    <label for="search" class="sr-only">Cari produk...</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="uil uil-search text-gray-400"></i>
                                        </div>
                                        <input
                                            type="text"
                                            name="search"
                                            id="search"
                                            class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                                            placeholder="Cari produk..."
                                            value="{{ request('search') }}"
                                        >
                                    </div>
                                </div>
                                <div class="w-full md:w-48">
                                    <label for="category" class="sr-only">Kategori</label>
                                    <select id="category" name="category" class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
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
                                    <select id="status" name="status" class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                        <option value="">Semua Status</option>
                                        <option value="in_stock" {{ request('status') == 'in_stock' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="low_stock" {{ request('status') == 'low_stock' ? 'selected' : '' }}>Stok Sedikit</option>
                                        <option value="out_of_stock" {{ request('status') == 'out_of_stock' ? 'selected' : '' }}>Habis</option>
                                    </select>
                                </div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="uil uil-filter mr-1"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Products Table -->
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Produk
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Kategori
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Stok
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Harga
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @forelse($products as $product)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $product->image_path ? asset('storage/'.$product->image_path) : 'https://via.placeholder.com/40' }}" alt="{{ $product->name }}">
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                                                <div class="text-sm text-gray-500">{{ $product->sku }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ optional($product->category)->name ?? '-' }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($product->stock <= 0)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                Habis
                                                            </span>
                                                        @elseif($product->stock < ($product->min_stock ?? 5))
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                {{ $product->stock }} tersisa
                                                            </span>
                                                        @else
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                {{ $product->stock }} tersedia
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        {{ 'Rp ' . number_format($product->price ?? 0, 0, ',', '.') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <div class="flex justify-end space-x-2">
                                                            <a href="#" class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                                                <i class="uil uil-eye text-lg"></i>
                                                            </a>
                                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                                                <i class="uil uil-edit text-lg"></i>
                                                            </a>
                                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                                                    <i class="uil uil-trash-alt text-lg"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                        <div class="flex flex-col items-center justify-center py-8">
                                                            <i class="uil uil-package text-4xl text-gray-400 mb-2"></i>
                                                            <p class="text-gray-500">Tidak ada produk yang ditemukan</p>
                                                            <a href="{{ route('admin.products.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                                <i class="uil uil-plus mr-1"></i> Tambah Produk Pertama
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
