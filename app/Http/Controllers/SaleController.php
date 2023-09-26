<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Warehouse;
use App\Models\Production;
use App\Models\SaleHistory;
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
        return view('sales.create', ["customers" => Customer::get(), "products" => Product::get(), "justArray" => ['one', 'two', 'three', 'four', 'five']]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        // dd($request->product_id, $request->quantity, $request->customer_name, $request->total_bill, $request->paid);
        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'sale_date' => $request->sale_date,
            'due_date' => $request->due_date,
            'status' => $request->total_bill - $request->paid == 0 ? "close" : "open",
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
            $productions[] = Production::create([
                "code" => $customer->code . $product->quantity . "00",
                "product_id" => $product->product_id,
                "quantity_finished" => 0,
                "quantity_not_finished" => $product->quantity,
                "total_production" => $product->quantity,
            ]);
        }

        foreach ($productions as $production) {
            DB::table("production_sale")->insert([
                "production_id" => $production->id,
                "sale_id" => $sale->id,
            ]);

            Warehouse::create([
                "production_id" => $production->id,
                "quantity" => 0
            ]);
        }

        SaleHistory::create([
            "sale_id" => $sale->id,
            "description" => $sale->status == "closed" ? "Pembayaran Lunas" : "Pembayaran Pertama",
            "payment" => $request->paid
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
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        $sale->update([
            'status' => $request->total_bill - $request->paid == 0 ? "closed"  : "open",
            'remain_bill' => $sale->remain_bill - $request->paid,
            'paid' => $request->paid,
        ]);

        $count = SaleHistory::where("sale_id", $sale->id)->count();

        SaleHistory::create([
            "sale_id" => $sale->id,
            "description" => $sale->status == "closed" ? "Pembayaran Lunas" : "Pembayaran ke-" . $count++,
            "payment" => $request->paid
        ]);

        return redirect("/sales");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect("/sales");
    }
}
