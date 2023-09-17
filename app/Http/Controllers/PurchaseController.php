<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('purchases.index', [
            "purchases" => Purchase::get(),
            "suppliers" => Supplier::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('purchases.create', ["suppliersName" => Supplier::pluck('name')->toArray(), "components" => Component::get(), "justArray" => ['one', 'two', 'three']]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request): RedirectResponse
    {
        dd($request->component_id, $request->total_bill, $request->paid);
        // $purchase = Purchase::create([
        //     'supplier_id' => $request->supplier_id,
        //     'purchase_date' => $request->purchase_date,
        //     'due_date' => $request->due_date,
        //     'status' => $request->total_bill - $request->paid == 0 ? "closed"  : "open",
        //     'remain_bill' => $request->total_bill - $request->paid,
        //     'total_bill' => $request->total_bill,
        //     'paid' => $request->paid,
        // ]);

        // foreach ($request->component_id as $index => $id) {
        //     DB::table("component_purchase")->insert([
        //         "component_id" => $id,
        //         "purchase_id" => $purchase->id,
        //         "quantity" => $request->quantity[$index],
        //     ]);
        // }

        return redirect("/purchases");
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        return view("purchases.show", ["purchases" => Purchase::find($purchase->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase, Supplier $supplier)
    {
        return view("purchases.edit", [
            "purchases" => Purchase::find($purchase->id),
            "suppliers" => Supplier::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        $purchase->update([
            'supplier_id' => $request->supplier_id,
            'purchase_date' => $request->purchase_date,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'remain_bill' => $request->remain_bill,
            'total_bill' => $request->total_bill,
            'paid' => $request->paid,
        ]);

        return redirect("/purchases");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect("/purchases");
    }
}
