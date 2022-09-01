<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return redirect('/dashboard');
});

Route::group(['prefix' => 'dashboard','middleware'=> ['auth'] ], function () {
    Route::get('/', [HomeController::class,'index'])->name('dashboard');
    Route::resource('/slider', SliderController::class);
    Route::post('/products-by-category', [ProductController::class,'productsByCategory']);
    Route::resource('/product', ProductController::class);
    Route::resource('/size', SizeController::class);
    Route::resource('/color', ColorController::class);
    Route::resource('/country', CountryController::class);
    Route::resource('/manufacturer', ManufacturerController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/discount', DiscountController::class);
    Route::resource('/stock', StockController::class);
    Route::resource('/user', UserController::class)->except('show', 'create');
    Route::post('/promotion/remove-product/{promotion}/{product}', [PromotionController::class,'removeProductFromPromotion'])->name('remove-promotion-product');
    Route::post('/promotion/filter-products', [PromotionController::class,'filterProducts']);
    Route::resource('/promotion', PromotionController::class);
    Route::post('/user/import', [UserController::class,'import'])->name('users.import');
    Route::get('/user/export', [UserController::class,'export'])->name('users.export');
    Route::get('/report', [HomeController::class,'reportindex'])->name('reports.index');
});

require __DIR__.'/auth.php';
