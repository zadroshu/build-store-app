<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('getCategories', [App\Http\Controllers\CategoryController::class, 'getCategories']);
Route::get('getAllCategories', [App\Http\Controllers\CategoryController::class, 'getAllCategories']);
Route::get('getCategory/{id}', [App\Http\Controllers\CategoryController::class, 'show']);

Route::post('createOrder', [App\Http\Controllers\OrderController::class, 'create']);

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('deleteProduct/{id}', [App\Http\Controllers\ProductController::class, 'delete']);
    Route::post('updateProduct', [App\Http\Controllers\ProductController::class, 'update']);
    Route::post('createProduct', [App\Http\Controllers\ProductController::class, 'create']);

    Route::get('getOrders', [App\Http\Controllers\OrderController::class, 'getOrders']);
    Route::post('deleteOrder/{id}', [App\Http\Controllers\OrderController::class, 'delete']);
    Route::post('updateOrder', [App\Http\Controllers\OrderController::class, 'update']);


    Route::post('createCategory', [App\Http\Controllers\CategoryController::class, 'create']);
    Route::post('updateCategory', [App\Http\Controllers\CategoryController::class, 'update']);
    Route::post('deleteCategory/{id}', [App\Http\Controllers\CategoryController::class, 'delete']);
    
    Route::get('getAdmins', [App\Http\Controllers\UserController::class, 'getAdmins']);
    Route::get('getAdmin/{id}', [App\Http\Controllers\UserController::class, 'show']);
    Route::get('getAdminByEmail/{email}', [App\Http\Controllers\UserController::class, 'showByEmail']);
    Route::post('createAdmin', [App\Http\Controllers\UserController::class, 'create']);
    Route::post('updateAdmin', [App\Http\Controllers\UserController::class, 'update']);
    Route::post('deleteAdmin/{id}', [App\Http\Controllers\UserController::class, 'delete']);

    Route::post('xmlParse', [App\Http\Controllers\XMLController::class, 'parseXML']);


});

