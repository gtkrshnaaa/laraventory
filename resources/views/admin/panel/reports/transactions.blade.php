@extends('layouts.admin')

@section('header')
    <h2 class="text-xl font-semibold leading-tight text-gray-800">Laporan Transaksi Stok</h2>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($movements as $m)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $m->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ optional($m->product)->name }} <span class="text-xs text-gray-500">({{ optional($m->product)->sku }})</span></td>
                                        <td class="px-6 py-4 text-sm">
                                            @if($m->type === 'in')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Masuk</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Keluar</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-right text-gray-900">{{ $m->quantity }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $m->note }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $movements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
