<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\SaleItem;
use App\Models\Supplier;
use App\Exports\SalesReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $query = Sale::with('customer');

        // filter tanggal awal
        if ($request->tanggal_awal) {
            $query->whereDate('tanggal', '>=', $request->tanggal_awal);
        }

        // filter tanggal akhir
        if ($request->tanggal_akhir) {
            $query->whereDate('tanggal', '<=', $request->tanggal_akhir);
        }

        // filter customer
        if ($request->customer_id) {
            $query->where('customer_id', $request->customer_id);
        }

        $sales = $query->latest()->paginate(5);

        $total = $query->sum('total');

        $customers = Customer::all();

        return view('reports.sales', compact('sales', 'total', 'customers'));
    }

    public function salesDetail(Sale $sale)
    {
        $sale->load(['customer', 'items.product']);

        return view('reports.sales-detail', compact('sale'));
    }

    public function purchases(Request $request)
    {
        $query = Purchase::with('supplier');

        // filter tanggal awal
        if ($request->tanggal_awal) {
            $query->whereDate('tanggal', '>=', $request->tanggal_awal);
        }

        // filter tanggal akhir
        if ($request->tanggal_akhir) {
            $query->whereDate('tanggal', '<=', $request->tanggal_akhir);
        }

        // filter supplier
        if ($request->supplier_id) {
            $query->where('supplier_id', $request->supplier_id);
        }

        $purchases = $query->latest()->paginate(5);

        $total = $query->sum('total');

        $suppliers = Supplier::all();

        return view('reports.purchases', compact('purchases', 'total', 'suppliers'));
    }

    public function purchaseDetail(Purchase $purchase)
    {
        $purchase->load(['supplier', 'items.product']);

        return view('reports.purchase-detail', compact('purchase'));
    }

    public function profitLoss(Request $request)
    {
        $salesQuery = Sale::query();

        // filter tanggal awal
        if ($request->tanggal_awal) {
            $salesQuery->whereDate('tanggal', '>=', $request->tanggal_awal);
        }

        // filter tanggal akhir
        if ($request->tanggal_akhir) {
            $salesQuery->whereDate('tanggal', '<=', $request->tanggal_akhir);
        }

        // total penjualan
        $totalPenjualan = $salesQuery->sum('total');

        // ambil id sales
        $saleIds = $salesQuery->pluck('id');

        // hitung modal
        $totalModal = SaleItem::with('product')
            ->whereIn('sale_id', $saleIds)
            ->get()
            ->sum(function ($item) {
                return $item->qty * ($item->product->harga_beli ?? 0);
            });

        // laba bersih
        $labaBersih = $totalPenjualan - $totalModal;

        return view('reports.profit-loss', compact('totalPenjualan', 'totalModal', 'labaBersih'));
    }

    public function exportSales()
    {
        return Excel::download(new SalesReportExport(), 'laporan-penjualan.xlsx');
    }
}
