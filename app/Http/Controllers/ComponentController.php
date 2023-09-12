<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Http\Requests\StorecomponentRequest;
use App\Http\Requests\UpdatecomponentRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
        return view("component.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecomponentRequest $request): RedirectResponse
    {
        Component::create([
            "name" => $request->name,
            "price_per_unit" => $request->price_per_unit,
            "unit" => $request->unit
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
        return view("component.edit", ["component" => Component::find($component->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecomponentRequest $request, component $component): RedirectResponse
    {
        $component->update([
            "name" => $request->name,
            "price_per_unit" => $request->price_per_unit,
            "unit" => $request->unit
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
