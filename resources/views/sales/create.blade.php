@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">
            Tambah Penjualan
        </h1>

        {{-- @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">

                {{ session('error') }}

            </div>
        @endif --}}

        <form action="{{ route('sales.store') }}" method="POST">

            @csrf

            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block mb-2 font-medium">
                            Customer
                        </label>

                        <select name="customer_id" class="w-full border border-gray-300 rounded-lg px-4 py-3">

                            <option value="">
                                Pilih Customer
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
                            class="w-full border border-gray-300 rounded-lg px-4 py-3">

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6">

                <table class="w-full" id="product-table">

                    <thead>

                        <tr class="border-b">

                            <th class="p-3 text-left">
                                Barang
                            </th>

                            <th class="p-3 text-left">
                                Stok
                            </th>

                            <th class="p-3 text-left">
                                Qty
                            </th>

                            <th class="p-3 text-left">
                                Harga
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
                                            data-stok="{{ $product->stok }}">

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

                                <input type="number" name="qty[]" value="1"
                                    class="qty w-full border border-gray-300 rounded-lg px-3 py-2">

                            </td>

                            <td class="p-3">

                                <input type="number" name="harga[]" value="0"
                                    class="harga w-full border border-gray-300 rounded-lg px-3 py-2">

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

                <div class="mt-6 text-right">

                    <h2 class="text-2xl font-bold">

                        Total:
                        Rp <span id="grand-total">0</span>

                    </h2>

                </div>

                <div class="mt-6">

                    <label class="block mb-2 font-medium">
                        Keterangan
                    </label>

                    <textarea name="keterangan" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3"></textarea>

                </div>

                <button type="submit" class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg">

                    Simpan Penjualan

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
        }

        function initRow(row) {
            let product = row.querySelector('.product-select');

            let qty = row.querySelector('.qty');

            let harga = row.querySelector('.harga');

            let stok = row.querySelector('.stok');

            product.addEventListener('change', function() {

                let selected = this.options[this.selectedIndex];

                harga.value = selected.dataset.harga || 0;

                stok.value = selected.dataset.stok || 0;

                calculateRow(row);

            });

            qty.addEventListener('input', function() {

                let maxStock = parseFloat(stok.value) || 0;

                if (parseFloat(this.value) > maxStock) {
                    alert('Stok tidak cukup');

                    this.value = maxStock;
                }

                calculateRow(row);

            });

            harga.addEventListener('input', function() {

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

                let newRow = firstRow.cloneNode(true);

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
    </script>
@endpush
