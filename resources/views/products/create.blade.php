@extends('layouts.app')

@section('content')

    <div class="max-w-5xl mx-auto">

        <div class="flex items-center justify-between mb-6">

            <h1 class="text-2xl font-bold">
                Tambah Barang
            </h1>

            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">
                Kembali
            </a>

        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">

                <ul class="list-disc pl-5">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <form action="{{ route('products.store') }}" method="POST">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 font-medium">
                            Kategori
                        </label>

                        <select name="category_id" class="w-full border border-gray-300 rounded-lg px-4 py-3">

                            <option value="">Pilih Kategori</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Satuan
                        </label>

                        <select name="unit_id" class="w-full border border-gray-300 rounded-lg px-4 py-3">

                            <option value="">Pilih Satuan</option>

                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">
                                    {{ $unit->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Kode Barang
                        </label>

                        <input type="text" name="kode_barang" value="{{ old('kode_barang') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Barcode
                        </label>

                        <input type="text" name="barcode" value="{{ old('barcode') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">
                            Nama Barang
                        </label>

                        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Harga Beli
                        </label>

                        <input type="number" name="harga_beli" value="{{ old('harga_beli') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Harga Jual
                        </label>

                        <input type="number" name="harga_jual" value="{{ old('harga_jual') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Stok
                        </label>

                        <input type="number" name="stok" value="{{ old('stok', 0) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Minimum Stok
                        </label>

                        <input type="number" name="minimum_stok" value="{{ old('minimum_stok', 0) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3">{{ old('deskripsi') }}</textarea>
                    </div>

                </div>

                <button type="submit" class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg">
                    Simpan
                </button>

            </form>

        </div>

    </div>

@endsection
