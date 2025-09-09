@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Suppliers</h2>
        <a href="{{ route('admin.suppliers.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">Tambah Supplier</a>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($suppliers as $supplier)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $supplier->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <div>{{ $supplier->phone }}</div>
                                            <div>{{ $supplier->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $supplier->address }}</td>
                                        <td class="px-6 py-4 text-right text-sm">
                                            <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</a>
                                            <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus supplier ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data supplier</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
