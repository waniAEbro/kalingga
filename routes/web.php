<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\FinanceController;
use App\Models\Supplier;
use App\Models\Warehouse;

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
})->middleware('login.check');

Route::get('/index', function () {
    return view('index');
})->middleware('login.check');

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('register');
// });

// Route::get('/', [LoginController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login/user', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'register']);
Route::post('/register/user', [LoginController::class, 'create']);
Route::get('/logout', [LoginController::class, 'logout']);



Route::middleware(['login.check'])->group(function () {
    Route::resource("products", ProductController::class);
    Route::resource("components", ComponentController::class);
    Route::resource("categories", CategoryController::class);
    Route::resource("sales", SaleController::class);
    Route::resource("suppliers", SupplierController::class);
    Route::resource("purchases", PurchaseController::class);
    Route::resource("productions", ProductionController::class);
    Route::resource("customers", CustomerController::class);
    Route::resource("warehouse", WarehouseController::class);
    Route::resource("finances", FinanceController::class);
    Route::get('/datatable', function () {
        return view('datatable');
    });
    Route::get('/dashboard', function () {
        return view('dashboard', ["suppliers" => Supplier::get()]);
    });
});
