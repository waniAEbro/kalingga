<?php

use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\RoleController;

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
Route::post('/register/user', [LoginController::class, 'register_user']);
Route::get('/logout', [LoginController::class, 'logout']);



Route::middleware(['login.check'])->group(function () {
    Route::resource("products", ProductController::class);
    Route::get("/products/production/{product}/edit", [ProductionController::class, "edit"]);
    Route::put("/products/production/{product}", [ProductionController::class, "update"]);
    Route::resource("components", ComponentController::class);
    Route::resource("sales", SaleController::class);
    Route::resource("suppliers", SupplierController::class);
    Route::resource("purchases", PurchaseController::class);
    Route::resource("productions", ProductionController::class);
    Route::resource("customers", CustomerController::class);
    Route::resource("warehouse", WarehouseController::class);
    Route::resource("finances", FinanceController::class);
    Route::resource("users", LoginController::class);
    Route::resource("roles", RoleController::class);

    Route::get("/quotations", [QuotationController::class, "index"]);

    Route::get("/sales/{sale}/print", [SaleController::class, "print"]);
    Route::get("/purchases/{purchase}/print", [PurchaseController::class, "print"]);

    Route::get('/datatable', function () {
        return view('datatable');
    });

    Route::get('/dashboard', function () {
        return view('dashboard', ["salesNotDone" => Sale::where("status", "open")->get(), "sales" => Sale::get(), "purchases" => Purchase::get()]);
    });

    Route::get('/users', [LoginController::class, 'index_user']);
});
