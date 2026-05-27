<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Product::count();

        $totalSupplier = Supplier::count();

        $totalCustomer = Customer::count();

        $totalPembelian = Purchase::sum('total');

        $totalPenjualan = Sale::sum('total');

        $totalStok = Product::sum('stok');

        $stokMenipis = Product::where('stok', '<=', 10)
            ->latest()
            ->take(5)
            ->get();

        $latestSales = Sale::with('customer')
            ->latest()
            ->take(5)
            ->get();

        $latestPurchases = Purchase::with('supplier')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalBarang',
            'totalSupplier',
            'totalCustomer',
            'totalPembelian',
            'totalPenjualan',
            'totalStok',
            'stokMenipis',
            'latestSales',
            'latestPurchases'
        ));
    }
}