<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SaleExport implements FromView
{
    protected $sale;

    public function __construct($sale)
    {
        $this->sale = $sale;
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
