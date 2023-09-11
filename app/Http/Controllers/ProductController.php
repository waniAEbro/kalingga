<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Component;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
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
        return view("products.create", ["categories" => Category::get(), "components" => Component::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreproductRequest $request): RedirectResponse
    {
        $product = Product::create([
            "name" => $request->name,
            "code" => $request->code,
            "rfid" => $request->rfid,
            "category_id" => $request->category_id,
        ]);

        foreach ($request->components as $component) {
            DB::table("product_component")->insert([
                "product_id" => $product->id,
                "component_id" => $component,
                "quantity" => $request->quantities[$component] ?? "1"
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
        return view("products.edit", ["product" => Product::find($product->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproductRequest $request, product $product): RedirectResponse
    {
        $product->update([
            "name" => $request->name,
            "code" => $request->code,
            "rfid" => $request->rfid,
            "category_id" => $request->category_id
        ]);

        foreach ($request->components as $component) {
            DB::table("product_component")->insert([
                "product_id" => $product->id,
                "component_id" => $component,
                "quantity" => $request->quantities[$component] ?? "1"
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
