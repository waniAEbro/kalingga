<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Component;
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
        return view("component.index", ["components" => Component::get()]);
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
            "supplier_id" => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'price_per_unit.required' => 'Harga tidak boleh kosong',
            'unit.required' => 'Satuan unit tidak boleh kosong',
            "supplier_id.required" => 'Supplier tidak boleh kosong'
        ]);

        Component::create([
            "name" => $request->name,
            "price_per_unit" => $request->price_per_unit,
            "unit" => $request->unit,
            "supplier_id" => $request->supplier_id
        ]);

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
            "supplier_id" => "required"
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'price_per_unit.required' => 'Harga tidak boleh kosong',
            'unit.required' => 'Satuan unit tidak boleh kosong',
            "supplier_id.required" => 'Supplier tidak boleh kosong'
        ]);

        $component->update([
            "name" => $request->name,
            "price_per_unit" => $request->price_per_unit,
            "unit" => $request->unit,
            "supplier_id" => $request->supplier_id
        ]);

        return redirect("/components");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(component $component): RedirectResponse
    {
        $component->delete();
        return redirect("/components");
    }
}
