@extends('layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="flex items-center justify-between mb-6">

            <h1 class="text-2xl font-bold">
                Edit Supplier
            </h1>

            <a href="{{ route('suppliers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">
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

            <form action="{{ route('suppliers.update', $supplier) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 font-medium">
                            Nama Supplier
                        </label>

                        <input type="text" name="nama" value="{{ old('nama', $supplier->nama) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Telepon
                        </label>

                        <input type="text" name="telepon" value="{{ old('telepon', $supplier->telepon) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email', $supplier->email) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Kota
                        </label>

                        <input type="text" name="kota" value="{{ old('kota', $supplier->kota) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">
                            Alamat
                        </label>

                        <textarea name="alamat" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3">{{ old('alamat', $supplier->alamat) }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">
                            Nama Sales
                        </label>

                        <input type="text" name="nama_sales" value="{{ old('nama_sales', $supplier->nama_sales) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                </div>

                <button type="submit" class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg">
                    Update
                </button>

            </form>

        </div>

    </div>

@endsection
