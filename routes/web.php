<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Auth\ProfileController;
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

Route::resource('product.cart', 'ProductCartController')->only(['store', 'destroy']);
Route::resource('cart', 'CartController')->only(['index']);
Route::resource('order', 'OrderController')->only(['create', 'store']);
Route::resource('order.payment', 'OrderPaymentController')->only(['create', 'store'])->middleware(['verified']);


Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/', [LandingController::class, 'index'])->name('landing');
Auth::routes([
    'verify' => true,
]);
