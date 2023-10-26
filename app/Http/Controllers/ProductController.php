<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Component;
use App\Models\OtherCost;
use App\Models\ProductionCost;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;

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
        return view("products.create", ["components" => Component::get(), "suppliers" => Supplier::get(), 'products' => Product::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreproductRequest $request): RedirectResponse
    {
        $request->validate([
            'component_id.*' => 'required',
            'quantity.*' => 'required',
            "supplier_id.*" => 'required',
            "price_supplier.*" => 'required',

            'name' => 'required',
            'code' => 'required',
            'rfid' => 'required',
            'logo' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'sell_price' => 'required',
            'barcode' => 'required',

            'pack_inner_length' => 'required',
            'pack_inner_height' => 'required',
            'pack_inner_width' => 'required',
            'pack_outer_length' => 'required',
            'pack_outer_height' => 'required',
            'pack_outer_width' => 'required',
            'pack_nw' => 'required',
            'pack_gw' => 'required',

            'price_perakitan' => 'required',
            'price_perakitan_prj' => 'required',
            'price_grendo' => 'required',
            'price_obat' => 'required',
            'upah' => 'required',

            'pack_box_price' => 'required',
            'pack_box_hardware' => 'required',
            'pack_assembling' => 'required',
            'pack_stiker' => 'required',
            'pack_hagtag' => 'required',
            'pack_maintenance' => 'required',

            'biaya_overhead_pabrik' => 'required',
            'biaya_listrik' => 'required',
            'biaya_pajak' => 'required',
            'biaya_ekspor' => 'required',
        ], [
            'component_id.*.required' => 'Komponen harus dipilih',
            'quantity.*.required' => 'Jumlah harus diisi',

            'name.required' => 'Nama harus diisi',
            'code.required' => 'Kode harus diisi',
            'rfid.required' => 'RFID harus diisi',
            'logo.required' => 'Logo harus diisi',
            'length.required' => 'Panjang harus diisi',
            'width.required' => 'Lebar harus diisi',
            'height.required' => 'Tinggi harus diisi',
            'sell_price.required' => 'Harga jual harus diisi',
            'barcode.required' => 'Barcode harus diisi',

            'pack_outer_length.required' => 'Panjang luar harus diisi',
            'pack_outer_width.required' => 'Lebar luar harus diisi',
            'pack_outer_heigth.required' => 'Tinggi luar harus diisi',
            'pack_inner_length.required' => 'Panjang dalam harus diisi',
            'pack_inner_width.required' => 'Lebar dalam harus diisi',
            'pack_inner_height.required' => 'Tinggi dalam harus diisi',
            'pack_nw.required' => 'NW harus diisi',
            'pack_gw.required' => 'GW harus diisi',

            'pack_box_price.required' => 'Harga box harus diisi',
            'pack_box_hardware.required' => 'Hardware box harus diisi',
            'pack_assembling.required' => 'Assembling harus diisi',
            'pack_stiker.required' => 'Stiker harus diisi',
            'pack_hagtag.required' => 'Hagtag harus diisi',
            'pack_maintenance.required' => 'Maintenance harus diisi',

            'price_perakitan.required' => 'Harga perakitan harus diisi',
            'price_perakitan_prj.required' => 'Harga perakitan prj harus diisi',
            'price_grendo.required' => 'Harga grendo harus diisi',
            'price_obat.required' => 'Harga obat harus diisi',
            'upah.required' => 'Upah harus diisi',

            'biaya_overhead_pabrik.required' => 'Biaya overhead pabrik harus diisi',
            'biaya_listrik.required' => 'Biaya listrik harus diisi',
            'biaya_pajak.required' => 'Biaya pajak harus diisi',
            'biaya_ekspor.required' => 'Biaya ekspor harus diisi',

            "supplier_id.*.required" => "Supplier harus dipilih",
            "price_supplier.*.required" => "Harga supplier harus diisi",
        ]);

        $pack = Pack::create([
            "cost" => $request->pack_cost,
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
            "total" => $request->pack_cost,
        ]);

        $production_costs = ProductionCost::create([
            "total_production" => $request->total_production,
            "price_perakitan" => $request->price_perakitan,
            "price_perakitan_prj" => $request->price_perakitan_prj,
            "price_grendo" => $request->price_grendo,
            "price_obat" => $request->price_obat,
            "upah" => $request->upah,
            "total" => $request->total_production,
        ]);

        $other_costs = OtherCost::create([
            "biaya_overhead_pabrik" => $request->biaya_overhead_pabrik,
            "biaya_listrik" => $request->biaya_listrik,
            "biaya_pajak" => $request->biaya_pajak,
            "biaya_ekspor" => $request->biaya_ekspor,
            "total" => $request->total_other_cost,
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
            "hpp" => $request->hpp,
        ]);

        foreach ($request->component_id as $index => $component) {
            DB::table("component_product")->insert([
                "product_id" => $product->id,
                "component_id" => $component,
                "quantity" => $request->quantity[$index]
            ]);
        }

        foreach ($request->supplier_id as $index => $supplier) {
            DB::table("product_supplier")->insert([
                "product_id" => $product->id,
                "supplier_id" => $supplier,
                "price_per_unit" => $request->price_supplier[$index]
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
        return view("products.edit", ["product" => Product::find($product->id), "components" => Component::get(), "suppliers" => Supplier::get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproductRequest $request, product $product): RedirectResponse
    {
        //dd($request);
        $request->validate([
            'component_id.*' => 'required',
            'quantity.*' => 'required',
            "supplier_id.*" => 'required',
            "price_supplier.*" => 'required',

            'name' => 'required',
            'code' => 'required',
            'rfid' => 'required',
            'logo' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'sell_price' => 'required',
            'barcode' => 'required',

            'pack_inner_length' => 'required',
            'pack_inner_height' => 'required',
            'pack_inner_width' => 'required',
            'pack_outer_length' => 'required',
            'pack_outer_height' => 'required',
            'pack_outer_width' => 'required',
            'pack_nw' => 'required',
            'pack_gw' => 'required',

            'price_perakitan' => 'required',
            'price_perakitan_prj' => 'required',
            'price_grendo' => 'required',
            'price_obat' => 'required',
            'upah' => 'required',

            'pack_box_price' => 'required',
            'pack_box_hardware' => 'required',
            'pack_assembling' => 'required',
            'pack_stiker' => 'required',
            'pack_hagtag' => 'required',
            'pack_maintenance' => 'required',

            'biaya_overhead_pabrik' => 'required',
            'biaya_listrik' => 'required',
            'biaya_pajak' => 'required',
            'biaya_ekspor' => 'required',
        ], [
            'component_id.*.required' => 'Komponen harus dipilih',
            'quantity.*.required' => 'Jumlah harus diisi',
            "supplier_id.*.required" => "Supplier harus dipilih",
            "price_supplier.*.required" => "Harga supplier harus diisi",

            'name.required' => 'Nama harus diisi',
            'code.required' => 'Kode harus diisi',
            'rfid.required' => 'RFID harus diisi',
            'logo.required' => 'Logo harus diisi',
            'length.required' => 'Panjang harus diisi',
            'width.required' => 'Lebar harus diisi',
            'height.required' => 'Tinggi harus diisi',
            'sell_price.required' => 'Harga jual harus diisi',
            'barcode.required' => 'Barcode harus diisi',

            'pack_outer_length.required' => 'Panjang luar harus diisi',
            'pack_outer_width.required' => 'Lebar luar harus diisi',
            'pack_outer_heigth.required' => 'Tinggi luar harus diisi',
            'pack_inner_length.required' => 'Panjang dalam harus diisi',
            'pack_inner_width.required' => 'Lebar dalam harus diisi',
            'pack_inner_height.required' => 'Tinggi dalam harus diisi',
            'pack_nw.required' => 'NW harus diisi',
            'pack_gw.required' => 'GW harus diisi',

            'pack_box_price.required' => 'Harga box harus diisi',
            'pack_box_hardware.required' => 'Hardware box harus diisi',
            'pack_assembling.required' => 'Assembling harus diisi',
            'pack_stiker.required' => 'Stiker harus diisi',
            'pack_hagtag.required' => 'Hagtag harus diisi',
            'pack_maintenance.required' => 'Maintenance harus diisi',

            'price_perakitan.required' => 'Harga perakitan harus diisi',
            'price_perakitan_prj.required' => 'Harga perakitan prj harus diisi',
            'price_grendo.required' => 'Harga grendo harus diisi',
            'price_obat.required' => 'Harga obat harus diisi',
            'upah.required' => 'Upah harus diisi',

            'biaya_overhead_pabrik.required' => 'Biaya overhead pabrik harus diisi',
            'biaya_listrik.required' => 'Biaya listrik harus diisi',
            'biaya_pajak.required' => 'Biaya pajak harus diisi',
            'biaya_ekspor.required' => 'Biaya ekspor harus diisi',

        ]);

        $pack = Pack::where("id", $product->pack_id)->first();
        $production_costs = ProductionCost::where("id", $product->productioncosts_id)->first();
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
            "total" => $request->pack_cost,
        ]);

        $production_costs->update([
            "total_production" => $request->total_production,
            "price_perakitan" => $request->price_perakitan,
            "price_perakitan_prj" => $request->price_perakitan_prj,
            "price_grendo" => $request->price_grendo,
            "price_obat" => $request->price_obat,
            "upah" => $request->upah,
            "total" => $request->total_production,
        ]);

        $other_costs->update([
            "biaya_overhead_pabrik" => $request->biaya_overhead_pabrik,
            "biaya_listrik" => $request->biaya_listrik,
            "biaya_pajak" => $request->biaya_pajak,
            "biaya_ekspor" => $request->biaya_ekspor,
            "total" => $request->total_other_cost,
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
            "sell_price" => $request->sell_price,
            "hpp" => $request->hpp,
        ]);

        DB::table("component_product")->where("product_id", $product->id)->delete();

        foreach ($request->component_id as $index => $component) {
            DB::table("component_product")->insert([
                "product_id" => $product->id,
                "component_id" => $component,
                "quantity" => $request->quantity[$index]
            ]);
        }

        DB::table("product_supplier")->where("product_id", $product->id)->delete();
        foreach ($request->supplier_id as $index => $supplier) {
            DB::table("product_supplier")->insert([
                "product_id" => $product->id,
                "supplier_id" => $supplier,
                "price_per_unit" => $request->price_supplier[$index]
            ]);
        }

        return redirect("/products");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product): RedirectResponse
    {
        DB::table("component_product")->where("product_id", $product->id)->delete();
        DB::table("product_supplier")->where("product_id", $product->id)->delete();
        Pack::where("id", $product->pack_id)->delete();
        ProductionCost::where("id", $product->productioncosts_id)->delete();
        OtherCost::where("id", $product->othercosts_id)->delete();
        $product->delete();
        return redirect("/products");
    }
}
