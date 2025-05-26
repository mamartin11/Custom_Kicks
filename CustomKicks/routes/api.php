<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\ShippingController;

Route::get('/products', [ProductApiController::class, 'index']);

Route::prefix('shipping')->group(function () {
    Route::post('/calculate-cost', [ShippingController::class, 'calculateCost']);
    Route::post('/process', [ShippingController::class, 'processShipping']);
});
