<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::get('/products',[ProductController::class,'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products',[ProductController::class,'store']);
    Route::post('/orders',[OrderController::class,'store']);
    Route::get('/orders',[OrderController::class,'index']);
});
