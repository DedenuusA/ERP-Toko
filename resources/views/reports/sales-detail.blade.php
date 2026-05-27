@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- HEADER -->

        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold">
                    Detail Laporan Penjualan
                </h1>

                <p class="text-gray-500">
                    {{ $sale->invoice }}
                </p>

            </div>

            <div class="flex gap-3">

                <a href="{{ route('sales.pdf', $sale) }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">

                    Download PDF

                </a>

                <a href="{{ route('reports.sales') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">

                    Kembali

                </a>

            </div>

        </div>

        <!-- INFO -->

        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <div>

                    <p class="text-sm text-gray-500 mb-1">
                        Invoice
                    </p>

                    <h2 class="font-bold text-lg">
                        {{ $sale->invoice }}
                    </h2>

                </div>

                <div>

                    <p class="text-sm text-gray-500 mb-1">
                        Customer
                    </p>

                    <h2 class="font-bold text-lg">
                        {{ $sale->customer?->nama }}
                    </h2>

                </div>

                <div>

                    <p class="text-sm text-gray-500 mb-1">
                        Tanggal
                    </p>

                    <h2 class="font-bold text-lg">
                        {{ $sale->tanggal }}
                    </h2>

                </div>

                <div>

                    <p class="text-sm text-gray-500 mb-1">
                        Total
                    </p>

                    <h2 class="font-bold text-green-600 text-xl">

                        Rp {{ number_format($sale->total, 0, ',', '.') }}

                    </h2>

                </div>

            </div>

        </div>

        <!-- TABLE -->

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

                    @forelse($sale->items as $item)
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

                                Tidak ada detail penjualan

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- TOTAL -->

        <div class="mt-6 flex justify-end">

            <div class="bg-white rounded-2xl shadow-sm p-6 w-full md:w-96">

                <div class="flex justify-between text-lg mb-3">

                    <span>
                        Grand Total
                    </span>

                    <span class="font-bold text-green-600">

                        Rp {{ number_format($sale->total, 0, ',', '.') }}

                    </span>

                </div>

            </div>

        </div>

    </div>
@endsection
