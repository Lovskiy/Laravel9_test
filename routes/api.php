<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('signup', [AuthController::class, 'create']);
Route::post('login', [AuthController::class, 'login']);

Route::get('products', [ProductController::class, 'store']);



Route::group(['middleware' => ['ApiAuth', 'ApiClient']], function () {
    Route::post('cart/{id}', [CartController::class, 'addCart']);
    Route::get('cart', [CartController::class, 'showCart']);
    Route::delete('cart/{id}', [CartController::class, 'destroyCart']);
//    Route::get('logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['ApiAuth', 'ApiAdmin']], function () {
    Route::post('product', [ProductController::class, 'createdProduct']);
    Route::delete('product/{id}', [ProductController::class, 'productDestroy']);
    Route::patch('product/{id}', [ProductController::class, 'productEdit']);
});
