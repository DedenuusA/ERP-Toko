@extends('layouts.app')

@section('content')

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <!-- TITLE -->

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                🛍️ Data Pembelian

            </h1>

            <p class="text-gray-500 mt-1">

                Kelola seluruh transaksi pembelian barang

            </p>

        </div>

        <!-- SEARCH + BUTTON -->

        <div class="flex flex-col sm:flex-row gap-3">

            <!-- SEARCH -->

            <form method="GET" action="{{ route('purchases.index') }}">

                <div class="relative">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari invoice / supplier..."
                        class="w-full sm:w-72 border border-gray-300 rounded-xl px-4 py-3 pl-11 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <span class="absolute left-4 top-3.5 text-gray-400">

                        🔍

                    </span>

                </div>

            </form>

            <!-- BUTTON -->

            <a href="{{ route('purchases.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition">

                <span>
                    ➕
                </span>

                Tambah Pembelian

            </a>

        </div>

    </div>

    <!-- ALERT -->

    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6">

            {{ session('success') }}

        </div>
    @endif

    <!-- TABLE -->

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-blue-100">

                    <tr>

                        <th class="p-4 text-left font-semibold">
                            Invoice
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Supplier
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Barang
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Tanggal
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Total
                        </th>

                        <th class="p-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($purchases as $purchase)
                        <tr class="border-t hover:bg-slate-50 transition">

                            <!-- INVOICE -->

                            <td class="p-4">

                                <div>

                                    <p class="font-semibold text-slate-800">

                                        {{ $purchase->invoice }}

                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">

                                        Transaksi Pembelian

                                    </p>

                                </div>

                            </td>

                            <!-- SUPPLIER -->

                            <td class="p-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center">

                                        🚚

                                    </div>

                                    <div>

                                        <p class="font-medium text-slate-700">

                                            {{ $purchase->supplier?->nama }}

                                        </p>

                                    </div>

                                </div>

                            </td>

                            <!-- BARANG -->

                            <td class="p-4">

                                <div class="space-y-2">

                                    @foreach ($purchase->items->take(3) as $item)
                                        <div class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm inline-block">

                                            📦
                                            {{ $item->product?->nama_barang }}

                                        </div>
                                    @endforeach

                                    @if ($purchase->items->count() > 3)
                                        <div class="text-xs text-gray-500">

                                            +
                                            {{ $purchase->items->count() - 3 }}
                                            barang lainnya

                                        </div>
                                    @endif

                                </div>

                            </td>

                            <!-- TANGGAL -->

                            <td class="p-4 text-gray-600">

                                📅
                                {{ \Carbon\Carbon::parse($purchase->tanggal)->format('d M Y') }}

                            </td>

                            <!-- TOTAL -->

                            <td class="p-4">

                                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full font-bold text-sm">

                                    Rp {{ number_format($purchase->total, 0, ',', '.') }}

                                </span>

                            </td>

                            <!-- AKSI -->

                            <td class="p-4">

                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('purchases.show', $purchase) }}"
                                        class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">

                                        👁️ Detail

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center p-10 text-gray-500">

                                Data pembelian kosong

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINATION -->

    <div class="mt-6">

        {{ $purchases->withQueryString()->links() }}

    </div>

@endsection
