<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\ProductController;
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

// Home route

Route::get('/', [HomeController::class, 'index'])->name('home');

// Products route

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::post('/new', [ProductController::class, 'new'])->name('new');
    Route::post('/delete', [ProductController::class, 'delete'])->name('delete');
});
