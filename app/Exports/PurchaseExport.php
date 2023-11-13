<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PurchaseExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $purchase;

    public function __construct($purchase)
    {
        $this->purchase = $purchase;
    }

    public function view(): View
    {
        return view(
            "purchases.excel",
            [
                "purchase" => $this->purchase,
            ]
        );
    }

    public function styles(Worksheet $sheet)
    {
        return [
            "A1:A3" => [
                "alignment" => [
                    "horizontal" => "center",
                    "vertical" => "center",
                ],
            ],
            "B1:F3" => [
                "alignment" => [
                    "horizontal" => "right",
                    "vertical" => "center",
                ]
            ]
        ];
    }
}
