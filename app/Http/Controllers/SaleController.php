<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $sales = Sale::with('customer')->when($request->search, function ($query) use ($request) {
            $query->where('invoice', 'like', '%' . $request->search . '%');
        })
            ->latest()->paginate(5);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();

        $products = Product::all();

        return view('sales.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'invoice' => 'SL-' . time(),

                'customer_id' => $request->customer_id,

                'tanggal' => $request->tanggal,

                'total' => 0,

                'keterangan' => $request->keterangan,
            ]);

            $grandTotal = 0;

            foreach ($request->product_id as $key => $productId) {
                $qty = $request->qty[$key];

                $harga = $request->harga[$key];

                $subtotal = $qty * $harga;

                SaleItem::create([
                    'sale_id' => $sale->id,

                    'product_id' => $productId,

                    'qty' => $qty,

                    'harga' => $harga,

                    'subtotal' => $subtotal,
                ]);

                $product = Product::find($productId);

                $product->stok -= $qty;

                $product->save();

                $grandTotal += $subtotal;
            }

            $sale->update([
                'total' => $grandTotal,
            ]);

            DB::commit();

            return redirect()->route('sales.index')->with('success', 'Penjualan berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }

    public function show(Sale $sale)
    {
        $sale->load(['customer', 'items.product']);

        return view('sales.show', compact('sale'));
    }

    public function pdf(Sale $sale)
    {
        $sale->load(['customer', 'items.product']);

        $pdf = Pdf::loadView('sales.pdf', compact('sale'));

        return $pdf->download($sale->invoice . '.pdf');
    }
}
