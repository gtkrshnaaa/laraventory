@extends('layouts.admin')

@section('header')
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-ocean-600 to-mint-600 bg-clip-text text-transparent">
                Kategori Produk
            </h2>
            <p class="text-sm text-gray-600 mt-1">Kelola kategori untuk mengorganisir produk spare part</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- List -->
            <div class="lg:col-span-2 bg-white/80 backdrop-blur-sm shadow-xl border border-white/20 rounded-2xl overflow-hidden">
                <div class="p-6 bg-gradient-to-r from-ocean-50/80 to-mint-50/80 border-b border-gray-200/30">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-ocean-500 to-mint-500 rounded-xl flex items-center justify-center">
                            <i data-lucide="folder" class="w-4 h-4 text-white"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Kategori</h3>
                    </div>
                </div>
                <div class="divide-y divide-gray-200/30">
                    @forelse($categories as $cat)
                        <div class="p-6 hover:bg-white/60 transition-colors duration-200">
                            <div class="flex items-start justify-between space-x-4">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <div class="w-10 h-10 bg-gradient-to-br from-ocean-100 to-mint-100 rounded-xl flex items-center justify-center border border-white/50">
                                            <i data-lucide="tag" class="w-5 h-5 text-ocean-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $cat->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $cat->description ?: 'Tidak ada deskripsi' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div x-data="{ editing: false }" class="flex items-center space-x-2">
                                        <template x-if="!editing">
                                            <button @click="editing = true" class="group relative p-2 text-amber-600 hover:text-amber-800 bg-amber-50/50 hover:bg-amber-100 rounded-lg transition-all duration-200 hover:scale-110" title="Edit">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                            </button>
                                        </template>
                                        <template x-if="editing">
                                            <form action="{{ route('admin.categories.update', $cat->id) }}" method="POST" class="flex items-center space-x-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="name" value="{{ $cat->name }}" class="px-3 py-2 bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-lg text-sm focus:ring-2 focus:ring-ocean-500/20 focus:border-ocean-500" placeholder="Nama" required>
                                                <input type="text" name="description" value="{{ $cat->description }}" class="px-3 py-2 bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-lg text-sm focus:ring-2 focus:ring-ocean-500/20 focus:border-ocean-500" placeholder="Deskripsi">
                                                <button type="submit" class="group relative p-2 text-emerald-600 hover:text-emerald-800 bg-emerald-50/50 hover:bg-emerald-100 rounded-lg transition-all duration-200 hover:scale-110" title="Simpan">
                                                    <i data-lucide="check" class="w-4 h-4"></i>
                                                </button>
                                                <button type="button" @click="editing = false" class="group relative p-2 text-gray-600 hover:text-gray-800 bg-gray-50/50 hover:bg-gray-100 rounded-lg transition-all duration-200 hover:scale-110" title="Batal">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </template>
                                    </div>
                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="group relative p-2 text-red-600 hover:text-red-800 bg-red-50/50 hover:bg-red-100 rounded-lg transition-all duration-200 hover:scale-110" title="Hapus">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="folder" class="w-8 h-8 text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada kategori</h3>
                            <p class="text-gray-500">Mulai dengan menambahkan kategori pertama</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Create -->
            <div class="bg-white/80 backdrop-blur-sm shadow-xl border border-white/20 rounded-2xl overflow-hidden">
                <div class="p-6 bg-gradient-to-r from-ocean-50/80 to-mint-50/80 border-b border-gray-200/30">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-ocean-500 to-mint-500 rounded-xl flex items-center justify-center">
                            <i data-lucide="plus" class="w-4 h-4 text-white"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Tambah Kategori</h3>
                    </div>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                            <input type="text" name="name" class="w-full px-4 py-3 bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:ring-2 focus:ring-ocean-500/20 focus:border-ocean-500 transition-all duration-200" placeholder="Contoh: AC & Pendingin" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="description" class="w-full px-4 py-3 bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:ring-2 focus:ring-ocean-500/20 focus:border-ocean-500 transition-all duration-200 resize-none" rows="3" placeholder="Deskripsi kategori (opsional)"></textarea>
                        </div>
                        <button type="submit" class="w-full group relative overflow-hidden rounded-xl bg-gradient-to-r from-ocean-500 to-mint-500 px-6 py-3 font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-ocean-500/25 hover:shadow-xl hover:scale-105">
                            <span class="relative z-10 flex items-center justify-center space-x-2">
                                <i data-lucide="save" class="w-5 h-5"></i>
                                <span>Simpan Kategori</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-ocean-600 to-mint-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
