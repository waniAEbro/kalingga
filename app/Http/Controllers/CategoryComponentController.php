<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryComponent;
use App\Http\Requests\StoreCategoryComponentRequest;

class CategoryComponentController extends Controller
{
    public function storeApi(StoreCategoryComponentRequest $request)
    {
        CategoryComponent::create([
            "name" => $request->name
        ]);

        $category = CategoryComponent::get();

        return response()->json($category, 200);
    }
}
