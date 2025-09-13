@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Produk</h2>
        <div class="flex space-x-2">
            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200/50 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50/80 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-orange-500/50 transition-all duration-200">
                <i class="uil uil-arrow-left mr-2"></i>
                <span>Kembali</span>
            </a>
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-xl text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-red-500 transition-all duration-200">
                    <i class="uil uil-trash-alt mr-2"></i>
                    <span>Hapus</span>
                </button>
            </form>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="max-w-full mx-auto">
            <div class="bg-transparent">
                @php $action = route('admin.products.update', $product->id); @endphp
                @include('admin.panel.products.form', [
                    'method' => 'PUT',
                    'action' => $action,
                    'product' => $product,
                    'categories' => $categories,
                    'suppliers' => $suppliers,
                ])
            </div>
        </div>
    </div>
@endsection
