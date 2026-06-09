<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product', [ProductController::class, 'product']);
Route::get('/demoindex2', [ProductController::class, 'index2']);
Route::get('/admin/dashboard', function () {
return view('admin.dashboard');
})->name('admin.home');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});
