@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Tambah Supplier</h2>
        <a href="{{ route('admin.suppliers.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200/50 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50/80 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500/50 transition-all duration-200">
            <i class="uil uil-arrow-left mr-2"></i>
            <span>Kembali</span>
        </a>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-full">
            <div class="overflow-hidden bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-2xl">
                <div class="p-6 bg-white/50 border-b border-gray-200/30">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="uil uil-truck mr-2 text-blue-600"></i>
                        Informasi Supplier
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">Masukkan detail supplier dengan lengkap dan akurat.</p>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.suppliers.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                       class="mt-1 block w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-gray-300 transition-all duration-200 hover:border-gray-300/50">
                                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Telepon</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                           class="mt-1 block w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-gray-300 transition-all duration-200 hover:border-gray-300/50">
                                    @error('phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                           class="mt-1 block w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-gray-300 transition-all duration-200 hover:border-gray-300/50">
                                    @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                <textarea name="address" rows="3"
                                          class="mt-1 block w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-gray-300 transition-all duration-200 hover:border-gray-300/50">{{ old('address') }}</textarea>
                                @error('address')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 mt-6 p-6 bg-white/50 border-t border-gray-200/30 rounded-b-2xl">
                            <a href="{{ route('admin.suppliers.index') }}" class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200/50 rounded-xl hover:bg-gray-50/80 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500/50 transition-all duration-200 hover:shadow-sm">
                                <span class="flex items-center space-x-2">
                                    <i class="uil uil-times mr-1"></i>
                                    <span>Batal</span>
                                </span>
                            </a>
                            <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500/50 transition-all duration-200 hover:shadow-sm">
                                <span class="flex items-center space-x-2">
                                    <i class="uil uil-save mr-1"></i>
                                    <span>Simpan</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
