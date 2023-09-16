<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Component;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Models\Pack;
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
        // dd($request->components);
        $pack = Pack::create([
            "cost" => $request->pack_cost,
            "outer_length" => $request->pack_outer_length,
            "outer_width" => $request->pack_outer_width,
            "outer_height" => $request->pack_outer_height,
            "inner_length" => $request->pack_inner_length,
            "inner_width" => $request->pack_inner_width,
            "inner_height" => $request->pack_inner_height
        ]);

        $product = Product::create([
            "name" => $request->name,
            "code" => $request->code,
            "rfid" => $request->rfid,
            "logo" => $request->logo,
            "other_cost" => $request->other_cost,
            "production_cost" => $request->production_cost,
            "pack_id" => $pack->id,
            "length" => $request->length,
            "width" => $request->width,
            "height" => $request->height,
            "sell_price" => $request->sell_price
        ]);

        foreach ($request->components as $index => $component) {
            DB::table("component_product")->insert([
                "product_id" => $product->id,
                "component_id" => $component,
                "quantity" => $request->quantities[$index]
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
        return view("products.edit", ["product" => Product::find($product->id), "components" => Component::get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproductRequest $request, product $product): RedirectResponse
    {
        $pack = Pack::where("id", $product->pack_id)->update([
            "cost" => $request->pack_cost,
            "outer_length" => $request->pack_outer_length,
            "outer_width" => $request->pack_outer_width,
            "outer_height" => $request->pack_outer_height,
            "inner_length" => $request->pack_inner_length,
            "inner_width" => $request->pack_inner_width,
            "inner_height" => $request->pack_inner_height
        ]);
        $product->update([
            "name" => $request->name,
            "code" => $request->code,
            "rfid" => $request->rfid,
            "logo" => $request->logo,
            "other_cost" => $request->other_cost,
            "production_cost" => $request->production_cost,
            "pack_id" => $pack->id,
            "length" => $request->length,
            "width" => $request->width,
            "height" => $request->height,
            "sell_price" => $request->sell_price
        ]);
        foreach ($request->components as $index => $component) {
            DB::table("component_product")->insert([
                "product_id" => $product->id,
                "component_id" => $component,
                "quantity" => $request->quantities[$index]
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
