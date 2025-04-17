<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Shop\Http\Controllers\ProductController;
use Modules\Shop\Http\Controllers\CartController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/category/{categorySlug}', [ProductController::class, 'category'])->name('products.category');
Route::get('/tag/{tagSlug}', [ProductController::class, 'tag'])->name('products.tag');
Route::get('/{categorySlug}/{productSlug}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['auth'])->group(function() {

    Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
    Route::get('/carts/{id}/remove', [CartController::class, 'destroy'])->name('carts.destroy');
    Route::post('/carts', [CartController::class, 'store'])->name('carts.store');
    Route::put('/carts', [CartController::class, 'update'])->name('carts.update');
});

Route::prefix('shop')->group(function() {
    Route::get('/', 'ShopController@index');
});
