<?php

namespace App\Http\Controllers;

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
use App\Models\SaleProduction;

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
            "payment_sales" => PaymentSale::get(),
            "delivery_sales" => DeliverySale::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'sale_date' => 'required',
            'due_date' => 'required',
            'code' => 'required',
            'paid' => 'required',
            "method" => "required",
            "beneficiary_bank" => "required",
            "beneficiary_ac_usd" => "required",
            "bank_address" => "required",
            "swift_code" => "required",
            "beneficiary_name" => "required",
            "beneficiary_address" => "required",
            "phone" => "required",
            "location" => "required",
            "product_id.*" => "required",
            "quantity.*" => "required",
        ], [
            'customer_id.required' => 'ID Customer tidak boleh kosong',
            'sale_date.required' => 'Tanggal Pembelian tidak boleh kosong',
            'due_date.required' => 'Tanggal Jatuh Tempo tidak boleh kosong',
            'code.required' => 'Kode tidak boleh kosong',
            'paid.required' => 'Bayar tidak boleh kosong',
            'product_id.*.required' => 'Produk tidak boleh kosong',
            'quantity.*.required' => 'Jumlah tidak boleh kosong'
        ]);

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
                'quantity' => $request->quantity[$key],
            ]);

            Production::where("product_id", $id)->update([
                "quantity_finished" => 0,
                "quantity_not_finished" => DB::raw("quantity_not_finished + " . $request->quantity[$key])
            ]);

            SaleProduction::create([
                "sale_id" => $sale->id,
                "production_id" => Product::find($id)->production->id,
                "quantity_finished" => 0,
                "quantity_not_finished" => $request->quantity[$key]
            ]);
        }

        SaleHistory::create([
            "sale_id" => $sale->id,
            "description" => $sale->status == "closed" ? "Pembayaran Lunas" : "Pembayaran Pertama",
            "payment" => $request->paid
        ]);

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
        $request->validate([
            'paid' => 'required',
        ], [
            'paid.required' => 'Paid tidak boleh kosong',
        ]);

        $sale->update([
            'status' => $request->remain_bill == 0 ? "closed"  : "open",
            'remain_bill' => $request->remain_bill,
            'paid' => $request->paid,
        ]);

        $count = SaleHistory::where("sale_id", $sale->id)->count();

        SaleHistory::create([
            "sale_id" => $sale->id,
            "description" => $sale->status == "closed" ? "Pembayaran Lunas" : "Pembayaran ke-" . $count + 1,
            "payment" => $request->paid
        ]);

        return redirect("/sales");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        DB::table("product_sale")->where("sale_id", $sale->id)->delete();
        SaleProduction::where("sale_id", $sale->id)->delete();
        SaleHistory::where("sale_id", $sale->id)->delete();
        $sale->delete();
        return redirect("/sales");
    }

    public function print(Sale $sale)
    {
        $pdf = Pdf::loadView('sales.print', [
            "sale" => $sale
        ]);

        return $pdf->stream('quotation.pdf');
    }
}
