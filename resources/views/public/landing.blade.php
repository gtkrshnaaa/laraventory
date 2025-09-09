@extends('layouts.public')

@section('title', config('app.name'))

@section('content')
    <!-- Hero -->
    <section class="text-center">
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">Selamat datang di {{ config('app.name') }}</h1>
        <p class="mt-3 text-gray-600 max-w-2xl mx-auto">Sistem manajemen stok suku cadang alat rumah tangga. Kelola produk, kategori, supplier, dan pergerakan stok dengan mudah.</p>
        <div class="mt-6">
            <a href="{{ route('admin.login') }}" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-white text-sm font-medium hover:bg-blue-700">Masuk Admin</a>
        </div>
    </section>

    <!-- Kategori Populer (dummy) -->
    <section class="mt-10">
        <h2 class="text-xl font-semibold text-gray-800">Kategori Populer</h2>
        <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach (["AC", "Kulkas", "Mesin Cuci", "TV", "Kompor"] as $cat)
                <div class="rounded-lg border border-gray-200 bg-white p-4 text-center text-gray-700 hover:shadow">
                    {{ $cat }}
                </div>
            @endforeach
        </div>
    </section>

    <!-- Produk Unggulan (dummy) -->
    <section class="mt-10">
        <h2 class="text-xl font-semibold text-gray-800">Produk Unggulan</h2>
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $featured = [
                    ['name' => 'AC Split 1 PK Standard', 'price' => 3500000, 'image' => 'https://via.placeholder.com/320x200?text=AC+Split'],
                    ['name' => 'Kulkas 2 Pintu 300L', 'price' => 4500000, 'image' => 'https://via.placeholder.com/320x200?text=Kulkas+2+Pintu'],
                    ['name' => 'Mesin Cuci 8KG Front Load', 'price' => 5200000, 'image' => 'https://via.placeholder.com/320x200?text=Mesin+Cuci'],
                ];
            @endphp
            @foreach ($featured as $item)
                <div class="rounded-lg border border-gray-200 bg-white overflow-hidden hover:shadow">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900">{{ $item['name'] }}</h3>
                        <p class="mt-1 text-blue-600 font-semibold">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
