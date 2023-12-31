<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("suppliers.index", ["suppliers" => Supplier::get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("suppliers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request): RedirectResponse
    {
        Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            "code" => $request->code
        ]);

        return redirect("/suppliers");
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view("suppliers.show", ["suppliers" => Supplier::find($supplier->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view("suppliers.edit", ["suppliers" => Supplier::find($supplier->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            "code" => $request->code
        ]);

        return redirect("/suppliers");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        DB::table("component_supplier")->where("supplier_id", $supplier->id)->delete();
        DB::table("product_supplier")->where("supplier_id", $supplier->id)->delete();
        return redirect("/suppliers");
    }

    public function storeapi(StoreSupplierRequest $request)
    {
        Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            "code" => $request->code
        ]);

        return response()->json(Supplier::get(), 200);
    }
}
