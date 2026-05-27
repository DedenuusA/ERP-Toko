@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <!-- TITLE -->

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                📂 Kategori Barang

            </h1>

            <p class="text-gray-500 mt-1">

                Kelola data kategori barang

            </p>

        </div>

        <!-- SEARCH + BUTTON -->

        <div class="flex flex-col sm:flex-row gap-3">

            <!-- SEARCH -->

            <form method="GET" action="{{ route('categories.index') }}">

                <div class="relative">

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                        class="w-full sm:w-72 border border-gray-300 rounded-xl px-4 py-3 pl-11 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <span class="absolute left-4 top-3.5 text-gray-400">

                        🔍

                    </span>

                </div>

            </form>

            <!-- BUTTON -->

            <a href="{{ route('categories.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition">

                <span>
                    ➕
                </span>

                Tambah Kategori

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
                            No
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Nama
                        </th>

                        <th class="p-4 text-left font-semibold">
                            Deskripsi
                        </th>

                        <th class="p-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($categories as $category)
                        <tr class="border-t hover:bg-slate-50 transition">

                            <td class="p-4">

                                {{ $loop->iteration }}

                            </td>

                            <td class="p-4 font-medium text-slate-800">

                                {{ $category->name }}

                            </td>

                            <td class="p-4 text-gray-600">

                                {{ $category->description ?? '-' }}

                            </td>

                            <td class="p-4">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- EDIT -->

                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg transition">

                                        ✏️ Edit

                                    </a>

                                    <!-- DELETE -->

                                    <form action="{{ route('categories.destroy', $category) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Yakin hapus kategori?')"
                                            class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg transition">

                                            🗑️ Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center p-10 text-gray-500">

                                Data kategori kosong

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINATION -->

    <div class="mt-6">

        {{ $categories->links() }}

    </div>
@endsection
