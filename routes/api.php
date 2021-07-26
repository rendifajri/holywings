<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PromoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get   ('/customer', [CustomerController::class, 'index']);
Route::get   ('/customer/{id}', [CustomerController::class, 'detail']);
Route::post  ('/customer', [CustomerController::class, 'create']);
Route::put   ('/customer/{id}', [CustomerController::class, 'update']);
Route::delete('/customer/{id}', [CustomerController::class, 'delete']);

Route::get   ('/item', [ItemController::class, 'index']);
Route::get   ('/item/{id}', [ItemController::class, 'detail']);
Route::post  ('/item', [ItemController::class, 'create']);
Route::put   ('/item/{id}', [ItemController::class, 'update']);
Route::delete('/item/{id}', [ItemController::class, 'delete']);

Route::get   ('/promo', [PromoController::class, 'index']);
Route::get   ('/promo/{id}', [PromoController::class, 'detail']);
Route::post  ('/promo', [PromoController::class, 'create']);
Route::put   ('/promo/{id}', [PromoController::class, 'update']);
Route::delete('/promo/{id}', [PromoController::class, 'delete']);

Route::get   ('/sales', [SalesController::class, 'index']);
Route::get   ('/sales/{id}', [SalesController::class, 'detail']);
Route::post  ('/sales', [SalesController::class, 'create']);
