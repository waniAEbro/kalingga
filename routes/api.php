<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\CategoryComponentController;

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

Route::post("/employeein", [PresenceController::class, "employee_in"]);
Route::post("/employeeout", [PresenceController::class, "employee_out"]);

Route::post("/product", [ProductController::class, "storeapi"]);
Route::post("/component", [ComponentController::class, "storeapi"]);
Route::post("/suppliers", [SupplierController::class, "storeapi"]);
Route::post("/customers", [CustomerController::class, "storeapi"]);

Route::post("/purchase", [PurchaseController::class, "storeapi"]);

Route::post("/categories", [CategoryComponentController::class, "storeapi"]);
