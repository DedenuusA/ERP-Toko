@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold">
                    POS Kasir
                </h1>

                <p class="text-gray-500">
                    Sistem kasir modern
                </p>
            </div>

        </div>

        @if (session('success'))
            <div id="alert-success" class="w-full bg-green-100 border border-green-400 text-green-700 px-4 py-4 rounded-xl">

                {{ session('success') }}

            </div>
        @endif

        @if (session('error'))
            <div id="alert-error" class="w-full bg-red-100 border border-red-400 text-red-700 px-4 py-4 rounded-xl">

                {{ session('error') }}

            </div>
        @endif

        <form action="{{ route('pos.store') }}" method="POST" class="mt-2">

            @csrf

            <!-- CUSTOMER -->

            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block mb-2 font-medium">

                            Customer

                        </label>

                        <select name="customer_id" class="w-full border border-gray-300 rounded-lg px-4 py-3">

                            <option value="">
                                Umum
                            </option>

                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">

                                    {{ $customer->nama }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Tanggal
                        </label>

                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3" readonly>
                    </div>
                </div>
            </div>

            <!-- TABLE -->

            <div class="mb-6">

                <label class="block mb-2 font-medium">

                    Scan Barcode

                </label>

                <input type="text" id="barcode-input" placeholder="Scan barcode..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-3">

            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6">

                <table class="w-full">

                    <thead>

                        <tr class="border-b">

                            <th class="p-3 text-left">
                                Barang
                            </th>

                            <th class="p-3 text-left">
                                Stok
                            </th>

                            <th class="p-3 text-left">
                                Harga
                            </th>

                            <th class="p-3 text-left">
                                Qty
                            </th>

                            <th class="p-3 text-left">
                                Subtotal
                            </th>

                            <th class="p-3 text-left">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody id="table-body">

                        <tr>

                            <td class="p-3">

                                <select name="product_id[]"
                                    class="product-select w-full border border-gray-300 rounded-lg px-3 py-2">

                                    <option value="">
                                        Pilih Barang
                                    </option>

                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-harga="{{ $product->harga_jual }}"
                                            data-stok="{{ $product->stok }}" data-barcode="{{ $product->barcode }}">

                                            {{ $product->nama_barang }}

                                        </option>
                                    @endforeach

                                </select>

                            </td>

                            <td class="p-3">

                                <input type="text"
                                    class="stok w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100" readonly
                                    value="0">

                            </td>

                            <td class="p-3">

                                <input type="number" name="harga[]"
                                    class="harga w-full border border-gray-300 rounded-lg px-3 py-2" value="0"
                                    readonly>

                            </td>

                            <td class="p-3">

                                <input type="number" name="qty[]"
                                    class="qty w-full border border-gray-300 rounded-lg px-3 py-2" value="1">

                            </td>

                            <td class="p-3">

                                <input type="text"
                                    class="subtotal w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100" readonly
                                    value="0">

                            </td>

                            <td class="p-3">

                                <button type="button" class="remove-row bg-red-600 text-white px-3 py-2 rounded-lg">

                                    Hapus

                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

                <button type="button" id="add-row" class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg">

                    + Tambah Barang

                </button>

                <!-- TOTAL -->

                <div class="mt-6 text-right">

                    <h2 class="text-3xl font-bold">

                        Total:
                        Rp <span id="grand-total">0</span>

                    </h2>

                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- METODE -->

                    <div>

                        <label class="block mb-2 font-medium">

                            Metode Pembayaran

                        </label>

                        <select name="metode_pembayaran" class="w-full border border-gray-300 rounded-lg px-4 py-3">

                            <option value="Cash">
                                Cash
                            </option>

                            <option value="Transfer">
                                Transfer
                            </option>

                            <option value="QRIS">
                                QRIS
                            </option>

                        </select>

                    </div>

                    <!-- BAYAR -->

                    <div>

                        <label class="block mb-2 font-medium">

                            Bayar

                        </label>

                        <input type="number" name="bayar" id="bayar"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3" value="0">

                    </div>

                    <!-- KEMBALIAN -->

                    <div>

                        <label class="block mb-2 font-medium">

                            Kembalian

                        </label>

                        <input type="text" id="kembalian"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-100" readonly value="0">

                    </div>

                </div>

                <button type="submit" class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg">

                    Simpan Transaksi

                </button>

            </div>

        </form>

    </div>
@endsection

@push('scripts')
    <script>
        function calculateRow(row) {
            let qty = parseFloat(
                row.querySelector('.qty').value
            ) || 0;

            let harga = parseFloat(
                row.querySelector('.harga').value
            ) || 0;

            let subtotal = qty * harga;

            row.querySelector('.subtotal').value =
                subtotal.toLocaleString('id-ID');

            calculateGrandTotal();
        }

        function calculateGrandTotal() {
            let total = 0;

            document.querySelectorAll('.subtotal')
                .forEach(item => {

                    total += parseFloat(
                        item.value.replace(/\./g, '')
                    ) || 0;

                });

            document.getElementById('grand-total')
                .innerText = total.toLocaleString('id-ID');

            calculateKembalian();
        }

        function initRow(row) {
            let product = row.querySelector('.product-select');

            let stok = row.querySelector('.stok');

            let harga = row.querySelector('.harga');

            let qty = row.querySelector('.qty');

            product.addEventListener('change', function() {

                let selected =
                    this.options[this.selectedIndex];

                harga.value =
                    selected.dataset.harga || 0;

                stok.value =
                    selected.dataset.stok || 0;

                calculateRow(row);

            });

            qty.addEventListener('input', function() {

                let maxStock =
                    parseFloat(stok.value) || 0;

                if (parseFloat(this.value) > maxStock) {

                    alert('Stok tidak cukup');

                    this.value = maxStock;
                }

                calculateRow(row);

            });

            row.querySelector('.remove-row')
                .addEventListener('click', function() {

                    row.remove();

                    calculateGrandTotal();

                });

            calculateRow(row);
        }

        document.querySelectorAll('#table-body tr')
            .forEach(row => initRow(row));

        document.getElementById('add-row')
            .addEventListener('click', function() {

                let firstRow =
                    document.querySelector('#table-body tr');

                let newRow =
                    firstRow.cloneNode(true);

                newRow.querySelectorAll('input')
                    .forEach(input => {

                        if (input.classList.contains('qty')) {

                            input.value = 1;

                        } else {

                            input.value = 0;
                        }

                    });

                newRow.querySelector('select')
                    .selectedIndex = 0;

                document.getElementById('table-body')
                    .appendChild(newRow);

                initRow(newRow);

            });

        setTimeout(() => {

            let alerts =
                document.querySelectorAll('.bg-green-100, .bg-red-100');

            alerts.forEach(alert => {

                alert.style.display = 'none';

            });

        }, 3000);

        document.getElementById('barcode-input')
            .addEventListener('keydown', function(e) {

                if (e.key === 'Enter') {

                    e.preventDefault();

                    let barcode =
                        this.value.trim().toLowerCase();

                    let foundOption = null;

                    // cari semua option produk
                    document.querySelectorAll(
                        '.product-select option'
                    ).forEach(option => {

                        let optionBarcode =
                            (option.dataset.barcode || '')
                            .trim()
                            .toLowerCase();

                        if (optionBarcode === barcode) {

                            foundOption = option;

                        }

                    });

                    // jika ketemu
                    if (foundOption) {

                        // ambil row terakhir
                        let lastRow =
                            document.querySelector(
                                '#table-body tr:last-child'
                            );

                        let select =
                            lastRow.querySelector(
                                '.product-select'
                            );

                        // set product
                        select.value =
                            foundOption.value;

                        // trigger change
                        select.dispatchEvent(
                            new Event('change')
                        );

                    } else {

                        alert('Barcode tidak ditemukan');

                    }

                    // kosongkan input
                    this.value = '';

                }

            });

        function calculateKembalian() {
            let total = 0;

            document.querySelectorAll('.subtotal')
                .forEach(item => {

                    total += parseFloat(
                        item.value.replace(/\./g, '')
                    ) || 0;

                });

            let bayar = parseFloat(
                document.getElementById('bayar').value
            ) || 0;

            let kembalian = bayar - total;

            document.getElementById('kembalian')
                .value = kembalian.toLocaleString('id-ID');
        }

        document.getElementById('bayar')
            .addEventListener('input', function() {

                calculateKembalian();

            });
    </script>
@endpush
