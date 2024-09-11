<?php

use App\Http\Controllers\api\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/products', 'product.index');
Route::get('/', [ProductController::class, 'index'])->name('product.index');
