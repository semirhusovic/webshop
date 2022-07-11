<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ProductController;
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


Route::get('/', [CategoryController::class, 'index']);
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('categories.show');


//Route::get('/register', [CategoryController::class, 'show'])->name('categories.show');


Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth'])->name('dashboard');




Route::resource('/slider',SliderController::class);
Route::resource('/product',ProductController::class);
Route::resource('/country', CountryController::class);
Route::resource('/manufacturer', ManufacturerController::class);


require __DIR__.'/auth.php';
