@extends('layouts.admin')

@section('header')
    <h2 class="text-xl font-semibold leading-tight text-gray-800">Laporan Stok</h2>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Min Stok</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($products as $p)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $p->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $p->sku }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ optional($p->category)->name ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $p->stock }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $p->min_stock }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
