<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product', [ProductController::class, 'product']);
Route::get('/demoindex2', [ProductController::class, 'index2']);
Route::get('/admin/dashboard', function () {
return view('admin.dashboard');
})->name('admin.home');
