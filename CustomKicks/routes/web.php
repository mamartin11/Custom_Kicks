<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::controller(App\Http\Controllers\ProductController::class)->group(function () {
    Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
    Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('product.create');
    Route::post('/products/save', 'App\Http\Controllers\ProductController@save')->name('product.save');
    Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');
    Route::get('/products/edit/{id}', 'App\Http\Controllers\ProductController@edit')->name('product.edit');
    Route::put('/products/update/{id}', 'App\Http\Controllers\ProductController@update')->name('product.update');
    Route::delete('/product/{id}', 'App\Http\Controllers\ProductController@destroy')->name('product.destroy');
    Auth::routes();
});

Route::controller(App\Http\Controllers\CustomizationController::class)->group(function () {
    Route::get('/customizations/select', 'select')->name('customizations.select');
    Route::post('/customizations/apply', 'applyCustomization')->name('customizations.apply');
});

Route::controller(App\Http\Controllers\AdminCustomizationController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.customizations.dashboard');
    Route::get('/admin/customizations/edit/{id}', 'edit')->name('admin.customizations.edit');
    Route::post('/admin/customizations/update/{id}', 'update')->name('admin.customizations.update');
    Route::get('/admin/customizations/delete/{id}', 'delete')->name('admin.customizations.delete');
    Route::get('/admin/customizations/add', 'add')->name('admin.customizations.add');
    Route::post('/admin/customizations/store', 'store')->name('admin.customizations.store');
});

Route::get('/items/add', 'App\Http\Controllers\ItemController@create')->name('items.add');
Route::get('/items/index', 'App\Http\Controllers\ItemController@index')->name("items.index");
Route::get('/items/{id}', 'App\Http\Controllers\ItemController@show')->name('items.show');
Route::post('/items/store', 'App\Http\Controllers\ItemController@store')->name('items.store');
