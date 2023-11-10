<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Component;
use App\Models\PaymentPurchase;
use App\Models\PurchaseHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DeliveryPurchase;
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
        return view('purchases.create', [
            "suppliers" => Supplier::get(),
            "components" => Component::get(),
            "products" => Product::get(),
            "payment_purchases" => PaymentPurchase::get(),
            "delivery_purchases" => DeliveryPurchase::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request): RedirectResponse
    {
        // dd($request->all());
        if ($request->component_id) {
            $request->validate(['component_id.*' => 'required', 'quantity.*' => 'required']);
        }

        if ($request->product_id) {
            $request->validate(['product_id.*' => 'required', 'quantity_product.*' => 'required']);
        }

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

        if ($request->component_id) {
            foreach ($request->component_id as $index => $id) {
                DB::table("component_purchase")->insert([
                    "component_id" => $id,
                    "purchase_id" => $purchase->id,
                    "quantity" => $request->quantity[$index],
                ]);
            }
        }

        if ($request->product_id) {
            foreach ($request->product_id as $index => $id) {
                DB::table("product_purchase")->insert([
                    "product_id" => $id,
                    "purchase_id" => $purchase->id,
                    "quantity" => $request->quantity_product[$index],
                ]);
            }
        }

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
            "products" => Product::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
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

    public function print(Purchase $purchase)
    {
        $pdf = Pdf::loadView('purchases.print', [
            "purchase" => $purchase
        ]);

        return $pdf->stream('quotation.pdf');
    }
}
