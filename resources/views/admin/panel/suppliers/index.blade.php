@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-ocean-600 to-mint-600 bg-clip-text text-transparent">
                Suppliers
            </h2>
            <p class="text-sm text-gray-600 mt-1">Kelola data supplier dan mitra bisnis</p>
        </div>
        <a href="{{ route('admin.suppliers.create') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-r from-ocean-500 to-mint-500 px-6 py-3 font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-ocean-500/25 hover:shadow-xl hover:scale-105">
            <span class="relative z-10 flex items-center space-x-2">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span>Tambah Supplier</span>
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
                    <div class="overflow-x-auto">
                        <div class="shadow-xl overflow-hidden border border-white/20 rounded-2xl bg-white/60 backdrop-blur-sm">
                            <table class="min-w-full divide-y divide-gray-200/50">
                                <thead class="bg-gradient-to-r from-ocean-50/80 to-mint-50/80 backdrop-blur-sm">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-ocean-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="building" class="w-4 h-4"></i>
                                                <span>Nama Supplier</span>
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-ocean-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="phone" class="w-4 h-4"></i>
                                                <span>Kontak</span>
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-ocean-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                                <span>Alamat</span>
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-right text-xs font-semibold text-ocean-700 uppercase tracking-wider">
                                            <div class="flex items-center justify-end space-x-2">
                                                <i data-lucide="settings" class="w-4 h-4"></i>
                                                <span>Aksi</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/40 backdrop-blur-sm divide-y divide-gray-200/30">
                                    @forelse($suppliers as $supplier)
                                        <tr class="hover:bg-white/60 transition-colors duration-200">
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-12 w-12">
                                                        <div class="h-12 w-12 bg-gradient-to-br from-ocean-100 to-mint-100 rounded-xl flex items-center justify-center border border-white/50 shadow-sm">
                                                            <i data-lucide="building-2" class="w-6 h-6 text-ocean-600"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-semibold text-gray-900">{{ $supplier->name }}</div>
                                                        <div class="text-xs text-gray-500">Supplier ID: #{{ str_pad($supplier->id, 4, '0', STR_PAD_LEFT) }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="space-y-1">
                                                    @if($supplier->phone)
                                                        <div class="flex items-center text-sm text-gray-900">
                                                            <i data-lucide="phone" class="w-4 h-4 text-gray-400 mr-2"></i>
                                                            {{ $supplier->phone }}
                                                        </div>
                                                    @endif
                                                    @if($supplier->email)
                                                        <div class="flex items-center text-sm text-gray-600">
                                                            <i data-lucide="mail" class="w-4 h-4 text-gray-400 mr-2"></i>
                                                            {{ $supplier->email }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="text-sm text-gray-900 max-w-xs">
                                                    {{ $supplier->address ?: 'Alamat belum diisi' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="group relative p-2 text-amber-600 hover:text-amber-800 bg-amber-50/50 hover:bg-amber-100 rounded-lg transition-all duration-200 hover:scale-110" title="Edit">
                                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                                    </a>
                                                    <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('Hapus supplier ini?')" class="inline">
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
                                            <td colspan="4" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mb-4">
                                                        <i data-lucide="building" class="w-8 h-8 text-gray-400"></i>
                                                    </div>
                                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada data supplier</h3>
                                                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan supplier pertama</p>
                                                    <a href="{{ route('admin.suppliers.create') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-r from-ocean-500 to-mint-500 px-6 py-3 font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-ocean-500/25 hover:shadow-xl hover:scale-105">
                                                        <span class="relative z-10 flex items-center space-x-2">
                                                            <i data-lucide="plus" class="w-5 h-5"></i>
                                                            <span>Tambah Supplier Pertama</span>
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
                        @if(method_exists($suppliers, 'links'))
                            <div class="mt-6">
                                {{ $suppliers->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection
