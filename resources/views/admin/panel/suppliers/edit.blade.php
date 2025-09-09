@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Supplier</h2>
        <a href="{{ route('admin.suppliers.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md text-xs font-semibold text-gray-700 hover:bg-gray-50">Kembali</a>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Nama</label>
                            <input type="text" name="name" value="{{ old('name', $supplier->name) }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Telepon</label>
                                <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}" class="w-full border rounded px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $supplier->email) }}" class="w-full border rounded px-3 py-2">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Alamat</label>
                            <textarea name="address" rows="3" class="w-full border rounded px-3 py-2">{{ old('address', $supplier->address) }}</textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
