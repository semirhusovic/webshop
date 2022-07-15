<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SliderController;
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


//Route::get('/', [CategoryController::class, 'index']);
//Route::get('/category/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/', [HomeController::class, 'index']);
//Route::get('/category/{id}', [HomeController::class, 'show'])->name('categories.show');


//Route::get('/register', [CategoryController::class, 'show'])->name('categories.show');


Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth'])->name('dashboard');




Route::resource('/dashboard/slider',SliderController::class);
Route::resource('/dashboard/product',ProductController::class);
Route::resource('/dashboard/country', CountryController::class);
Route::resource('/dashboard/manufacturer', ManufacturerController::class);
Route::resource('/dashboard/category', CategoryController::class);
Route::resource('/dashboard/promotion', PromotionController::class);


require __DIR__.'/auth.php';
