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
        return view('sales.create', [
            "customers" => Customer::get(),
            "products" => Product::get(),
            "justArray" => ['one', 'two', 'three', 'four', 'five'],
            "payment_sales" => PaymentSale::get(),
            "delivery_sales" => DeliverySale::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        // dd($request);
        // dd($request->product_id, $request->quantity, $request->customer_name, $request->total_bill, $request->paid);
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
            'paid.required' => 'Bayar tidak boleh kosong'
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

        $products = [];

        foreach ($request->product_id as $key => $id) {
            $id = DB::table('product_sale')->insertGetId([
                'product_id' => $id,
                'sale_id' => $sale->id,
                'quantity' => $request->quantity[$key],
            ]);

            $products[] = DB::table('product_sale')->find($id);
        }

        $customer = Customer::find($request->customer_id);

        $productions = [];

        foreach ($products as $product) {
            $production_count = DB::table("productions")->join("sales", "productions.sale_id", "=", "sales.id")->where("sales.customer_id", $request->customer_id)->select("productions.*")->count();
            $productions[] = Production::create([
                "code" => $customer->code . $production_count + 1 . "-" . $product->quantity . "-" . "00",
                "product_id" => $product->product_id,
                "sale_id" => $sale->id,
                "quantity_finished" => 0,
                "quantity_not_finished" => $product->quantity,
                "total_quantity" => $product->quantity,
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
        return view("sales.edit", ["sales" => Sale::find($sale->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale, PaymentSale $payment, DeliverySale $delivery)
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

        $payment->update([
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

        $delivery->update([
            "sale_id" => $sale->id,
            "location" => $request->location,
        ]);

        return redirect("/sales");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        DB::table("product_sale")->where("sale_id", $sale->id)->delete();
        $productions = Production::where("sale_id", $sale->id)->delete();
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
