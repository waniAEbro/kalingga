<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Component;
use App\Models\ComponentSupplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use App\Models\CategoryComponent;

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
        return view("component.create", ["suppliers" => Supplier::get(), "categories" => CategoryComponent::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComponentRequest $request): RedirectResponse
    {
        $component = Component::create([
            "name" => $request->name,
            "price_per_unit" => $request->price_per_unit,
            "unit" => $request->unit,
            "category_component_id" => $request->category_id
        ]);

        if ($request->supplier_id) {
            $request->validate([
                'supplier_id.*' => 'required',
                'price_supplier.*' => 'required'
            ]);
            foreach ($request->supplier_id as $index => $supplier) {
                DB::table("component_supplier")->insert([
                    "component_id" => $component->id,
                    "supplier_id" => $supplier,
                    "price_per_unit" => $request->price_supplier[$index]
                ]);
            }
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
        return view("component.edit", ["componentedit" => Component::find($component->id), "suppliers" => Supplier::get(), "categories" => CategoryComponent::get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComponentRequest $request, component $component): RedirectResponse
    {
        $component->update([
            "name" => $request->name,
            "price_per_unit" => $request->price_per_unit,
            "unit" => $request->unit,
            "category_component_id" => $request->category_id
        ]);

        if ($request->supplier_id) {
            $request->validate([
                'supplier_id.*' => 'required',
                'price_supplier.*' => 'required'
            ]);

            DB::table("component_supplier")->where("component_id", $component->id)->delete();

            foreach ($request->supplier_id as $index => $supplier) {
                DB::table("component_supplier")->insert([
                    "component_id" => $component->id,
                    "supplier_id" => $supplier,
                    "price_per_unit" => $request->price_supplier[$index]
                ]);
            }
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

    public function storeapi(StoreComponentRequest $request)
    {
        $component = Component::create([
            "name" => $request->name,
            "price_per_unit" => $request->price_per_unit,
            "unit" => $request->unit,
            "category_component_id" => $request->category_id
        ]);

        if ($request->supplier_id) {
            $request->validate([
                'supplier_id.*' => 'required',
                'price_supplier.*' => 'required'
            ]);

            foreach ($request->supplier_id as $index => $supplier) {
                DB::table("component_supplier")->insert([
                    "component_id" => $component->id,
                    "supplier_id" => $supplier,
                    "price_per_unit" => $request->price_supplier[$index]
                ]);
            }
        }

        return response()->json(Component::get(), 200);
    }
}
