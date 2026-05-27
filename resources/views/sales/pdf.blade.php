<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Invoice Penjualan</title>

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

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
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
            INVOICE PENJUALAN
        </div>

        <div>
            ERP TOKO BANGUNAN
        </div>

        <div class="invoice-info">

            <p>
                <strong>Invoice:</strong>
                {{ $sale->invoice }}
            </p>

            <p>
                <strong>Tanggal:</strong>
                {{ $sale->tanggal }}
            </p>

            <p>
                <strong>Customer:</strong>
                {{ $sale->customer->nama }}
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

            @foreach ($sale->items as $item)
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

                <td>
                    Total
                </td>

                <td class="text-right grand-total">

                    Rp {{ number_format($sale->total, 0, ',', '.') }}

                </td>

            </tr>

        </table>

    </div>

    <div class="footer">

        Terima kasih telah berbelanja.

    </div>

</body>

</html>
