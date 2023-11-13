<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Component;
use App\Models\OtherCost;
use App\Models\Production;
use Illuminate\Http\Request;
use App\Models\ProductionCost;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\TemporaryFile;

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
    public function store(StoreProductRequest $request): RedirectResponse
    {
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
            "pack_id" => $pack->id,
            "productioncosts_id" => $production_costs->id,
            "othercosts_id" => $other_costs->id,
            "length" => $request->length,
            "width" => $request->width,
            "height" => $request->height,
            "sell_price" => $request->sell_price,
            "barcode" => $request->barcode,
            "hpp" => $request->hpp,
            "sell_price_usd" => $request->sell_price_usd,
            "cbm" => $request->cbm
        ]);

        Production::create([
            "product_id" => $product->id,
            "quantity_finished" => 0,
            "quantity_not_finished" => 0
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

        $tmp_file = TemporaryFile::where('folder', $request->product_image)->first();

        if($tmp_file){
            Storage::copy('products/tmp/' . $tmp_file->folder. '/' . $tmp_file->file, 'public/' . $tmp_file->folder . '/' . $tmp_file->file);
            Product::where("id", $product->id)->first()->update([
                'image' => $tmp_file->folder. '/' . $tmp_file->file
            ]);
        }

        Storage::deleteDirectory('products/tmp');
        TemporaryFile::truncate();

        return redirect("/products");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
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
    public function update(UpdateProductRequest $request, product $product): RedirectResponse
    {
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
            "sell_price_usd" => $request->sell_price_usd,
            "cbm" => $request->cbm
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

        $tmp_file = TemporaryFile::where('folder', $request->product_image)->first();

        if($tmp_file){
            Storage::deleteDirectory('public/' . substr($product->image, 0, strpos($product->image, '/')));
            Storage::copy('products/tmp/' . $tmp_file->folder. '/' . $tmp_file->file, 'public/' . $tmp_file->folder . '/' . $tmp_file->file);
            Product::where("id", $product->id)->first()->update([
                'image' => $tmp_file->folder. '/' . $tmp_file->file
            ]);
        }
        
        Storage::deleteDirectory('products/tmp');
        TemporaryFile::truncate();

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
        Production::where("product_id", $product->id)->delete();
        $product->delete();
        return redirect("/products");
    }

    public function storeapi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'unique:products|required',
            'rfid' => 'unique:products|required',
        ], [
            'code.unique' => 'Kode sudah dipakai',
            'rfid.unique' => 'RFID sudah dipakai',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

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
            "pack_id" => $pack->id,
            "productioncosts_id" => $production_costs->id,
            "othercosts_id" => $other_costs->id,
            "length" => $request->length,
            "width" => $request->width,
            "height" => $request->height,
            "sell_price" => $request->sell_price,
            "barcode" => $request->barcode,
            "hpp" => $request->hpp,
            "sell_price_usd" => $request->sell_price_usd,
            "cbm" => $request->cbm
        ]);

        Production::create([
            "product_id" => $product->id,
            "quantity_finished" => 0,
            "quantity_not_finished" => 0
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

        return response()->json(Product::get(), 200);
    }

    public function indexapi()
    {
        return response()->json(Product::get(), 200);
    }

    public function tmpUpload(Request $request)
    {
        // dd($request)
        if($request->hasFile('product_image')){
            $image = $request->file('product_image');
            $file_name = $image->getClientOriginalName();
            $folder = uniqid('product', true);
            $image->storeAs('products/tmp/' . $folder, $file_name);
            TemporaryFile::create([
                'folder' => $folder,
                'file' => $file_name
            ]);
            return $folder;
            // return $file_name;
        }
    }

    public function tmpDelete()
    {
        $tmp_file = TemporaryFile::where('folder', request()->getContent())->first();
        if($tmp_file){
            Storage::deleteDirectory('products/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
            return response('');
        }
    }
}
