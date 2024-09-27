<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EventController;

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

	// PRODUCT
	Route::get('/product-admin',[ProductController::class,'index']);
	// Show by id
	Route::get('/product-admin/{product}',[ProductController::class,'show']);
	// Create
	Route::post('/product-admin',[ProductController::class,'store']);
	// Update
	Route::patch('/product-admin/{id}',[ProductController::class,'update']);
	// Delete
	Route::delete('/product-admin/{id}',[ProductController::class,'destroy']);

	// GALLERY
	Route::get('/gallery-admin',[GalleryController::class,'getAll']);
	Route::post('/gallery-admin',[GalleryController::class,'insert']);
	Route::get('/gallery-admin/{id}',[GalleryController::class,'show']);
	Route::patch('/gallery-admin/{id}',[GalleryController::class,'updateGallery']);
	Route::delete('/gallery-admin/{id}',[GalleryController::class,'delete']);

	// EVENT
	Route::get('/event-admin',[EventController::class,'getAll']);
	Route::post('/event-admin',[EventController::class,'insert']);
	Route::get('/event-admin/{id}',[EventController::class,'show']);
	Route::patch('/event-admin/{id}',[EventController::class,'updateEvent']);
	Route::delete('/event-admin/{id}',[EventController::class,'delete']);

	// AUTHENTICATION
	Route::get('/logout',[AuthController::class,'logout']);
	Route::get('/logtokenuserlogin',[AuthController::class,'logToken']);
});

// AUTH
Route::post('/login',[AuthController::class,'login']);

Route::get('/product-admin2',[ProductController::class,'index']);