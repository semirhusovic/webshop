<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register']);

Route::get('/product/{product}',[ProductController::class,'show']);
Route::get('/product',[ProductController::class,'index']);
//Route::resource('/product',ProductController::class);

Route::get('/sliders',[SliderController::class,'index']);

Route::get('/stock/{stock}',[StockController::class,'show']);


Route::post('/cart-add',[CartController::class,'addToCart'])->middleware('auth:sanctum');
Route::post('/cart-remove',[CartController::class,'removeFromCart'])->middleware('auth:sanctum');
Route::post('/cart-delete',[CartController::class,'deleteFromCart'])->middleware('auth:sanctum');
Route::post('/get-user-cart',[CartController::class,'getUserCartProducts'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});
