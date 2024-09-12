<?php

use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// PRODUCTS
// Route::get('/products', 'product.index');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');


// ORDERS
// Route::get('/order', [OrderController::class, 'create'])->name('order.create');
