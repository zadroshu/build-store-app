<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::get('getProducts', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('getProduct/{id}', [App\Http\Controllers\ProductController::class, 'show']);
Route::get('getProductByName/{name}', [App\Http\Controllers\ProductController::class, 'searchByName']);
Route::get('searchByCategory/{id}', [App\Http\Controllers\ProductController::class, 'searchByCategory']);
Route::get('sortProducts/{categoryId}/{sortId}', [App\Http\Controllers\ProductController::class, 'sort']);
Route::post('deleteProduct/{id}', [App\Http\Controllers\ProductController::class, 'delete']);


Route::get('getCart', [App\Http\Controllers\ProductController::class, 'getCart']);
Route::post('addToCart/{id}', [App\Http\Controllers\ProductController::class, 'addToCart']);

Route::get('getCategories', [App\Http\Controllers\CategoryController::class, 'getCategories']);
Route::get('getCategory/{id}', [App\Http\Controllers\CategoryController::class, 'show']);

Route::post('createOrder', [App\Http\Controllers\OrderController::class, 'create']);