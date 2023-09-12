<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
    return view('welcome');
});

Route::resource("products", ProductController::class);
Route::resource("components", ProductController::class);
Route::resource("categories", ProductController::class);
Route::resource("sales", ProductController::class);
Route::resource("suppliers", ProductController::class);
Route::resource("puchases", ProductController::class);
Route::resource("productions", ProductController::class);
Route::resource("customers", ProductController::class);
