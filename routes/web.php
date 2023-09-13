<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Route::resource("products", ProductController::class);
Route::resource("components", ComponentController::class);
Route::resource("categories", CategoryController::class);
Route::resource("sales", SaleController::class);
Route::resource("suppliers", SupplierController::class);
Route::resource("purchases", PurchaseController::class);
Route::resource("productions", ProductionController::class);
Route::resource("customers", CustomerController::class);
