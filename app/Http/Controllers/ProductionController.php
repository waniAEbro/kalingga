<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
use App\Models\SaleProduction;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Production::get());
        return view("productions.index", ["products" => Product::with("sales")->get()]);
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
    public function update(UpdateProductionRequest $request, Product $product): RedirectResponse
    {
        $request->validate([
            'quantity_finished' => 'required',
            'quantity_not_finished' => 'required',

        ], [
            'quantity_finished.required' => 'Tidak Boleh Kosong',
            'quantity_not_finished.required' => 'Tidak Boleh Kosong',

        ]);

        foreach ($request->sale_production_id as $key => $sale_production_id) {
            $quantity_finished = SaleProduction::find($sale_production_id)->quantity_finished - $request->sale_quantity_finished[$key];

            Production::where("product_id", $product->id)->update([
                "quantity_finished" => (int)$request->quantity_finished - $quantity_finished,
                "quantity_not_finished" => (int)$request->quantity_not_finished + $quantity_finished,
            ]);

            DB::table("sale_productions")->where("id", $sale_production_id)->update([
                "quantity_not_finished" => $request->sale_quantity_not_finished[$key],
                "quantity_finished" => $request->sale_quantity_finished[$key]
            ]);
        }

        if ($request->cek == "on") {
            $request->validate([
                'code' => 'required',

                'supplier_id' => 'required',
                'purchase_date' => 'required',
                'due_date' => 'required',
                'purchase_code' => 'required',
                'total_bill' => 'required',
                'paid' => 'required',

                'method' => 'required',
                "beneficiary_bank" => 'required',
                "beneficiary_ac_usd" => 'required',
                "bank_address" => 'required',
                "swift_code" => 'required',
                "beneficiary_name" => 'required',
                "beneficiary_address" => 'required',
                "phone" => 'required',

                'location' => 'required',
                'quantity_purchase' => 'required',
            ], [
                'code.required' => 'Tidak Boleh Kosong',

                'supplier_id.required' => 'Tidak Boleh Kosong',
                'purchase_date.required' => 'Tidak Boleh Kosong',
                'due_date.required' => 'Tidak Boleh Kosong',
                'purchase_code.required' => 'Tidak Boleh Kosong',
                'total_bill.required' => 'Tidak Boleh Kosong',
                'paid.required' => 'Tidak Boleh Kosong',

                'method.required' => 'Tidak Boleh Kosong',
                "beneficiary_bank.required" => 'Tidak Boleh Kosong',
                "beneficiary_ac_usd.required" => 'Tidak Boleh Kosong',
                "bank_address.required" => 'Tidak Boleh Kosong',
                "swift_code.required" => 'Tidak Boleh Kosong',
                "beneficiary_name.required" => 'Tidak Boleh Kosong',
                "beneficiary_address.required" => 'Tidak Boleh Kosong',
                "phone.required" => 'Tidak Boleh Kosong',

                'location.required' => 'Tidak Boleh Kosong',
                'quantity_purchase.required' => 'Tidak Boleh Kosong',
            ]);

            $purchase = Purchase::create([
                "supplier_id" => $request->supplier_id,
                "purchase_date" => $request->purchase_date,
                "due_date" => $request->due_date,
                "code" => $request->purchase_code,
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
                "product_id" => $product->id,
                "purchase_id" => $purchase->id,
                "quantity" => $request->quantity_purchase
            ]);
        }

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
