<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $purchases = Purchase::with('supplier')->when($request->search, function ($query) use ($request) {
            $query->where('invoice', 'like', '%' . $request->search . '%');
        })
            ->latest()
            ->paginate(5);

        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('purchases.create', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
            'tanggal' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'harga' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $purchase = Purchase::create([
                'invoice' => 'PB-' . time(),
                'supplier_id' => $request->supplier_id,
                'tanggal' => $request->tanggal,
                'total' => 0,
                'keterangan' => $request->keterangan,
            ]);

            $total = 0;

            foreach ($request->product_id as $key => $productId) {
                $qty = $request->qty[$key];
                $harga = $request->harga[$key];

                $subtotal = $qty * $harga;

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productId,
                    'qty' => $qty,
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                ]);

                // tambah stok
                $product = Product::find($productId);

                $product->increment('stok', $qty);

                $total += $subtotal;
            }

            $purchase->update([
                'total' => $total,
            ]);

            DB::commit();

            return redirect()->route('purchases.index')->with('success', 'Pembelian berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }

    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'items.product']);

        return view('purchases.show', compact('purchase'));
    }

    public function pdf(Purchase $purchase)
    {
        $purchase->load(['supplier', 'items.product']);

        $pdf = Pdf::loadView('purchases.pdf', compact('purchase'));

        return $pdf->download($purchase->invoice . '.pdf');
        // return $pdf->stream();
    }
}
