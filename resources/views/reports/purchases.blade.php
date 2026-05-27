@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold flex items-center gap-2">
                📦 Laporan Pembelian
            </h1>

            <p class="text-gray-500 mt-1 flex items-center gap-2">
                🧾 Data transaksi pembelian
            </p>

        </div>

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
                        🏢 Supplier
                    </label>

                    <select name="supplier_id" class="w-full border border-gray-300 rounded-lg px-4 py-3">

                        <option value="">Semua Supplier</option>

                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->nama }}
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
    <div class="bg-red-600 text-white rounded-2xl p-6 mb-6">

        <p class="text-lg flex items-center gap-2">
            💸 Total Pembelian
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

                    <th class="p-4 text-left">🧾 Invoice</th>
                    <th class="p-4 text-left">🏢 Supplier</th>
                    <th class="p-4 text-left">📅 Tanggal</th>
                    <th class="p-4 text-left">💸 Total</th>
                    <th class="p-4 text-left">⚙️ Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($purchases as $purchase)
                    <tr class="border-t">

                        <td class="p-4">
                            {{ $purchase->invoice }}
                        </td>

                        <td class="p-4">
                            {{ $purchase->supplier?->nama ?? '-' }}
                        </td>

                        <td class="p-4">
                            {{ $purchase->tanggal }}
                        </td>

                        <td class="p-4 font-bold text-red-600">
                            Rp {{ number_format($purchase->total, 0, ',', '.') }}
                        </td>

                        <td class="p-4">

                            <a href="{{ route('reports.purchases.detail', $purchase) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 w-fit">

                                📄 Detail

                            </a>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-6 text-gray-500">
                            Data laporan kosong
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-4">

        {{ $purchases->withQueryString()->links() }}

    </div>
@endsection
