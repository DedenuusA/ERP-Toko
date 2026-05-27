<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::with(['category', 'unit'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('kode_barang', 'like', "%{$search}%")->orWhere('nama_barang', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(5);

        return view('stocks.index', compact('products'));
    }
}
