<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("warehouse.index", ["warehouses" => Warehouse::all(), "products" => Product::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function stockin(Request $request)
    {
        if ($request->input("m2m:sgn") && array_key_exists("m2m:vrq", $request->input("m2m:sgn"))) {
            return response()->json("ok", 200);
        } else {
            $tag = array_slice(explode(" ", json_decode($request->input("m2m:sgn")["m2m:nev"]["m2m:rep"]["m2m:cin"]["con"], true)["uhf"]), 5, 12);

            $uid = array_slice($tag, 0, 1);

            $index = implode("", array_slice($tag, 1));

            $warehouses = Warehouse::where("tag", $uid[0])->where("tag_id", $index)->get();

            if ($warehouses->count() > 0) {
                return response()->json("ok", 200);
            } else {
                $product = Product::where("rfid", $uid[0])->first();

                $warehouse = Warehouse::create([
                    "tag_id" => $index,
                    "tag" => $uid[0],
                    "product_id" => $product->id
                ]);

                return response()->json($warehouse, 200);
            }
        }
    }

    public function stockout(Request $request)
    {
        if ($request->input("m2m:sgn") && array_key_exists("m2m:vrq", $request->input("m2m:sgn"))) {
            return response()->json("ok", 200);
        } else {
            $tag = array_slice(explode(" ", json_decode($request->input("m2m:sgn")["m2m:nev"]["m2m:rep"]["m2m:cin"]["con"], true)["uhf"]), 5, 12);

            $index = implode("", array_slice($tag, 1));

            $warehouse = Warehouse::where("tag_id", $index)->delete();

            return response()->json($warehouse, 200);
        }
    }
}
