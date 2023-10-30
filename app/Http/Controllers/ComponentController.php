<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Component;
use Illuminate\Http\Request;
use App\Models\ComponentSupplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorecomponentRequest;
use App\Http\Requests\UpdatecomponentRequest;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("component.index", ["components" => Component::get(), 'component_supplier' => ComponentSupplier::get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("component.create", ["suppliers" => Supplier::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecomponentRequest $request): RedirectResponse
    {
        // dd($request->selectfield);

        $request->validate([
            'name' => 'required',
            'price_per_unit' => 'required',
            'unit' => 'required',
            'supplier_id.*' => 'required',
            'price_supplier.*' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'price_per_unit.required' => 'Harga tidak boleh kosong',
            'unit.required' => 'Satuan unit tidak boleh kosong',
            'supplier_id.*.required' => 'Supplier tidak boleh kosong',
            'price_supplier.*.required' => 'Harga supplier tidak boleh kosong'
        ]);

        $component = Component::create([
            "name" => $request->name,
            "price_per_unit" => $request->price_per_unit,
            "unit" => $request->unit
        ]);

        foreach ($request->supplier_id as $index => $supplier) {
            DB::table("component_supplier")->insert([
                "component_id" => $component->id,
                "supplier_id" => $supplier,
                "price_per_unit" => $request->price_supplier[$index]
            ]);
        }

        return redirect("/components");
    }

    /**
     * Display the specified resource.
     */
    public function show(component $component): View
    {
        return view("component.show", ["component" => Component::find($component->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(component $component): View
    {
        return view("component.edit", ["componentedit" => Component::find($component->id), "suppliers" => Supplier::get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecomponentRequest $request, component $component): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price_per_unit' => 'required',
            'unit' => 'required',
            'supplier_id.*' => 'required',
            'price_supplier.*' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'price_per_unit.required' => 'Harga tidak boleh kosong',
            'unit.required' => 'Satuan unit tidak boleh kosong',
            'supplier_id.*.required' => 'Supplier tidak boleh kosong',
            'price_supplier.*.required' => 'Harga supplier tidak boleh kosong'
        ]);

        $component->update([
            "name" => $request->name,
            "price_per_unit" => $request->price_per_unit,
            "unit" => $request->unit
        ]);

        DB::table("component_supplier")->where("component_id", $component->id)->delete();

        foreach ($request->supplier_id as $index => $supplier) {
            DB::table("component_supplier")->insert([
                "component_id" => $component->id,
                "supplier_id" => $supplier,
                "price_per_unit" => $request->price_supplier[$index]
            ]);
        }

        return redirect("/components");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(component $component): RedirectResponse
    {
        DB::table("component_product")->where("component_id", $component->id)->delete();
        DB::table("component_supplier")->where("component_id", $component->id)->delete();
        $component->delete();
        return redirect("/components");
    }

    public function storeapi(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price_per_unit' => 'required',
            'unit' => 'required',
            'supplier_id.*' => 'required',
            'price_supplier.*' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'price_per_unit.required' => 'Harga tidak boleh kosong',
            'unit.required' => 'Satuan unit tidak boleh kosong',
            'supplier_id.*.required' => 'Supplier tidak boleh kosong',
            'price_supplier.*.required' => 'Harga supplier tidak boleh kosong'
        ]);

        $component = Component::create([
            "name" => $request->name,
            "price_per_unit" => $request->price_per_unit,
            "unit" => $request->unit
        ]);

        foreach ($request->supplier_id as $index => $supplier) {
            DB::table("component_supplier")->insert([
                "component_id" => $component->id,
                "supplier_id" => $supplier,
                "price_per_unit" => $request->price_supplier[$index]
            ]);
        }

        return response()->json($request->all(), 200);
    }
}
