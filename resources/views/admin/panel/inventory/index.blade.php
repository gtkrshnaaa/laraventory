@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Inventory</h2>
        <form action="{{ route('admin.inventory.adjust') }}" method="POST" class="flex items-center space-x-2">
            @csrf
            <select name="product_id" class="border rounded px-2 py-1" required>
                <option value="">Pilih Produk</option>
                @foreach($products as $p)
                    <option value="{{ $p->id }}">{{ $p->name }} (Stok: {{ $p->stock }})</option>
                @endforeach
            </select>
            <select name="type" class="border rounded px-2 py-1" required>
                <option value="in">Masuk</option>
                <option value="out">Keluar</option>
            </select>
            <input type="number" name="quantity" min="1" class="border rounded px-2 py-1 w-24" placeholder="Qty" required>
            <input type="text" name="note" class="border rounded px-2 py-1" placeholder="Catatan (opsional)">
            <button class="px-3 py-1.5 rounded bg-blue-600 text-white hover:bg-blue-700">Adjust</button>
        </form>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm ring-1 ring-gray-200">
                <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-medium text-gray-900">Daftar Produk</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Min</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($products as $p)
                                <tr>
                                    <td class="px-6 py-3 text-sm text-gray-900">{{ $p->name }}</td>
                                    <td class="px-6 py-3 text-sm text-gray-500">{{ optional($p->category)->name ?? '-' }}</td>
                                    <td class="px-6 py-3 text-sm text-gray-900">{{ $p->stock }}</td>
                                    <td class="px-6 py-3 text-sm text-gray-500">{{ $p->min_stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $products->links() }}
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm ring-1 ring-gray-200">
                <div class="p-4 border-b border-gray-100">
                    <h3 class="font-medium text-gray-900">Stok Menipis</h3>
                </div>
                <div class="divide-y">
                    @forelse($lowStock as $ls)
                        <div class="p-4 flex items-center justify-between">
                            <div>
                                <div class="font-medium text-gray-900">{{ $ls->name }}</div>
                                <div class="text-xs text-gray-500">Stok: {{ $ls->stock }} | Min: {{ $ls->min_stock }}</div>
                            </div>
                            <form action="{{ route('admin.inventory.adjust') }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $ls->id }}">
                                <input type="hidden" name="type" value="in">
                                <input type="number" name="quantity" min="1" value="1" class="border rounded px-2 py-1 w-20">
                                <button class="px-3 py-1.5 rounded bg-blue-600 text-white hover:bg-blue-700">+ Tambah</button>
                            </form>
                        </div>
                    @empty
                        <div class="p-6 text-center text-sm text-gray-500">Tidak ada item stok menipis</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
