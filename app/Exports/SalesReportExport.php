<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesReportExport implements
    FromCollection,
    WithHeadings
{
    public function collection()
    {
        return Sale::with('customer')
            ->get()
            ->map(function ($sale) {

                return [

                    'invoice' => $sale->invoice,

                    'customer' => $sale->customer?->nama,

                    'tanggal' => $sale->tanggal,

                    'total' => $sale->total,

                ];

            });
    }

    public function headings(): array
    {
        return [

            'Invoice',
            'Customer',
            'Tanggal',
            'Total',

        ];
    }
}