<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("warehouse.index", ["products" => Product::all()]);
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

                if ($product) {
                    $warehouse = Warehouse::create([
                        "tag_id" => $index,
                        "tag" => $uid[0],
                        "product_id" => $product->id
                    ]);

                    Http::withHeaders([
                        'Content-Type' => 'application/json'
                    ])->withBasicAuth(env("VITE_ABLY_PUBLIC_KEY"), env("VITE_ABLY_SECRET_KEY"))
                        ->post('https://rest.ably.io/channels/channel-in/messages', [
                            'name' => 'publish',
                            'data' => $product->name . " berhasil masuk ke gudang"
                        ]);

                    return response()->json($warehouse, 200);
                } else {
                    return response()->json("not found", 404);
                }
            }
        }
    }

    public function stockout(Request $request)
    {
        if ($request->input("m2m:sgn") && array_key_exists("m2m:vrq", $request->input("m2m:sgn"))) {
            return response()->json("ok", 200);
        } else {
            $tag = array_slice(explode(" ", json_decode($request->input("m2m:sgn")["m2m:nev"]["m2m:rep"]["m2m:cin"]["con"], true)["uhf"]), 5, 12);

            $uid = array_slice($tag, 0, 1);

            $index = implode("", array_slice($tag, 1));

            $warehouse = Warehouse::where("tag", $uid[0])->where("tag_id", $index)->delete();

            $product = Product::where("rfid", $uid[0])->first();

            Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->withBasicAuth(env("VITE_ABLY_PUBLIC_KEY"), env("VITE_ABLY_SECRET_KEY"))
                ->post('https://rest.ably.io/channels/channel-out/messages', [
                    'name' => 'publish',
                    'data' => $product->name . " berhasil keluar dari gudang"
                ]);

            return response()->json($warehouse, 200);
        }
    }
}
