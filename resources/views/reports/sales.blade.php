@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold flex items-center gap-2">

                📊 Laporan Penjualan

            </h1>

            <p class="text-gray-500 mt-1 flex items-center gap-2">

                🧾 Data transaksi penjualan

            </p>

        </div>

        <a href="{{ route('reports.sales.export') }}"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg flex items-center gap-2">

            📥 Export Excel

        </a>

    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">

        <form method="GET">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

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

                <div>
                    <label class="block mb-2 font-medium flex items-center gap-2">
                        👤 Customer
                    </label>

                    <select name="customer_id" class="w-full border border-gray-300 rounded-lg px-4 py-3">

                        <option value="">Semua Customer</option>

                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}"
                                {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->nama }}
                            </option>
                        @endforeach

                    </select>

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

    <!-- TOTAL -->
    <div class="bg-green-600 text-white rounded-2xl p-6 mb-6">

        <p class="text-lg flex items-center gap-2">

            💰 Total Penjualan

        </p>

        <h2 class="text-4xl font-bold mt-2">

            Rp {{ number_format($total, 0, ',', '.') }}

        </h2>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <table class="w-full">

            <thead class="bg-blue-100">

                <tr>

                    <th class="p-4 text-left flex items-center gap-2">
                        🧾 Invoice
                    </th>

                    <th class="p-4 text-left">
                        👤 Customer
                    </th>

                    <th class="p-4 text-left">
                        📅 Tanggal
                    </th>

                    <th class="p-4 text-left">
                        💰 Total
                    </th>

                    <th class="p-4 text-left">
                        ⚙️ Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($sales as $sale)
                    <tr class="border-t">

                        <td class="p-4">
                            {{ $sale->invoice }}
                        </td>

                        <td class="p-4">
                            {{ $sale->customer?->nama ?? '-' }}
                        </td>

                        <td class="p-4">
                            {{ $sale->tanggal }}
                        </td>

                        <td class="p-4 font-bold text-green-600">
                            Rp {{ number_format($sale->total, 0, ',', '.') }}
                        </td>

                        <td class="p-4">

                            <a href="{{ route('reports.sales.detail', $sale) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 w-fit">

                                📄 Detail

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center p-6 text-gray-500">

                            Tidak ada data laporan

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-4">

        {{ $sales->withQueryString()->links() }}

    </div>
@endsection
