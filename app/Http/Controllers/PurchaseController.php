<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Component;
use App\Models\PurchaseHistory;
use App\Models\ComponentPurchase;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        return view('purchases.create', ["suppliers" => Supplier::get(), "components" => Component::get(), "justArray" => ['one', 'two', 'three']]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request): RedirectResponse
    {
        // dd($request->due_date);

        $request->validate([
            'supplier_id' => 'required',
            'purchase_date' => 'required',
            'due_date' => 'required',
            'code' => 'required',
        ],[
            'supplier_id.required' => 'ID Supplier tidak boleh kosong',
            'purchase_date.required' => 'Tanggal Pembelian tidak boleh kosong',
            'due_date.required' => 'Tanggal Jatuh Tempo tidak boleh kosong',
            'code.required' => 'Kode tidak boleh kosong',
        ]);

        $purchase = Purchase::create([
            'supplier_id' => $request->supplier_id,
            'purchase_date' => $request->purchase_date,
            'due_date' => $request->due_date,
            'status' => $request->total_bill - $request->paid == 0 ? "closed"  : "open",
            'remain_bill' => $request->total_bill - $request->paid,
            'total_bill' => $request->total_bill,
            'paid' => $request->paid,
            "code" => $request->code
        ]);

        foreach ($request->component_id as $index => $id) {
            DB::table("component_purchase")->insert([
                "component_id" => $id,
                "purchase_id" => $purchase->id,
                "quantity" => $request->quantity[$index],
            ]);
        }

        PurchaseHistory::create([
            "purchase_id" => $purchase->id,
            "description" => $purchase->status == "closed" ? "Pembayaran Lunas" : "Pembayaran Pertama",
            "payment" => $request->paid
        ]);

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
            "purchase" => $purchase,
            "suppliers" => Supplier::get(),
            "components" => Component::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        $request->validate([
            'paid' => 'required',
        ],[
            'paid.required' => 'Paid tidak boleh kosong',
        ]);

        $purchase->update([
            'status' => $purchase->remain_bill - $request->paid == 0 ? "closed"  : "open",
            'remain_bill' => $purchase->remain_bill - $request->paid,
            'paid' => $request->paid + $purchase->paid,
        ]);

        $count = PurchaseHistory::where("purchase_id", $purchase->id)->count();

        PurchaseHistory::create([
            "purchase_id" => $purchase->id,
            "description" => $purchase->status == "closed" ? "Pembayaran Lunas" : "Pembayaran ke-" . $count + 1,
            "payment" => $request->paid
        ]);

        return redirect("/purchases");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        DB::table("component_purchase")->where("purchase_id", $purchase->id)->delete();
        PurchaseHistory::where("purchase_id", $purchase->id)->delete();
        $purchase->delete();
        return redirect("/purchases");
    }
}
