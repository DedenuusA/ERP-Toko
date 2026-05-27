@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto">

        <!-- HEADER -->
        <div class="mb-6">

            <h1 class="text-3xl font-bold flex items-center gap-2">
                📊 Laporan Laba Rugi
            </h1>

            <p class="text-gray-500 mt-1 flex items-center gap-2">
                📈 Monitoring keuntungan bisnis
            </p>

        </div>

        <!-- FILTER -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">

            <form method="GET">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <div>
                        <label class="block mb-2 font-medium flex items-center gap-2">
                            📅 Tanggal Awal
                        </label>

                        <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium flex items-center gap-2">
                            📅 Tanggal Akhir
                        </label>

                        <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    </div>

                    <div class="flex items-end">

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg flex items-center justify-center gap-2">

                            🔍 Filter

                        </button>

                    </div>

                </div>

            </form>

        </div>

        <!-- CARD -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- PENJUALAN -->
            <div class="bg-green-600 text-white rounded-2xl p-6">

                <p class="text-lg flex items-center gap-2">
                    💰 Total Penjualan
                </p>

                <h2 class="text-3xl font-bold mt-4">
                    Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                </h2>

            </div>

            <!-- MODAL -->
            <div class="bg-red-600 text-white rounded-2xl p-6">

                <p class="text-lg flex items-center gap-2">
                    📦 Total Modal
                </p>

                <h2 class="text-3xl font-bold mt-4">
                    Rp {{ number_format($totalModal, 0, ',', '.') }}
                </h2>

            </div>

            <!-- LABA -->
            <div class="bg-blue-600 text-white rounded-2xl p-6">

                <p class="text-lg flex items-center gap-2">
                    📊 Laba Bersih
                </p>

                <h2 class="text-3xl font-bold mt-4">
                    Rp {{ number_format($labaBersih, 0, ',', '.') }}
                </h2>

            </div>

        </div>

        <!-- STATUS -->
        <div class="mt-8 bg-white rounded-2xl shadow-sm p-6">

            @if ($labaBersih > 0)
                <div class="text-green-600 text-xl font-bold flex items-center gap-2">
                    🟢 Bisnis Menghasilkan Keuntungan
                </div>
            @elseif($labaBersih < 0)
                <div class="text-red-600 text-xl font-bold flex items-center gap-2">
                    🔴 Bisnis Mengalami Kerugian
                </div>
            @else
                <div class="text-gray-600 text-xl font-bold flex items-center gap-2">
                    ⚪ Belum Ada Keuntungan
                </div>
            @endif

        </div>

    </div>
@endsection
