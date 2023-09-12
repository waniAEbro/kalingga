<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use Illuminate\Http\RedirectResponse;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('purchases.index', ["purchases" =>Purchase::get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('purchases.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request) :RedirectResponse
    {
        Purchase::create([
            'supplier_id' => $request->supplier_id,
            'purchase_date' => $request->purchase_date,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'remain_bill' => $request->remain_bill,
        ]);

        return redirect("/purchases");
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
