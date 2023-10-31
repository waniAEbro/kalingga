<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\WarehouseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/stockin", [WarehouseController::class, "stockin"]);
Route::post("/stockout", [WarehouseController::class, "stockout"]);
Route::post("/product", [ProductController::class, "storeapi"]);
Route::post("/component", [ComponentController::class, "storeapi"]);
Route::post("/suppliers", [SupplierController::class, "storeapi"]);
Route::post("/customers", [CustomerController::class, "storeapi"]);
Route::get("/products", [ProductController::class, "indexapi"]);
Route::get("/customers", [CustomerController::class, "indexapi"]);
Route::get("/suppliers", [SupplierController::class, "indexapi"]);
Route::get("/components", [ComponentController::class, "indexapi"]);
