@extends('layouts.app')

@section('content')
    <div class="mb-8">

        <h1 class="text-3xl font-bold">
            Dashboard ERP
        </h1>

        <p class="text-gray-500">
            Monitoring bisnis toko bangunan
        </p>

    </div>

    <!-- CARD -->

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">

        <!-- TOTAL BARANG -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500 mb-2">
                        Total Barang
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800">

                        {{ $totalBarang }}

                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl">

                    📦

                </div>

            </div>

        </div>

        <!-- TOTAL SUPPLIER -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500 mb-2">
                        Total Supplier
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800">

                        {{ $totalSupplier }}

                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center text-3xl">

                    🚚

                </div>

            </div>

        </div>

        <!-- TOTAL CUSTOMER -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500 mb-2">
                        Total Customer
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800">

                        {{ $totalCustomer }}

                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center text-3xl">

                    👥

                </div>

            </div>

        </div>

        <!-- TOTAL PEMBELIAN -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500 mb-2">
                        Total Pembelian
                    </p>

                    <h2 class="text-3xl font-bold text-red-600">

                        Rp {{ number_format($totalPembelian, 0, ',', '.') }}

                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-3xl">

                    🛍️

                </div>

            </div>

        </div>

        <!-- TOTAL PENJUALAN -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500 mb-2">
                        Total Penjualan
                    </p>

                    <h2 class="text-3xl font-bold text-green-600">

                        Rp {{ number_format($totalPenjualan, 0, ',', '.') }}

                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-3xl">

                    💰

                </div>

            </div>

        </div>

        <!-- TOTAL STOK -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500 mb-2">
                        Total Stok
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800">

                        {{ number_format($totalStok) }}

                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center text-3xl">

                    📊

                </div>

            </div>

        </div>

    </div>

    <!-- GRID -->

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- STOK MENIPIS -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between mb-4">

                <h2 class="text-xl font-bold">
                    ⚠️ Stok Menipis
                </h2>

                <a href="{{ route('stocks.index') }}" class="text-sm text-blue-600 hover:underline">

                    Lihat Semua

                </a>

            </div>

            <div class="space-y-3 max-h-96 overflow-y-auto pr-2">

                @forelse($stokMenipis->take(5) as $product)
                    <div class="border rounded-xl p-4 hover:bg-gray-50 transition">

                        <div class="flex items-center justify-between">

                            <div>

                                <h3 class="font-semibold text-slate-800">

                                    {{ $product->nama_barang }}

                                </h3>

                                <p class="text-sm text-gray-500 mt-1">

                                    Barcode:
                                    {{ $product->barcode ?? '-' }}

                                </p>

                            </div>

                            <div class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-bold">

                                {{ $product->stok }}

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="flex items-center justify-center h-40 text-gray-500">

                        Tidak ada stok menipis

                    </div>
                @endforelse

            </div>

        </div>

        <!-- PENJUALAN -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between mb-4">

                <h2 class="text-xl font-bold">
                    💰 Penjualan
                </h2>

                <a href="{{ route('sales.index') }}" class="text-sm text-blue-600 hover:underline">

                    Lihat Semua

                </a>

            </div>

            <div class="space-y-3 max-h-96 overflow-y-auto pr-2">

                @forelse($latestSales->take(5) as $sale)
                    <div class="border rounded-xl p-4 hover:bg-gray-50 transition">

                        <div class="flex items-center justify-between">

                            <div>

                                <h3 class="font-semibold text-slate-800">

                                    {{ $sale->invoice }}

                                </h3>

                                <p class="text-sm text-gray-500 mt-1">

                                    {{ $sale->customer?->nama ?? 'Umum' }}

                                </p>

                            </div>

                            <div class="text-right">

                                <p class="text-green-600 font-bold">

                                    Rp {{ number_format($sale->total, 0, ',', '.') }}

                                </p>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="flex items-center justify-center h-40 text-gray-500">

                        Belum ada penjualan

                    </div>
                @endforelse

            </div>

        </div>

        <!-- PEMBELIAN -->

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between mb-4">

                <h2 class="text-xl font-bold">
                    🛍️ Pembelian
                </h2>

                <a href="{{ route('purchases.index') }}" class="text-sm text-blue-600 hover:underline">

                    Lihat Semua

                </a>

            </div>

            <div class="space-y-3 max-h-96 overflow-y-auto pr-2">

                @forelse($latestPurchases->take(5) as $purchase)
                    <div class="border rounded-xl p-4 hover:bg-gray-50 transition">

                        <div class="flex items-center justify-between">

                            <div>

                                <h3 class="font-semibold text-slate-800">

                                    {{ $purchase->invoice }}

                                </h3>

                                <p class="text-sm text-gray-500 mt-1">

                                    {{ $purchase->supplier?->nama }}

                                </p>

                            </div>

                            <div class="text-right">

                                <p class="text-red-600 font-bold">

                                    Rp {{ number_format($purchase->total, 0, ',', '.') }}

                                </p>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="flex items-center justify-center h-40 text-gray-500">

                        Belum ada pembelian

                    </div>
                @endforelse

            </div>

        </div>

    </div>
@endsection
