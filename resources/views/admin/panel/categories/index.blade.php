@extends('layouts.admin')

@section('header')
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-orange-700">
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
            <div class="lg:col-span-2 bg-white/80 backdrop-blur-sm border border-orange-200/50 rounded-2xl overflow-hidden">
                <div class="p-6 bg-white border-b border-transparent">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-600 rounded-xl flex items-center justify-center">
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
                                        <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center border border-orange-200/50">
                                            <i data-lucide="tag" class="w-5 h-5 text-orange-600"></i>
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
                                            <button @click="editing = true" class="group relative p-2 text-orange-600 hover:text-orange-800 bg-orange-50/30 hover:bg-orange-100/50 rounded-lg border border-orange-200/30 hover:border-orange-300/50 transition-all duration-200 transform hover:-translate-y-0.5" title="Edit">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                            </button>
                                        </template>
                                        <template x-if="editing">
                                            <form action="{{ route('admin.categories.update', $cat->id) }}" method="POST" class="flex items-center space-x-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="name" value="{{ $cat->name }}" class="px-3 py-2 bg-white/80 backdrop-blur-sm border border-transparent rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="Nama" required>
                                                <input type="text" name="description" value="{{ $cat->description }}" class="px-3 py-2 bg-white/80 backdrop-blur-sm border border-transparent rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="Deskripsi">
                                                <button type="submit" class="group relative p-2 text-emerald-600 hover:text-emerald-800 bg-emerald-50/30 hover:bg-emerald-100/50 rounded-lg border border-emerald-200/50 hover:border-emerald-300/50 transition-all duration-200 transform hover:-translate-y-0.5" title="Simpan">
                                                    <i data-lucide="check" class="w-4 h-4"></i>
                                                </button>
                                                <button type="button" @click="editing = false" class="p-2 text-gray-500 hover:text-gray-700 bg-white/80 hover:bg-gray-100 rounded-lg border border-gray-200/50 hover:border-gray-300/50 transition-all duration-200 transform hover:-translate-y-0.5" title="Batal">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </template>
                                    </div>
                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="relative group p-2 text-white rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-sm shadow-orange-200/50 hover:shadow-orange-200" title="Hapus">
                                            <div class="absolute inset-0 rounded-lg bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                            <span class="relative">
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
            <div class="bg-white/80 backdrop-blur-sm border border-orange-200/50 rounded-2xl overflow-hidden">
                <div class="p-6 bg-white border-b border-transparent">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-600 rounded-xl flex items-center justify-center">
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
                            <input type="text" name="name" class="w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50 placeholder-gray-400" placeholder="Contoh: AC & Pendingin" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="description" class="w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50 placeholder-gray-400 resize-none" rows="3" placeholder="Deskripsi kategori (opsional)"></textarea>
                        </div>
                        <button type="submit" class="relative group w-full py-2.5 px-4 text-sm font-medium text-white rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-sm shadow-orange-200/50 hover:shadow-orange-200 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-orange-500/50 transition-all duration-200 transform hover:-translate-y-0.5">
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                            <span class="relative flex items-center justify-center">
                                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                                <span>Tambah Kategori</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
