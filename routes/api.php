<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductPriceController;

// Endpoints del CRUD de productos[cite: 2]
Route::apiResource('products', ProductController::class);

// Endpoints para los precios por divisa de cada producto[cite: 2]
Route::get('products/{id}/prices', [ProductPriceController::class, 'index']);
Route::post('products/{id}/prices', [ProductPriceController::class, 'store']);