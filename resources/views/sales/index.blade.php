@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <!-- TITLE -->

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                💰 Data Penjualan

            </h1>

            <p class="text-gray-500 mt-1">

                Daftar seluruh transaksi penjualan toko

            </p>


        </div>

        <div class="flex flex-col sm:flex-row gap-3">

            <!-- SEARCH -->

            <form method="GET" action="{{ route('sales.index') }}">

                <div class="relative">

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari invoice..."
                        class="w-full sm:w-72 border border-gray-300 rounded-xl px-4 py-3 pl-11 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <span class="absolute left-4 top-3.5 text-gray-400">

                        🔍

                    </span>

                </div>

            </form>
            <!-- BUTTON -->

            <a href="{{ route('sales.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition">

                <span>
                    ➕
                </span>

                Tambah Penjualan

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

                <thead class="bg-slate-100">

                    <tr>

                        <th class="p-4 text-left font-semibold">
                            Invoice
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Customer
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

                    @forelse($sales as $sale)
                        <tr class="border-t hover:bg-slate-50 transition">

                            <!-- INVOICE -->

                            <td class="p-4">

                                <div>

                                    <p class="font-semibold text-slate-800">

                                        {{ $sale->invoice }}

                                    </p>

                                    <p class="text-sm text-gray-500">

                                        Transaksi POS / Penjualan

                                    </p>

                                </div>

                            </td>

                            <!-- CUSTOMER -->

                            <td class="p-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">

                                        👤

                                    </div>

                                    <div>

                                        <p class="font-medium text-slate-700">

                                            {{ $sale->customer?->nama ?? 'Umum' }}

                                        </p>

                                    </div>

                                </div>

                            </td>

                            <!-- TANGGAL -->

                            <td class="p-4 text-gray-600">

                                📅
                                {{ \Carbon\Carbon::parse($sale->tanggal)->format('d M Y') }}

                            </td>

                            <!-- TOTAL -->

                            <td class="p-4">

                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-bold text-sm">

                                    Rp {{ number_format($sale->total, 0, ',', '.') }}

                                </span>

                            </td>

                            <!-- AKSI -->

                            <td class="p-4">

                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('sales.show', $sale) }}"
                                        class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">

                                        👁️ Detail

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center p-10 text-gray-500">

                                Data penjualan kosong

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINATION -->

    <div class="mt-6">

        {{ $sales->withQueryString()->links() }}

    </div>
@endsection
