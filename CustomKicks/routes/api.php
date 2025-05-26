<?php

use App\Http\Controllers\ProductApiController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductApiController::class, 'index']);
