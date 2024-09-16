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
	return redirect('/product-admin');
});

// ROUTE ADMIN
Route::get('/product-admin',[ProductController::class,'viewIndex']);
Route::get('/product-insert',[ProductController::class,'viewInsert']);
Route::post('/newProduct',[ProductController::class,'insert']);