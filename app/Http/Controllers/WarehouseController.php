<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view("warehouse.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $warehouse = Warehouse::create([
            "production_id" => $request->input("production_id"),
            "quantity" => $request->input("quantity"),
        ]);

        return response()->json($warehouse, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse) :View
    {
        return view("warehouse.show", ["warehouse" => Warehouse::find($warehouse->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        //return view("warehouse.edit", ["warehouse" => Warehouse::find($warehouse->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $warehouse->update([
            "production_id" => $request->input("production_id"),
            "quantity" => $request->input("quantity"),
        ]);

        return response()->json($warehouse, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect("/warehouse");
    }
}
