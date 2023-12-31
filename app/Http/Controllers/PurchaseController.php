<?php

namespace App\Http\Controllers;

use App\Exports\PurchaseExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePurchaseAPI;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\CategoryComponent;
use App\Models\Component;
use App\Models\DeliveryPurchase;
use App\Models\HistoryDeliveryPurchase;
use App\Models\PaymentPurchase;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseHistory;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

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
            "delivery_purchases" => DeliveryPurchase::get(),
            "categories" => CategoryComponent::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request): RedirectResponse
    {
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
            'status' => $request->total_bill - $request->paid == 0 ? "closed" : "open",
            'remain_bill' => $request->total_bill - $request->paid,
            'total_bill' => $request->total_bill,
            'paid' => $request->paid,
            "code" => $request->code,
        ]);

        if ($request->component_id) {
            foreach ($request->component_id as $index => $id) {
                DB::table("component_purchase")->insert([
                    "component_id" => $id,
                    "purchase_id" => $purchase->id,
                    "quantity" => $request->quantity[$index],
                ]);

                $delivery_component = DB::table("delivery_components")->insertGetId([
                    "component_id" => $id,
                    "total" => $request->quantity[$index],
                    "remain" => $request->quantity[$index],
                ]);

                DB::table("delivery_component_purchase")->insert([
                    "delivery_component_id" => $delivery_component,
                    "purchase_id" => $purchase->id,
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

                $delivery_product = DB::table("delivery_products")->insertGetId([
                    "product_id" => $id,
                    "total" => $request->quantity_product[$index],
                    "remain" => $request->quantity_product[$index],
                ]);

                DB::table("delivery_product_purchase")->insert([
                    "delivery_product_id" => $delivery_product,
                    "purchase_id" => $purchase->id,
                ]);
            }
        }

        if ($request->paid > 0) {
            PurchaseHistory::create([
                "purchase_id" => $purchase->id,
                "description" => $purchase->status == "closed" ? "Pembayaran Lunas" : "Pembayaran Pertama",
                "payment" => $request->paid,
            ]);
        }

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
        // dd($request);
        if ($request->delivered_component) {
            foreach ($request->delivered_component as $index => $delivered) {
                if ($delivered > 0 && $delivered != $request->old_delivered_component[$index]) {
                    DB::table("delivery_components")->where("component_id", $purchase->components[$index]->id)->update([
                        "delivered" => $delivered,
                        "remain" => $request->remain_component[$index],
                    ]);
                    HistoryDeliveryPurchase::create([
                        "purchase_id" => $purchase->id,
                        "description" => $purchase->components[$index]->name . " sebanyak " . str_replace(".", ",", $delivered - $request->old_delivered_component[$index]) . " " . $purchase->components[$index]->unit . " telah diterima",
                    ]);
                }

            }
        }
        if ($request->delivered_product) {
            foreach ($request->delivered_product as $index => $delivered) {
                if ($delivered > 0 && $delivered != $request->old_delivered_product[$index]) {
                    DB::table("delivery_products")->where("product_id", $purchase->products[$index]->id)->update([
                        "delivered" => $delivered,
                        "remain" => $request->remain_product[$index],
                    ]);

                    HistoryDeliveryPurchase::create([
                        "purchase_id" => $purchase->id,
                        "description" => $purchase->products[$index]->name . " sebanyak " . $delivered - $request->old_delivered_product[$index] . " " . $purchase->products[$index]->unit . " telah diterima",
                    ]);
                }

            }
        }
        if ($request->paid) {
            $purchase->update([
                'status' => $request->remain_bill == 0 ? "closed" : "open",
                'remain_bill' => $request->remain_bill,
                'paid' => $purchase->paid + $request->paid,
            ]);

            $count = PurchaseHistory::where("purchase_id", $purchase->id)->count();

            if ($request->paid > 0) {
                PurchaseHistory::create([
                    "purchase_id" => $purchase->id,
                    "description" => $purchase->status == "closed" ? "Pembayaran Lunas" : "Pembayaran ke-" . $count + 1,
                    "payment" => $request->paid,
                ]);
            }
        }

        return redirect("/purchases");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        DB::table("component_purchase")->where("purchase_id", $purchase->id)->delete();
        PurchaseHistory::where("purchase_id", $purchase->id)->delete();
        HistoryDeliveryPurchase::where("purchase_id", $purchase->id)->delete();
        $purchase->delete();
        return redirect("/purchases");
    }

    public function print(Purchase $purchase)
    {
        $pdf = Pdf::loadView('purchases.print', [
            "purchase" => $purchase,
        ]);

        return $pdf->stream("quotation-purchases-" . $purchase->code . '.pdf');
    }

    public function export(Purchase $purchase)
    {
        $excel = app('excel');
        return $excel->download(new PurchaseExport($purchase), "quotation-purchases-" . $purchase->code . '.xlsx');
    }

    public function storeapi(StorePurchaseAPI $request)
    {
        $purchase = Purchase::create([
            'supplier_id' => $request->supplier_id,
            'purchase_date' => $request->purchase_date,
            'due_date' => $request->due_date,
            'status' => $request->total_bill - $request->paid == 0 ? "closed" : "open",
            'remain_bill' => $request->total_bill - $request->paid,
            'total_bill' => $request->total_bill,
            'paid' => $request->paid,
            "code" => $request->code,
        ]);

        DB::table("product_purchase")->insert([
            "product_id" => $request->product_id,
            "purchase_id" => $purchase->id,
            "quantity" => $request->quantity_purchase,
        ]);

        PurchaseHistory::create([
            "purchase_id" => $purchase->id,
            "description" => $purchase->status == "closed" ? "Pembayaran Lunas" : "Pembayaran Pertama",
            "payment" => $request->paid,
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

        $product = Product::find($request->product_id);

        $product->production->update([
            "quantity_not_finished" => DB::raw("quantity_not_finished - " . $request->quantity_purchase),
        ]);

        $product->production->saleProductions->find($request->sale_production_id)->update([
            "quantity_not_finished" => DB::raw("quantity_not_finished - " . $request->quantity_purchase),
        ]);

        $product = Product::find($request->product_id);

        return response()->json($product);
    }
}
