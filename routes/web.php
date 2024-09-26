<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
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

// DASHBOARD
Route::get('/dashboard-admin',[DashboardController::class,'index']);

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

// GALLERY
Route::get('/gallery-admin',[GalleryController::class,'index']);
Route::get('/gallery-insert',[GalleryController::class,'create']);
Route::post('/newGallery',[GalleryController::class,'store']);
Route::get('/gallery-edit/{id}',[GalleryController::class,'edit']);
Route::post('/gallery-update/{id}',[GalleryController::class,'update']);
Route::delete('/gallery-delete/{id}',[GalleryController::class,'destroy']);

// EVENT
Route::get('/event-admin',[EventController::class,'index']);
Route::get('/event-insert',[EventController::class,'create']);
Route::post('/newEvent',[EventController::class,'store']);
Route::get('/event-edit/{id}',[EventController::class,'edit']);
Route::post('/event-update/{id}',[EventController::class,'update']);
Route::delete('/event-delete/{id}',[EventController::class,'destroy']);
