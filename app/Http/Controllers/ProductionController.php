<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Production;
use App\Models\PaymentPurchase;
use App\Models\PurchaseHistory;
use App\Models\DeliveryPurchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreProductionRequest;
use App\Http\Requests\UpdateProductionRequest;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Production::get());
        return view("productions.index", ["productions" => Production::get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view("productions.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductionRequest $request)
    {
        // Production::create([
        //     "product_id" => $request->product_id,
        //     "quantity_finished" => $request->quantity_finished,
        //     "quantity_not_finished" => $request->quantity_not_finished,
        //     "total_product" => $request->total_product,
        // ]);

        // return redirect("/productions");
    }

    /**
     * Display the specified resource.
     */
    public function show(Production $production): View
    {
        return view("productions.show", ["productions" => Production::find($production->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Production $production): View
    {
        return view("productions.edit", ["production" => $production]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductionRequest $request, Production $production): RedirectResponse
    {
        $production->update([
            "quantity_finished" => $request->quantity_finished,
            "quantity_not_finished" => $request->quantity_not_finished,
            "total_quantity" => $request->total_production,
            "code" => implode("-", array_slice(explode("-", $production->code), 0, -2)) . "-" .  $request->quantity_not_finished . "-" . $request->quantity_finished,
        ]);

        $purchase = Purchase::create([
            "supplier_id" => $request->supplier_id,
            "purchase_date" => $request->purchase_date,
            "due_date" => $request->due_date,
            "code" => $request->code,
            "remain_bill" => $request->total_bill - $request->paid,
            "total_bill" => $request->total_bill,
            "paid" => $request->paid,
            "status" => $request->total_bill - $request->paid == 0 ? "closed"  : "open",
        ]);

        PurchaseHistory::create([
            "purchase_id" => $purchase->id,
            "description" => $purchase->status == "closed" ? "Pembayaran Lunas" : "Pembayaran Pertama",
            "payment" => $request->paid
        ]);

        PaymentPurchase::create([
            "purchase_id" => $purchase->id,
            "method" => $request->method,
            "beneficiary_bank" => $request->beneficiary_bank,
            "beneficiary_ac_usd" => $request->beneficiary_ac_usd,
            "bank_address" => $request->bank_address,
            "swift_code" => $request->swift_code,
            "beneficiary_name" => $request->beneficiary_name,
            "beneficiary_address" => $request->beneficiary_address,
            "phone" => $request->phone,
        ]);

        DeliveryPurchase::create([
            "purchase_id" => $purchase->id,
            "location" => $request->location,
        ]);

        DB::table("product_purchase")->insert([
            "product_id" => $production->product_id,
            "purchase_id" => $purchase->id,
            "quantity" => $request->quantity_purchase
        ]);

        return redirect("/productions");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Production $production)
    {
        $production->delete();

        return redirect("/productions");
    }
}
