@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <!-- TITLE -->

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                📦 Manajemen Stok

            </h1>

            <p class="text-gray-500 mt-1">

                Monitoring dan kontrol stok barang

            </p>

        </div>

    </div>

    <!-- SEARCH -->

    <div class="bg-white rounded-2xl shadow-sm p-4 mb-6">

        <form method="GET" action="{{ route('stocks.index') }}">

            <div class="relative">

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang / kode barang..."
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 pl-11 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                <span class="absolute left-4 top-3.5 text-gray-400">

                    🔍

                </span>

            </div>

        </form>

    </div>

    <!-- TABLE -->

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-blue-100">

                    <tr>

                        <th class="p-4 text-left font-semibold">
                            Barang
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Kategori
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Unit
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Stok
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)
                        <tr class="border-t hover:bg-slate-50 transition">

                            <!-- BARANG -->

                            <td class="p-4 font-medium text-slate-800">

                                {{ $product->nama_barang }}

                            </td>

                            <!-- KATEGORI -->

                            <td class="p-4 text-gray-600">

                                {{ $product->category?->name }}

                            </td>

                            <!-- UNIT -->

                            <td class="p-4 text-gray-600">

                                {{ $product->unit?->name }}

                            </td>

                            <!-- STOK -->

                            <td class="p-4 font-bold text-slate-800">

                                {{ $product->stok }}

                            </td>

                            <!-- STATUS -->

                            <td class="p-4">

                                @if ($product->stok == 0)
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">

                                        🔴 Habis

                                    </span>
                                @elseif($product->stok <= 10)
                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">

                                        🟡 Menipis

                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">

                                        🟢 Aman

                                    </span>
                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center p-10 text-gray-500">

                                Data stok kosong

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
