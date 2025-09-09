@extends('layouts.admin')

@section('header')
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Stats -->
            <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Total Produk -->
                <div class="overflow-hidden bg-white rounded-lg shadow">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 bg-blue-500 rounded-md">
                                <i class="text-white uil uil-package text-2xl"></i>
                            </div>
                            <div class="flex-1 w-0 ml-5">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Total Produk
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ number_format($stats['total_products'] ?? 0) }}
                                        </div>
                                        <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                            <i class="uil uil-arrow-up"></i>
                                            <span class="sr-only">
                                                Meningkat dari bulan lalu
                                            </span>
                                            12%
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-3 bg-gray-50">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                Lihat semua produk
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Stok -->
                <div class="overflow-hidden bg-white rounded-lg shadow">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 bg-green-500 rounded-md">
                                <i class="text-white uil uil-box text-2xl"></i>
                            </div>
                            <div class="flex-1 w-0 ml-5">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Total Stok
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ number_format($stats['total_stock'] ?? 0) }}
                                        </div>
                                        <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                            <i class="uil uil-arrow-up"></i>
                                            <span class="sr-only">
                                                Meningkat dari bulan lalu
                                            </span>
                                            5.4%
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-3 bg-gray-50">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                Kelola stok
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Kategori -->
                <div class="overflow-hidden bg-white rounded-lg shadow">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 bg-yellow-500 rounded-md">
                                <i class="text-white uil uil-tag text-2xl"></i>
                            </div>
                            <div class="flex-1 w-0 ml-5">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Kategori
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ number_format($stats['total_categories'] ?? 0) }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-3 bg-gray-50">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                Kelola kategori
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Supplier -->
                <div class="overflow-hidden bg-white rounded-lg shadow">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 bg-purple-500 rounded-md">
                                <i class="text-white uil uil-truck text-2xl"></i>
                            </div>
                            <div class="flex-1 w-0 ml-5">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Supplier
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ number_format($stats['total_suppliers'] ?? 0) }}
                                        </div>
                                        <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                            <i class="uil uil-arrow-up"></i>
                                            <span class="sr-only">
                                                Meningkat dari bulan lalu
                                            </span>
                                            2.3%
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-3 bg-gray-50">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                Lihat supplier
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik dan Aktivitas Terbaru -->
            <div class="grid grid-cols-1 gap-5 mt-8 lg:grid-cols-3">
                <!-- Grafik Stok -->
                <div class="lg:col-span-2">
                    <div class="p-5 bg-white rounded-lg shadow">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Ringkasan Stok</h3>
                            <div class="relative">
                                <select class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option>30 Hari Terakhir</option>
                                    <option>3 Bulan Terakhir</option>
                                    <option>Tahun Ini</option>
                                </select>
                            </div>
                        </div>
                        <div class="h-80">
                            <div class="flex items-center justify-center h-full bg-gray-100 rounded-lg">
                                <p class="text-gray-500">Grafik stok akan ditampilkan di sini</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aktivitas Terbaru -->
                <div>
                    <div class="overflow-hidden bg-white rounded-lg shadow">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Aktivitas Terbaru</h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            @if(count($recent_activities) > 0)
                                <div class="flow-root">
                                    <ul class="-mb-8">
                                        @foreach($recent_activities as $index => $activity)
                                            <li>
                                                <div class="relative pb-8">
                                                    @if($index < count($recent_activities) - 1)
                                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                                    @endif
                                                    <div class="relative flex space-x-3">
                                                        <div>
                                                            @if($activity['type'] === 'product')
                                                                <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                                    <i class="uil uil-package text-white text-sm"></i>
                                                                </span>
                                                            @elseif($activity['type'] === 'stock')
                                                                <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                                    <i class="uil uil-box text-white text-sm"></i>
                                                                </span>
                                                            @else
                                                                <span class="h-8 w-8 rounded-full bg-gray-500 flex items-center justify-center ring-8 ring-white">
                                                                    <i class="uil uil-info-circle text-white text-sm"></i>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                            <div>
                                                                <p class="text-sm text-gray-800">
                                                                    {!! $activity['message'] !!}
                                                                </p>
                                                            </div>
                                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                                <time datetime="{{ $activity['time'] }}">{{ $activity['time_ago'] }}</time>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="mt-6">
                                    <a href="#" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Lihat Semua Aktivitas
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="uil uil-comment-exclamation text-4xl text-gray-400"></i>
                                    <p class="mt-2 text-sm text-gray-500">Tidak ada aktivitas terbaru</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk Stok Sedikit -->
            <div class="mt-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Produk Stok Sedikit</h3>
                        <p class="mt-1 text-sm text-gray-500">Daftar produk dengan stok di bawah ambang batas minimum</p>
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        <a href="#" class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:w-auto">
                            <i class="uil uil-plus mr-2"></i> Tambah Stok
                        </a>
                    </div>
                </div>
                <div class="mt-4 overflow-hidden bg-white shadow sm:rounded-md">
                    <ul class="divide-y divide-gray-200">
                        @if(count($low_stock_products ?? []) > 0)
                            @foreach($low_stock_products as $product)
                                <li>
                                    <a href="#" class="block hover:bg-gray-50">
                                        <div class="px-4 py-4 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-blue-600 truncate">{{ $product['name'] }}</p>
                                                <div class="ml-2 flex-shrink-0 flex">
                                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Stok: {{ $product['stock'] }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="mt-2 sm:flex sm:justify-between">
                                                <div class="sm:flex">
                                                    <p class="flex items-center text-sm text-gray-500">
                                                        <i class="uil uil-tag mr-1.5 h-5 w-5 text-gray-400"></i>
                                                        {{ $product['category'] }}
                                                    </p>
                                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                                        <i class="uil uil-box mr-1.5 h-5 w-5 text-gray-400"></i>
                                                        Minimal stok: {{ $product['min_stock'] }}
                                                    </p>
                                                </div>
                                                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                                    <i class="uil uil-exclamation-triangle mr-1.5 h-5 w-5 text-yellow-400"></i>
                                                    {{ $product['status'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li class="py-8 text-center">
                                <i class="uil uil-check-circle text-4xl text-green-500"></i>
                                <p class="mt-2 text-sm text-gray-500">Tidak ada produk dengan stok sedikit</p>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
