<?php

namespace App\Http\Controllers;

use App\Exports\SaleExport;
use App\Models\Sale;
use App\Models\PaymentSale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\DeliverySale;
use App\Models\Production;
use App\Models\SaleHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Component;
use App\Models\HistoryDeliverySale;
use App\Models\ProductionSale;
use App\Models\Supplier;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sales.index', ["sales" => Sale::with("products")->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sales.create', [
            "customers" => Customer::get(),
            "products" => Product::get(),
            "components" => Component::get(),
            "suppliers" => Supplier::get(),
            "payment_sales" => PaymentSale::get(),
            "delivery_sales" => DeliverySale::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'sale_date' => $request->sale_date,
            'due_date' => $request->due_date,
            'status' => $request->total_bill - $request->paid == 0 ? "closed" : "open",
            'total_bill' => $request->total_bill,
            'paid' => $request->paid,
            "remain_bill" => $request->total_bill - $request->paid,
            "code" => $request->code
        ]);

        foreach ($request->product_id as $key => $id) {
            DB::table('product_sale')->insert([
                'product_id' => $id,
                'sale_id' => $sale->id,
                'quantity' => $request->quantity_product[$key],
            ]);

            $delivery_product = DB::table("delivery_products")->insertGetId([
                "product_id" => $id,
                "total" => $request->quantity_product[$key],
                "remain" => $request->quantity_product[$key],
            ]);

            DB::table("delivery_product_sale")->insert([
                "delivery_product_id" => $delivery_product,
                "sale_id" => $sale->id,
            ]);

            Production::where("product_id", $id)->update([
                "quantity_finished" => DB::raw("quantity_finished + 0"),
                "quantity_not_finished" => DB::raw("quantity_not_finished + " . $request->quantity_product[$key])
            ]);

            ProductionSale::create([
                "sale_id" => $sale->id,
                "production_id" => Product::find($id)->production->id,
                "quantity_finished" => 0,
                "quantity_not_finished" => $request->quantity_product[$key]
            ]);
        }

        if ($request->paid > 0) {
            SaleHistory::create([
                "sale_id" => $sale->id,
                "description" => $sale->status == "closed" ? "Pembayaran Lunas" : "Pembayaran Pertama",
                "payment" => $request->paid
            ]);
        }

        PaymentSale::create([
            "sale_id" => $sale->id,
            "method" => $request->method,
            "beneficiary_bank" => $request->beneficiary_bank,
            "beneficiary_ac_usd" => $request->beneficiary_ac_usd,
            "bank_address" => $request->bank_address,
            "swift_code" => $request->swift_code,
            "beneficiary_name" => $request->beneficiary_name,
            "beneficiary_address" => $request->beneficiary_address,
            "phone" => $request->phone,
        ]);

        DeliverySale::create([
            "sale_id" => $sale->id,
            "location" => $request->location,
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
        return view("sales.edit", ["sales" => Sale::with("products")->find($sale->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        if ($request->paid) {
            $sale->update([
                'status' => $request->remain_bill == 0 ? "closed"  : "open",
                'remain_bill' => $request->remain_bill,
                'paid' => $request->paid,
            ]);

            $count = SaleHistory::where("sale_id", $sale->id)->count();

            if ($request->paid > 0) {
                SaleHistory::create([
                    "sale_id" => $sale->id,
                    "description" => $sale->status == "closed" ? "Pembayaran Lunas" : "Pembayaran ke-" . $count + 1,
                    "payment" => $request->paid
                ]);
            }
        }

        if ($request->delivered_product) {
            foreach ($request->delivered_product as $index => $delivered) {
                DB::table("delivery_products")->where("product_id", $sale->products[$index]->id)->update([
                    "delivered" => $delivered,
                    "remain" => $request->remain_product[$index]
                ]);

                HistoryDeliverySale::create([
                    "sale_id" => $sale->id,
                    "description" => $sale->products[$index]->name . " sebanyak " . $delivered . " pcs telah dikirim",
                ]);
            }
        }

        return redirect("/sales");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        DB::table("product_sale")->where("sale_id", $sale->id)->delete();
        ProductionSale::where("sale_id", $sale->id)->delete();
        SaleHistory::where("sale_id", $sale->id)->delete();
        $sale->delete();
        return redirect("/sales");
    }

    public function print(Sale $sale)
    {
        $pdf = Pdf::loadView('sales.print', [
            "sale" => $sale
        ]);

        return $pdf->stream("quotation-sales-" . $sale->code . '.pdf');
    }

    public function export(Sale $sale)
    {
        $excel = app('excel');
        return $excel->download(new SaleExport($sale), "quotation-sales-" . $sale->code . '.xlsx');
    }
}
