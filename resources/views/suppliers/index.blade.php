@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <!-- TITLE -->

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                🚚 Data Supplier

            </h1>

            <p class="text-gray-500 mt-1">

                Kelola seluruh data supplier toko

            </p>

        </div>

        <!-- SEARCH + BUTTON -->

        <div class="flex flex-col sm:flex-row gap-3">

            <!-- SEARCH -->

            <form method="GET" action="{{ route('suppliers.index') }}">

                <div class="relative">

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari supplier..."
                        class="w-full sm:w-72 border border-gray-300 rounded-xl px-4 py-3 pl-11 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <span class="absolute left-4 top-3.5 text-gray-400">

                        🔍

                    </span>

                </div>

            </form>

            <!-- BUTTON -->

            <a href="{{ route('suppliers.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition">

                <span>
                    ➕
                </span>

                Tambah Supplier

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
                            Supplier
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Telepon
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Kota
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Sales
                        </th>

                        <th class="p-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($suppliers as $supplier)
                        <tr class="border-t hover:bg-slate-50 transition">

                            <!-- SUPPLIER -->

                            <td class="p-4">

                                <div>

                                    <p class="font-semibold text-slate-800">

                                        {{ $supplier->nama }}

                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">

                                        {{ $supplier->email ?? 'Tidak ada email' }}

                                    </p>

                                </div>

                            </td>

                            <!-- TELEPON -->

                            <td class="p-4">

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">

                                    {{ $supplier->telepon }}

                                </span>

                            </td>

                            <!-- KOTA -->

                            <td class="p-4">

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                    📍 {{ $supplier->kota }}

                                </span>

                            </td>

                            <!-- SALES -->

                            <td class="p-4">

                                <div class="flex items-center gap-2">

                                    <div class="w-9 h-9 rounded-full bg-orange-100 flex items-center justify-center">

                                        👨‍💼

                                    </div>

                                    <span class="font-medium text-slate-700">

                                        {{ $supplier->nama_sales }}

                                    </span>

                                </div>

                            </td>

                            <!-- AKSI -->

                            <td class="p-4">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- EDIT -->

                                    <a href="{{ route('suppliers.edit', $supplier) }}"
                                        class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg transition">

                                        ✏️ Edit

                                    </a>

                                    <!-- DELETE -->

                                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Yakin hapus supplier?')"
                                            class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg transition">

                                            🗑️ Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center p-10 text-gray-500">

                                Data supplier kosong

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINATION -->

    <div class="mt-6">

        {{ $suppliers->withQueryString()->links() }}

    </div>
@endsection
