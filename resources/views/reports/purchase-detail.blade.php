@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold">
                    Detail Laporan Pembelian
                </h1>

                <p class="text-gray-500">
                    {{ $purchase->invoice }}
                </p>

            </div>

            <a href="{{ route('reports.purchases') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">

                Kembali

            </a>

        </div>

        <!-- INFO -->

        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <div>

                    <p class="text-sm text-gray-500">
                        Invoice
                    </p>

                    <h2 class="font-bold text-lg">
                        {{ $purchase->invoice }}
                    </h2>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Supplier
                    </p>

                    <h2 class="font-bold text-lg">
                        {{ $purchase->supplier?->nama }}
                    </h2>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Tanggal
                    </p>

                    <h2 class="font-bold text-lg">
                        {{ $purchase->tanggal }}
                    </h2>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Total
                    </p>

                    <h2 class="font-bold text-red-600 text-xl">

                        Rp {{ number_format($purchase->total, 0, ',', '.') }}

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

                    @foreach ($purchase->items as $item)
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
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>
@endsection
