@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-blue-700">
                Profil Admin
            </h2>
            <p class="text-sm text-gray-600 mt-1">Kelola informasi profil dan keamanan akun</p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                <i data-lucide="user" class="w-6 h-6 text-white"></i>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-full">
            <!-- Profile Info Card -->
            <div class="overflow-hidden bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-2xl mb-8">
                <div class="p-8 bg-white">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center">
                                <i data-lucide="user" class="w-8 h-8 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Informasi Profil</h3>
                                <p class="text-sm text-gray-600">Update informasi dasar akun admin</p>
                            </div>
                        </div>
                        <div class="hidden md:flex items-center space-x-2 text-sm text-gray-500">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                            <span>Terverifikasi</span>
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                                    <i data-lucide="user" class="w-4 h-4 text-ocean-600"></i>
                                    <span>Nama Lengkap</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="name" value="{{ old('name', auth('admin')->user()->name ?? '') }}" 
                                           class="w-full pl-12 pr-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-gray-300 transition-all duration-200 hover:border-gray-300/50 placeholder-gray-400" 
                                           placeholder="Masukkan nama lengkap" required>
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                                    <i data-lucide="mail" class="w-4 h-4 text-ocean-600"></i>
                                    <span>Email Address</span>
                                </label>
                                <div class="relative">
                                    <input type="email" name="email" value="{{ old('email', auth('admin')->user()->email ?? '') }}" 
                                           class="w-full pl-12 pr-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-gray-300 transition-all duration-200 hover:border-gray-300/50 placeholder-gray-400" 
                                           placeholder="admin@example.com" required>
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i data-lucide="mail" class="w-4 h-4 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                                <i data-lucide="phone" class="w-4 h-4 text-ocean-600"></i>
                                <span>Nomor Telepon</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="phone" value="{{ old('phone', auth('admin')->user()->phone ?? '') }}" 
                                       class="w-full pl-12 pr-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-gray-300 transition-all duration-200 hover:border-gray-300/50 placeholder-gray-400" 
                                       placeholder="+62 812-3456-7890">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i data-lucide="phone" class="w-4 h-4 text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="relative group py-2.5 px-6 text-sm font-medium text-white rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 shadow-sm shadow-blue-200/50 hover:shadow-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500/50 transition-all duration-200 transform hover:-translate-y-0.5">
                                <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                <span class="relative flex items-center justify-center space-x-2">
                                    <i data-lucide="save" class="w-4 h-4"></i>
                                    <span>Simpan Profil</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Security Settings Card -->
            <div class="overflow-hidden bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-2xl">
                <div class="p-8 bg-white">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center">
                                <i data-lucide="shield-check" class="w-8 h-8 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Keamanan Akun</h3>
                                <p class="text-sm text-gray-600">Update password untuk menjaga keamanan akun</p>
                            </div>
                        </div>
                        <div class="hidden md:flex items-center space-x-2 text-sm text-red-600">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                            <span>Privasi Terjaga</span>
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.profile.password.update') }}" method="POST" class="space-y-6" x-data="{ showPasswords: false }">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-2">
                            <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                                <i data-lucide="key" class="w-4 h-4 text-red-600"></i>
                                <span>Password Saat Ini</span>
                            </label>
                            <div class="relative">
                                <input :type="showPasswords ? 'text' : 'password'" name="current_password" 
                                       class="w-full pl-12 pr-12 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-gray-300 transition-all duration-200 hover:border-gray-300/50 placeholder-gray-400" 
                                       placeholder="Masukkan password saat ini" required>
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i data-lucide="key" class="w-4 h-4 text-gray-400"></i>
                                </div>
                                <button type="button" @click="showPasswords = !showPasswords" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-200">
                                    <i :data-lucide="showPasswords ? 'eye-off' : 'eye'" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                                    <i data-lucide="lock" class="w-4 h-4 text-red-600"></i>
                                    <span>Password Baru</span>
                                </label>
                                <div class="relative">
                                    <input :type="showPasswords ? 'text' : 'password'" name="password" 
                                           class="w-full pl-12 pr-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-gray-300 transition-all duration-200 hover:border-gray-300/50 placeholder-gray-400" 
                                           placeholder="Password baru" required>
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i data-lucide="lock" class="w-4 h-4 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                                    <i data-lucide="shield" class="w-4 h-4 text-red-600"></i>
                                    <span>Konfirmasi Password</span>
                                </label>
                                <div class="relative">
                                    <input :type="showPasswords ? 'text' : 'password'" name="password_confirmation" 
                                           class="w-full pl-12 pr-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-gray-300 transition-all duration-200 hover:border-gray-300/50 placeholder-gray-400" 
                                           placeholder="Konfirmasi password" required>
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i data-lucide="shield" class="w-4 h-4 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Password Requirements -->
                        <div class="bg-blue-50 backdrop-blur-sm border border-gray-200/50 rounded-xl p-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <i data-lucide="info" class="w-5 h-5 text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-blue-800 mb-2">Persyaratan Password:</h4>
                                    <ul class="text-xs text-blue-700 space-y-1">
                                        <li class="flex items-center space-x-2">
                                            <i data-lucide="check" class="w-3 h-3"></i>
                                            <span>Minimal 8 karakter</span>
                                        </li>
                                        <li class="flex items-center space-x-2">
                                            <i data-lucide="check" class="w-3 h-3"></i>
                                            <span>Kombinasi huruf besar dan kecil</span>
                                        </li>
                                        <li class="flex items-center space-x-2">
                                            <i data-lucide="check" class="w-3 h-3"></i>
                                            <span>Mengandung angka dan simbol</span>
                                        </li>
                                    </ul>
                </div>
            </div>
            
            <!-- Account Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-2xl p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                <i data-lucide="calendar" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Bergabung Sejak</div>
                            <div class="text-lg font-bold text-gray-900">{{ auth('admin')->user()->created_at?->format('M Y') ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-2xl p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                <i data-lucide="clock" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Login Terakhir</div>
                            <div class="text-lg font-bold text-gray-900">{{ auth('admin')->user()->updated_at?->format('d M, H:i') ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-2xl p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                <i data-lucide="shield-check" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-500">Status Akun</div>
                            <div class="text-lg font-bold text-green-600">Aktif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
