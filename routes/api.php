<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SliderController;
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


Route::get('/cart-add',[CartController::class,'addToCart']);

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});
