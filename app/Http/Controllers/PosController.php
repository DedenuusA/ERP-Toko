<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $customers = Customer::all();

        return view('pos.index', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'invoice' => 'POS-' . time(),

                'customer_id' => $request->customer_id,

                'tanggal' => now(),

                'total' => 0,

                'keterangan' => 'Transaksi POS',
            ]);

            $grandTotal = 0;

            foreach ($request->product_id as $key => $productId) {
                $product = Product::find($productId);

                // validasi product
                if (!$product) {
                    DB::rollback();

                    return back()->with('error', 'Produk tidak ditemukan');
                }

                $qty = (int) $request->qty[$key];

                // validasi stok
                if ($qty > $product->stok) {
                    DB::rollback();

                    return back()->with('error', 'Stok ' . $product->nama_barang . ' tidak cukup');
                }

                $harga = $product->harga_jual;

                $subtotal = $qty * $harga;

                SaleItem::create([
                    'sale_id' => $sale->id,

                    'product_id' => $productId,

                    'qty' => $qty,

                    'harga' => $harga,

                    'subtotal' => $subtotal,
                ]);

                // update stok
                $product->stok -= $qty;

                $product->save();

                $grandTotal += $subtotal;
            }

            $bayar = $request->bayar;

            $kembalian = $bayar - $grandTotal;

            if ($bayar < $grandTotal) {
                DB::rollback();

                return back()->with('error', 'Uang bayar kurang');
            }

            $sale->update([
                'total' => $grandTotal,

                'metode_pembayaran' => $request->metode_pembayaran,

                'bayar' => $bayar,

                'kembalian' => $kembalian,
            ]);

            DB::commit();

            return redirect()->route('pos.print', $sale->id)->with('success', 'Transaksi berhasil');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }

    public function print(Sale $sale)
    {
        $sale->load(['customer', 'items.product']);

        return view('pos.print', compact('sale'));
    }
}
