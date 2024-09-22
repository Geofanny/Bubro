<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
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
	return redirect('/product-admin');
});

// ROUTE ADMIN

//  PRODUCT
Route::get('/product-admin',[ProductController::class,'viewIndex']);
Route::get('/product-insert',[ProductController::class,'viewInsert']);
Route::post('/newProduct',[ProductController::class,'insert']);
Route::get('/product-edit/{id}',[ProductController::class,'edit']);
Route::post('/updateProduct/{id}', [ProductController::class,'updateProduct']);
Route::delete('/product-delete/{id}', [ProductController::class, 'deleteProduct']);

// CATEGORY
Route::get('/category-admin',[CategoryController::class,'index']);
Route::get('/category-insert',[CategoryController::class,'create']);
Route::post('/newCategory',[CategoryController::class,'store']);
Route::get('/category-edit/{id}',[CategoryController::class,'edit']);
Route::post('/category-update/{id}',[CategoryController::class,'update']);
Route::delete('/category-delete/{id}',[CategoryController::class,'destroy']);

