@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">

        <div class="flex items-center justify-between mb-6">

            <h1 class="text-2xl font-bold">
                Tambah Customer
            </h1>

            <a href="{{ route('customers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">

                Kembali

            </a>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <form action="{{ route('customers.store') }}" method="POST">

                @csrf

                <div class="mb-6">

                    <label class="block mb-2 font-medium">
                        Nama Customer
                    </label>

                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3">

                    @error('nama')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div class="mb-6">

                    <label class="block mb-2 font-medium">
                        No Telepon
                    </label>

                    <input type="text" name="telp" value="{{ old('telp') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3">

                </div>

                <div class="mb-6">

                    <label class="block mb-2 font-medium">
                        Alamat
                    </label>

                    <textarea name="alamat" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3">{{ old('alamat') }}</textarea>

                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-3 rounded-lg">

                    Simpan Customer

                </button>

            </form>

        </div>

    </div>
@endsection
