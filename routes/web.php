<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
});

require __DIR__.'/auth.php';
