@extends('layouts.admin')

@section('header')
    <h2 class="text-xl font-semibold leading-tight text-gray-800">Profil Admin</h2>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Nama</label>
                            <input type="text" name="name" value="{{ old('name', auth('admin')->user()->name ?? '') }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', auth('admin')->user()->email ?? '') }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">No. HP</label>
                            <input type="text" name="phone" value="{{ old('phone', auth('admin')->user()->phone ?? '') }}" class="w-full border rounded px-3 py-2">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Simpan Profil</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-base font-medium text-gray-900 mb-4">Ubah Password</h3>
                    <form action="{{ route('admin.profile.password.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Password Saat Ini</label>
                            <input type="password" name="current_password" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Password Baru</label>
                                <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 rounded bg-yellow-600 text-white hover:bg-yellow-700">Ubah Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
