<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use Illuminate\Http\RedirectResponse;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sales.index', ["sales" => Sale::get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request) :RedirectResponse
    {
        Sale::create([
            'customer_id' => $request-> customer_id,
            'sale_date' => $request->sale_date,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'remain_bill' => $request->remain_bill,
        ]);

        return redirect("/sales");
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view("sales.show", ["sales" => Sale::find($sale->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        return view("sales.edit", ["sales" => Sale::find($sale->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        $sale->update([
            'customer_id' => $request-> customer_id,
            'sale_date' => $request->sale_date,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'remain_bill' => $request->remain_bill,
        ]);

        return redirect("/sales");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect("/sales");
    }
}
