<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');

Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('product.create');

Route::post('/products/save', 'App\Http\Controllers\ProductController@save')->name('product.save');

Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');

Route::get('/products/edit/{id}', 'App\Http\Controllers\ProductController@edit')->name('product.edit');

Route::put('/products/update/{id}', 'App\Http\Controllers\ProductController@update')->name('product.update');

Route::delete('/product/{id}', 'App\Http\Controllers\ProductController@destroy')->name('product.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
