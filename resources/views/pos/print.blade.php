<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>
        Struk POS
    </title>

    <style>
        body {

            font-family: monospace;
            width: 280px;
            margin: auto;
            font-size: 12px;
            color: #000;
        }

        .text-center {

            text-align: center;
        }

        .mb-1 {

            margin-bottom: 5px;
        }

        .mb-2 {

            margin-bottom: 10px;
        }

        .border-top {

            border-top: 1px dashed #000;
            margin-top: 10px;
            padding-top: 10px;
        }

        table {

            width: 100%;
            border-collapse: collapse;
        }

        td {

            vertical-align: top;
            padding: 2px 0;
        }

        .right {

            text-align: right;
        }

        .bold {

            font-weight: bold;
        }

        @media print {

            body {

                width: 80mm;
            }

        }
    </style>

</head>

<body onload="window.print()">

    <!-- HEADER -->

    <div class="text-center mb-2">

        <h2 style="margin:0;">
            TOKO BANGUNAN
        </h2>

        <div>
            Sistem POS Modern
        </div>

        <div>
            ======================
        </div>

    </div>

    <!-- INFO -->

    <table>

        <tr>

            <td>
                Invoice
            </td>

            <td class="right">

                {{ $sale->invoice }}

            </td>

        </tr>

        <tr>

            <td>
                Tanggal
            </td>

            <td class="right">

                {{ \Carbon\Carbon::parse($sale->tanggal)->format('d-m-Y H:i') }}

            </td>

        </tr>

        <tr>

            <td>
                Customer
            </td>

            <td class="right">

                {{ $sale->customer?->nama ?? 'Umum' }}

            </td>

        </tr>

        <tr>

            <td>
                Pembayaran
            </td>

            <td class="right">

                {{ $sale->metode_pembayaran }}

            </td>

        </tr>

    </table>

    <!-- ITEMS -->

    <div class="border-top">

        @foreach ($sale->items as $item)
            <table>

                <tr>

                    <td colspan="2" class="bold">

                        {{ $item->product?->nama_barang }}

                    </td>

                </tr>

                <tr>

                    <td>

                        {{ $item->qty }} x
                        {{ number_format($item->harga, 0, ',', '.') }}

                    </td>

                    <td class="right">

                        {{ number_format($item->subtotal, 0, ',', '.') }}

                    </td>

                </tr>

            </table>
        @endforeach

    </div>

    <!-- TOTAL -->

    <div class="border-top">

        <table>

            <tr>

                <td class="bold">
                    TOTAL
                </td>

                <td class="right bold">

                    Rp {{ number_format($sale->total, 0, ',', '.') }}

                </td>

            </tr>

            <tr>

                <td>
                    Bayar
                </td>

                <td class="right">

                    Rp {{ number_format($sale->bayar, 0, ',', '.') }}

                </td>

            </tr>

            <tr>

                <td>
                    Kembalian
                </td>

                <td class="right">

                    Rp {{ number_format($sale->kembalian, 0, ',', '.') }}

                </td>

            </tr>

        </table>

    </div>

    <!-- FOOTER -->

    <div class="text-center border-top">

        <div class="mb-1">
            Terima Kasih
        </div>

        <div>
            Barang yang sudah dibeli
            tidak dapat dikembalikan
        </div>

        <div style="margin-top:10px;">
            ======================
        </div>

    </div>

</body>

</html>
