@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <!-- TITLE -->

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                📦 Data Barang

            </h1>

            <p class="text-gray-500 mt-1">

                Kelola seluruh data produk barang

            </p>

        </div>

        <!-- SEARCH + BUTTON -->

        <div class="flex flex-col sm:flex-row gap-3">

            <!-- SEARCH -->

            <form method="GET" action="{{ route('products.index') }}">

                <div class="relative">

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..."
                        class="w-full sm:w-72 border border-gray-300 rounded-xl px-4 py-3 pl-11 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <span class="absolute left-4 top-3.5 text-gray-400">

                        🔍

                    </span>

                </div>

            </form>

            <!-- BUTTON -->

            <a href="{{ route('products.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition">

                <span>
                    ➕
                </span>

                Tambah Barang

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
                            Kode
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Nama Barang
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Kategori
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Satuan
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Harga Jual
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Stok
                        </th>

                        <th class="p-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)
                        <tr class="border-t hover:bg-slate-50 transition">

                            <!-- KODE -->

                            <td class="p-4">

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">

                                    {{ $product->kode_barang }}

                                </span>

                            </td>

                            <!-- NAMA -->

                            <td class="p-4">

                                <div>

                                    <p class="font-semibold text-slate-800">

                                        {{ $product->nama_barang }}

                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">

                                        Barcode:
                                        {{ $product->barcode ?? '-' }}

                                    </p>

                                </div>

                            </td>

                            <!-- KATEGORI -->

                            <td class="p-4">

                                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">

                                    {{ $product->category?->name ?? '-' }}

                                </span>

                            </td>

                            <!-- SATUAN -->

                            <td class="p-4">

                                <span class="bg-cyan-100 text-cyan-700 px-3 py-1 rounded-full text-sm">

                                    {{ $product->unit?->name ?? '-' }}

                                </span>

                            </td>

                            <!-- HARGA -->

                            <td class="p-4 font-bold text-green-600">

                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}

                            </td>

                            <!-- STOK -->

                            <td class="p-4">

                                @if ($product->stok <= 5)
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">

                                        {{ $product->stok }}

                                    </span>
                                @elseif($product->stok <= 10)
                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">

                                        {{ $product->stok }}

                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">

                                        {{ $product->stok }}

                                    </span>
                                @endif

                            </td>

                            <!-- AKSI -->

                            <td class="p-4">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- EDIT -->

                                    <a href="{{ route('products.edit', $product) }}"
                                        class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg transition">

                                        ✏️ Edit

                                    </a>

                                    <!-- DELETE -->

                                    <form action="{{ route('products.destroy', $product) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Yakin hapus barang?')"
                                            class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg transition">

                                            🗑️ Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center p-10 text-gray-500">

                                Data barang kosong

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINATION -->

    <div class="mt-6">

        {{ $products->withQueryString()->links() }}

    </div>
@endsection
