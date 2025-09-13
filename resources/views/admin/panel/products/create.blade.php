@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Tambah Produk Baru</h2>
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 bg-white border-2 border-gray-200/50 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50/80 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500/50 transition-all duration-200">
            <i class="uil uil-arrow-left mr-2"></i>
            <span>Kembali</span>
        </a>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="max-w-full mx-auto">
            <div class="bg-transparent">
                @php $action = route('admin.products.store'); @endphp
                @include('admin.panel.products.form', [
                    'method' => 'POST',
                    'action' => $action,
                    'product' => null,
                    'categories' => $categories,
                    'suppliers' => $suppliers,
                ])
            </div>
        </div>
    </div>
@endsection
