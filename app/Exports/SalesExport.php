<?php

namespace App\Exports;

use App\Models\Transaction\Sales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Sales::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Total Items',
            'Total Price',
            'Created At',
        ];
    }

    /**
     * @param mixed $sale
     * @return array
     */
    public function map($sale): array
    {
        return [
            $sale->id,
            $sale->total_items,
            number_format($sale->total_price, 2),
            // Jumat, 26 Februari 2021 14:30:00
            $sale->created_at->format('l, d F Y H:i:s'),
        ];
    }
}
