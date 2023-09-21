<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Http\Requests\StoreProductionRequest;
use App\Http\Requests\UpdateProductionRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(Production::get());
        return view("productions.index", ["productions" => Production::get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("productions.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductionRequest $request): RedirectResponse
    {
        Production::create([
            "product_id" => $request->product_id,
            "quantity_finished" => $request->quantity_finished,
            "quantity_not_finished" => $request->quantity_not_finished,
            "total_product" => $request->total_product,
        ]);

        return redirect("/productions");
    }

    /**
     * Display the specified resource.
     */
    public function show(Production $production): View
    {
        return view("productions.show", ["productions" => Production::find($production->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Production $production): View
    {
        return view("productions.edit", ["production" => Production::find($production->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductionRequest $request, Production $production): RedirectResponse
    {
        $production->update([
            "quantity_finished" => $request->quantity_finished,
            "quantity_not_finished" => $request->quantity_not_finished,
        ]);

        return redirect("/productions");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Production $production)
    {
        $production->delete();

        return redirect("/productions");
    }
}
