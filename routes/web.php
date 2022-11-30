<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 
// Route::any('{any}', function () {
//     return redirect()->back();
// });
Route::post("/product-add", [ProductController::class,"store_product"]);
Route::post("/product-update", [ProductController::class,"update_product"]);
Route::post("/img", [ProductController::class,"img"])->name("img");
Route::post("/fetchimg", [ProductController::class,"fetchImg"])->name("fetchimg");
Route::get("/", [ProductController::class,"index"]);
Route::get("/product-remove/{id}{product_number}", [ProductController::class,"product_delete"]);
Route::get("/delete", [ProductController::class,"delete_permanently"]);
