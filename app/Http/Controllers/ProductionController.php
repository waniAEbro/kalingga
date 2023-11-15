<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Production;
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
    public function edit(Product $product): View
    {
        return view("productions.edit", ["product" => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductionRequest $request, Product $product): RedirectResponse
    {
        Production::where("product_id", $product->id)->update([
            "quantity_finished" => $request->quantity_finished,
            "quantity_not_finished" => $request->quantity_not_finished,
        ]);
        foreach ($request->sale_production_id as $key => $sale_production_id) {
            DB::table("sale_production")->where("id", $sale_production_id)->update([
                "quantity_not_finished" => $request->sale_quantity_not_finished[$key],
                "quantity_finished" => $request->sale_quantity_finished[$key]
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
