<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Component;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Models\OtherCost;
use App\Models\Pack;
use App\Models\ProductionCost;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("products.index", ["products" => Product::get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("products.create", ["components" => Component::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreproductRequest $request): RedirectResponse
    {
        $pack = Pack::create([
            //"cost" => $request->pack_cost,
            "outer_length" => $request->pack_outer_length,
            "outer_width" => $request->pack_outer_width,
            "outer_height" => $request->pack_outer_height,
            "inner_length" => $request->pack_inner_length,
            "inner_width" => $request->pack_inner_width,
            "inner_height" => $request->pack_inner_height,
            "nw" => $request->pack_nw,
            "gw" => $request->pack_gw,
            "box_price" => $request->pack_box_price,
            "box_hardware" => $request->pack_box_hardware,
            "assembling" => $request->pack_assembling,
            "stiker" => $request->pack_stiker,
            "hagtag" => $request->pack_hagtag,
            "maintenance" => $request->pack_maintenance,
        ]);

        $production_costs = ProductionCost::create([
            "total_production" => $request->total_production,
            "price_perakitan" => $request->price_perakitan,
            "price_perakitan_prj" => $request->price_perakitan_prj,
            "price_grendo" => $request->price_grendo,
            "price_obat" => $request->price_obat,
            "upah" => $request->upah,
        ]);

        $other_costs = OtherCost::create([
            "biaya_overhead_pabrik" => $request->biaya_overhead_pabrik,
            "biaya_listrik" => $request->biaya_listrik,
            "biaya_pajak" => $request->biaya_pajak,
            "biaya_ekspor" => $request->biaya_ekspor,
            "total" => $request->total,
        ]);

        $product = Product::create([
            "name" => $request->name,
            "code" => $request->code,
            "rfid" => $request->rfid,
            "logo" => $request->logo,
            "other_cost" => $request->other_cost,
            "production_cost" => $request->production_cost,
            "pack_id" => $pack->id,
            "productioncosts_id" => $production_costs->id,
            "othercosts_id" => $other_costs->id,
            "length" => $request->length,
            "width" => $request->width,
            "height" => $request->height,
            "sell_price" => $request->sell_price,
            "barcode" => $request->barcode,
        ]);

        foreach ($request->component_id as $index => $component) {
            DB::table("component_product")->insert([
                "product_id" => $product->id,
                "component_id" => $component,
                "quantity" => $request->quantity[$index]
            ]);
        }
        return redirect("/products");
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product): View
    {
        return view("products.show", ["product" => Product::find($product->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product): View
    {
        return view("products.edit", ["product" => $product, "components" => Component::get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproductRequest $request, product $product): RedirectResponse
    {
        $pack = Pack::where("id", $product->pack_id)->first();
        $production_costs = ProductionCost::where("id", $product->productioncost_id)->first();
        $other_costs = OtherCost::where("id", $product->othercosts_id)->first();

        $pack->update([
            //"cost" => $request->pack_cost,
            "outer_length" => $request->pack_outer_length,
            "outer_width" => $request->pack_outer_width,
            "outer_height" => $request->pack_outer_height,
            "inner_length" => $request->pack_inner_length,
            "inner_width" => $request->pack_inner_width,
            "inner_height" => $request->pack_inner_height,
            "nw" => $request->pack_nw,
            "gw" => $request->pack_gw,
            "box_price" => $request->pack_box_price,
            "box_hardware" => $request->pack_box_hardware,
            "assembling" => $request->pack_assembling,
            "stiker" => $request->pack_stiker,
            "hagtag" => $request->pack_hagtag,
            "maintenance" => $request->pack_maintenance,
        ]);

        $production_costs->update([
            "total_production" => $request->total_production,
            "price_perakitan" => $request->price_perakitan,
            "price_perakitan_prj" => $request->price_perakitan_prj,
            "price_grendo" => $request->price_grendo,
            "price_obat" => $request->price_obat,
            "upah" => $request->upah,
        ]);

        $other_costs->update([
            "biaya_overhead_pabrik" => $request->biaya_overhead_pabrik,
            "biaya_listrik" => $request->biaya_listrik,
            "biaya_pajak" => $request->biaya_pajak,
            "biaya_ekspor" => $request->biaya_ekspor,
            "total" => $request->total,
        ]);

        $product->update([
            "name" => $request->name,
            "code" => $request->code,
            "rfid" => $request->rfid,
            "logo" => $request->logo,
            "other_cost" => $request->other_cost,
            "production_cost" => $request->production_cost,
            "productioncosts_id" => $production_costs->id,
            "othercosts_id" => $other_costs->id,
            "pack_id" => $pack->id,
            "length" => $request->length,
            "width" => $request->width,
            "height" => $request->height,
            "sell_price" => $request->sell_price
        ]);

        DB::table("component_product")->where("product_id", $product->id)->delete();

        foreach ($request->component_id as $index => $component) {
            DB::table("component_product")->insert([
                "product_id" => $product->id,
                "component_id" => $component,
                "quantity" => $request->quantity[$index]
            ]);
        }
        return redirect("/products");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product): RedirectResponse
    {
        $product->delete();
        return redirect("/products");
    }
}
