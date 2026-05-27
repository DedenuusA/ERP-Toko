<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Invoice Pembelian</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #333;
            padding: 30px;
        }

        .header {
            margin-bottom: 30px;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .invoice-info {
            margin-top: 20px;
        }

        .invoice-info p {
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table thead {
            background: #f3f4f6;
        }

        table th {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table td {
            border: 1px solid #ddd;
            padding: 12px;
        }

        .text-right {
            text-align: right;
        }

        .total-box {
            margin-top: 20px;
            width: 300px;
            margin-left: auto;
        }

        .total-box table td {
            border: none;
            padding: 8px;
        }

        .grand-total {
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>

</head>

<body>

    <div class="header">

        <div class="title">
            INVOICE PEMBELIAN
        </div>

        <div>
            ERP TOKO BANGUNAN
        </div>

        <div class="invoice-info">

            <p>
                <strong>Invoice:</strong>
                {{ $purchase->invoice }}
            </p>

            <p>
                <strong>Tanggal:</strong>
                {{ $purchase->tanggal }}
            </p>

            <p>
                <strong>Supplier:</strong>
                {{ $purchase->supplier->nama }}
            </p>

        </div>

    </div>

    <table>

        <thead>

            <tr>

                <th width="5%">No</th>

                <th>Barang</th>

                <th width="15%">Qty</th>

                <th width="20%">Harga</th>

                <th width="20%">Subtotal</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($purchase->items as $item)
                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->product?->nama_barang }}
                    </td>

                    <td>
                        {{ $item->qty }}
                    </td>

                    <td>
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </td>

                    <td>
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

    <div class="total-box">

        <table>

            <tr>

                <td class="text-right grand-total">

                    Total: Rp {{ number_format($purchase->total, 0, ',', '.') }}

                </td>

            </tr>

        </table>

    </div>

    <div class="footer">

        Terima kasih telah melakukan transaksi.

    </div>

</body>

</html>
