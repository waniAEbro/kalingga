<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("categories.index", ["categories" => Category::get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecategoryRequest $request): RedirectResponse
    {
        Category::create([
            "name" => $request->name
        ]);
        return redirect("/categories");
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category): View
    {
        return view("categories.show", ["category" => Category::find($category->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category): View
    {
        return view("categories.edit", ["category" => Category::find($category->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecategoryRequest $request, category $category): RedirectResponse
    {
        $category->update([
            "name" => $request->name
        ]);
        return redirect("/categories");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category): RedirectResponse
    {
        $category->delete();
        return redirect("/categories");
    }
}
