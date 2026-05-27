@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-2xl font-bold">
                    Detail Pembelian
                </h1>

                <p class="text-gray-500">
                    Invoice: {{ $purchase->invoice }}
                </p>

            </div>

            <div class="flex items-center gap-3">

                <a href="{{ route('purchases.pdf', $purchase) }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">

                    Download PDF

                </a>

                <a href="{{ route('purchases.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">

                    Kembali

                </a>

            </div>

        </div>

        {{-- Informasi Pembelian --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <p class="text-sm text-gray-500 mb-1">
                        Supplier
                    </p>

                    <h2 class="font-semibold text-lg">
                        {{ $purchase->supplier->nama }}
                    </h2>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">
                        Tanggal
                    </p>

                    <h2 class="font-semibold text-lg">
                        {{ $purchase->tanggal }}
                    </h2>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">
                        Total
                    </p>

                    <h2 class="font-bold text-2xl text-blue-600">
                        Rp {{ number_format($purchase->total, 0, ',', '.') }}
                    </h2>
                </div>

            </div>

        </div>

        {{-- Detail Barang --}}
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4 text-left">
                            Barang
                        </th>

                        <th class="p-4 text-left">
                            Qty
                        </th>

                        <th class="p-4 text-left">
                            Harga
                        </th>

                        <th class="p-4 text-left">
                            Subtotal
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($purchase->items as $item)
                        <tr class="border-t">

                            <td class="p-4">
                                {{ $item->product?->nama_barang }}
                            </td>

                            <td class="p-4">
                                {{ $item->qty }}
                            </td>

                            <td class="p-4">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>

                            <td class="p-4 font-semibold">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center p-6 text-gray-500">

                                Tidak ada item pembelian

                            </td>

                        </tr>
                    @endforelse

                </tbody>

                <tfoot class="bg-gray-50">

                    <tr>

                        <td colspan="3" class="p-4 text-right font-bold text-lg">

                            Grand Total

                        </td>

                        <td class="p-4 font-bold text-lg text-blue-600">

                            Rp {{ number_format($purchase->total, 0, ',', '.') }}

                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>

        {{-- Keterangan --}}
        @if ($purchase->keterangan)
            <div class="bg-white rounded-2xl shadow-sm p-6 mt-6">

                <h3 class="font-semibold mb-2">
                    Keterangan
                </h3>

                <p class="text-gray-700">
                    {{ $purchase->keterangan }}
                </p>

            </div>
        @endif

    </div>
@endsection
