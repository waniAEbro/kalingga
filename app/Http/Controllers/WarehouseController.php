<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Casts\Json;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("warehouse.index", ["warehouse" => Warehouse::get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function stockin(Request $request)
    {
        // $production = DB::table("productions")->join("products", "productions.product_id", "products.id")->where("products.rfid", json_decode($request->input("m2m:sgn")["m2m:nev"]["m2m:rep"]["m2m:cin"]["con"], true)["tag"])->first();

        // $warehouse = Warehouse::where("production_id", $production->product_id)->first();

        // $warehouse->update([
        //     "product_id" => $production->product_id,
        //     "quantity" => $warehouse->quantity + 1,
        // ]);

        $warehouse = Supplier::create([
            "name" => "name",
            "address" => json_decode($request->input("m2m:sgn")["m2m:nev"]["m2m:rep"]["m2m:cin"]["con"], true)["tag"],
            "phone" => "098",
            "email" => "wer@mail.com",
            "code" => "asd"
        ]);

        return response()->json($warehouse, 200);
    }

    public function stockout(Request $request)
    {
        $production = DB::table("productions")->join("products", "productions.product_id", "products.id")->where("products.rfid", json_decode($request->input("m2m:sgn")["m2m:nev"]["m2m:rep"]["m2m:cin"]["con"], true)["tag"])->first();

        $warehouse = Warehouse::where("production_id", $production->product_id)->first();

        $warehouse->update([
            "product_id" => $production->product_id,
            "quantity" => $warehouse->quantity - 1,
        ]);

        return response()->json($warehouse, 200);
    }
}
