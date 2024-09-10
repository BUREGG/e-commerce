<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartPositionController;
use App\Http\Controllers\InpostController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\CartPosition;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ProductController::class, 'index'])->name('welcome');
Route::get('/productdetails/{product}', [ProductController::class, 'show'])->name('product.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::put('/update/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::patch('/cart/{cartPosition}', [CartPositionController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartPosition}', [CartPositionController::class, 'destroy'])->name('cart.destroy');
    Route::get('/delivery', [InpostController::class, 'show'])->name('inpost.show');
    Route::post('/save-point', [InpostController::class, 'store'])->name('inpost.store');
    Route::get('/pay', [PayController::class, 'show'])->name('pay.show');
    Route::post('/save-order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orders', [OrderController::class, 'show'])->name('order.show');
});

require __DIR__.'/auth.php';
