<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
// 	return $request->user();
// });


Route::middleware(['auth:sanctum'])->group(function(){
	Route::get('/product-admin',[ProductController::class,'index']);

	// Show by id
	Route::get('/product-admin/{product}',[ProductController::class,'show']);

	// Create
	Route::post('/product-admin',[ProductController::class,'store']);

	// Update
	Route::patch('/product-admin/{id}',[ProductController::class,'update']);

	// Delete
	Route::delete('/product-admin/{id}',[ProductController::class,'destroy']);

	Route::get('/logout',[AuthController::class,'logout']);
	Route::get('/logtokenuserlogin',[AuthController::class,'logToken']);
});




// AUTH
Route::post('/login',[AuthController::class,'login']);

