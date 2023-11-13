<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SaleExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $sale;

    public function __construct($sale)
    {
        $this->sale = $sale;
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function view(): View
    {
        return view(
            "sales.excel",
            [
                "sale" => $this->sale,
            ]
        );
    }
}
