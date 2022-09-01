<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\OrderController;
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

Route::get('/product/{product}', [ProductController::class,'show']);
Route::get('/product', [ProductController::class,'index']);

Route::get('/sliders', [SliderController::class,'index']);

Route::get('/category', [CategoryController::class,'index']);

Route::get('/stock/{product}/{size}', [StockController::class,'StockItemColors']);
Route::get('/stock/{product}/', [StockController::class,'show']);

Route::post('/payment/create', [PaymentController::class,'create']);
Route::post('/order/create', [OrderController::class,'create'])->middleware('auth:sanctum');
Route::post('/order/{order}', [OrderController::class,'updateOrderStatus']);
Route::get('/order', [OrderController::class,'index'])->middleware('auth:sanctum');

Route::post('/cart-add/{cart}/{stock}', [CartController::class,'addToCart'])->middleware('auth:sanctum');
Route::post('/cart-remove/{cart}/{stock}', [CartController::class,'removeFromCart'])->middleware('auth:sanctum');
Route::post('/cart-delete/{cart}/{stock}', [CartController::class,'deleteFromCart'])->middleware('auth:sanctum');
Route::get('/get-user-cart/{cart}', [CartController::class,'getUserCartProducts'])->middleware('auth:sanctum');

Route::get('/pdf/{invoice}', [InvoiceController::class,'downloadPdf']);

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});
