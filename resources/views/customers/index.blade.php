@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <!-- TITLE -->

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                👥 Data Customer

            </h1>

            <p class="text-gray-500 mt-1">

                Kelola seluruh data customer toko

            </p>

        </div>

        <!-- SEARCH + BUTTON -->

        <div class="flex flex-col sm:flex-row gap-3">

            <!-- SEARCH -->

            <form method="GET" action="{{ route('customers.index') }}">

                <div class="relative">

                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari customer..."
                        class="w-full sm:w-72 border border-gray-300 rounded-xl px-4 py-3 pl-11 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <span class="absolute left-4 top-3.5 text-gray-400">

                        🔍

                    </span>

                </div>

            </form>

            <!-- BUTTON -->

            <a href="{{ route('customers.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 transition text-white px-5 py-3 rounded-xl">

                <span>
                    ➕
                </span>

                Tambah Customer

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
                            Customer
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Telepon
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Alamat
                        </th>

                        <th class="p-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($customers as $customer)
                        <tr class="border-t hover:bg-slate-50 transition">

                            <!-- CUSTOMER -->

                            <td class="p-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center text-lg">

                                        👤

                                    </div>

                                    <div>

                                        <p class="font-semibold text-slate-800">

                                            {{ $customer->nama }}

                                        </p>

                                        <p class="text-sm text-gray-500">

                                            Customer Toko

                                        </p>

                                    </div>

                                </div>

                            </td>

                            <!-- TELEPON -->

                            <td class="p-4">

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">

                                    {{ $customer->telp }}

                                </span>

                            </td>

                            <!-- ALAMAT -->

                            <td class="p-4 text-gray-600">

                                <div class="flex items-start gap-2">

                                    <span>
                                        📍
                                    </span>

                                    <span>

                                        {{ $customer->alamat }}

                                    </span>

                                </div>

                            </td>

                            <!-- AKSI -->

                            <td class="p-4">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- EDIT -->

                                    <a href="{{ route('customers.edit', $customer) }}"
                                        class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg transition">

                                        ✏️ Edit

                                    </a>

                                    <!-- DELETE -->

                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Yakin hapus customer?')"
                                            class="inline-flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg transition">

                                            🗑️ Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center p-10 text-gray-500">

                                Data customer kosong

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINATION -->

    <div class="mt-6">

        {{ $customers->withQueryString()->links() }}

    </div>
@endsection
