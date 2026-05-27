@extends('layouts.app')

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="flex items-center justify-between mb-6">

            <h1 class="text-2xl font-bold">
                Edit Kategori
            </h1>

            <a href="{{ route('categories.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">
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

            <form action="{{ route('categories.update', $category) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Nama Kategori
                    </label>

                    <input type="text" name="name" value="{{ old('name', $category->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring focus:ring-blue-200">

                </div>

                <div class="mb-6">

                    <label class="block mb-2 font-medium">
                        Deskripsi
                    </label>

                    <textarea name="description" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring focus:ring-blue-200">{{ old('description', $category->description) }}</textarea>

                </div>

                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    Update
                </button>

            </form>

        </div>

    </div>

@endsection
