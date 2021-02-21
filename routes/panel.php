<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\ProductController;
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

Route::get('/', 'PanelController@index')->name('panel');
Route::prefix('products')->group(function() {
    Route::get('/create', function() {
        return view('products.ProductForm');
    })->name('product.create.form');;
    Route::post('/create', [ProductController::class, 'store'])->name('product.create');
    Route::get('/', [ProductController::class, 'index'])->name('product');
    Route::get('/{product}', [ProductController::class, 'show'])->name('product.detail');
    Route::put('/{product}/edit', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/{product}/delete', [ProductController::class, 'destroy'])->name('product.destroy');
});
