<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Purchase;

class QuotationController extends Controller
{
    public function index()
    {
        return view('quotation.index', [
            "sales" => Sale::get(),
            "purchases" => Purchase::get()
        ]);
    }
}
