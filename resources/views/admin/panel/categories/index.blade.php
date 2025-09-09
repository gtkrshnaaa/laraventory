@extends('layouts.admin')

@section('header')
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Kategori Produk</h2>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- List -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm ring-1 ring-gray-200">
                <div class="p-4 border-b border-gray-100">
                    <h3 class="font-medium text-gray-900">Daftar Kategori</h3>
                </div>
                <div class="divide-y">
                    @forelse($categories as $cat)
                        <div class="p-4 flex items-center justify-between">
                            <div>
                                <div class="font-medium text-gray-900">{{ $cat->name }}</div>
                                <div class="text-sm text-gray-500">{{ $cat->description }}</div>
                            </div>
                            <div>
                                <form action="{{ route('admin.categories.update', $cat->id) }}" method="POST" class="inline-flex items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ $cat->name }}" class="border rounded px-2 py-1 text-sm" placeholder="Nama">
                                    <input type="text" name="description" value="{{ $cat->description }}" class="border rounded px-2 py-1 text-sm" placeholder="Deskripsi">
                                    <button class="px-3 py-1.5 text-sm rounded bg-yellow-500 text-white hover:bg-yellow-600">Update</button>
                                </form>
                                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1.5 text-sm rounded bg-red-600 text-white hover:bg-red-700">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-sm text-gray-500">Belum ada kategori</div>
                    @endforelse
                </div>
            </div>

            <!-- Create -->
            <div class="bg-white rounded-lg shadow-sm ring-1 ring-gray-200">
                <div class="p-4 border-b border-gray-100">
                    <h3 class="font-medium text-gray-900">Tambah Kategori</h3>
                </div>
                <div class="p-4">
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-3">
                        @csrf
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Nama</label>
                            <input type="text" name="name" class="w-full border rounded px-3 py-2" placeholder="Nama kategori" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description" class="w-full border rounded px-3 py-2" rows="3" placeholder="Opsional"></textarea>
                        </div>
                        <button class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
