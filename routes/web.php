<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/stock',   [StockController::class, 'index'])->name('stock');
    Route::get('/stock/create',  [StockController::class, 'create'])->name('stock.create');
    Route::post('/stock/store',  [StockController::class, 'store'])->name( 'stock.store');

    
    // Route::resource('purchases', PurchaseController::class);
    Route::get('/purchase',    [PurchaseController::class, 'index'])->name('purchase');
    Route::get('/purchase/create',    [PurchaseController::class, 'create'])->name('purchase.create');
    Route::post('/purchase/store',  [PurchaseController::class, 'store'])->name( 'purchase.store');
    Route::post('/purchases/calculate', [PurchaseController::class, 'calculate'])->name('purchase.calculate');
});



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
