<?php

use Illuminate\Support\Facades\Route;


Route::get('/items/add', 'App\Http\Controllers\ItemController@create')->name('items.add');
Route::get('/items/index', 'App\Http\Controllers\ItemController@index')->name("items.index");
Route::get('/items/{id}', 'App\Http\Controllers\ItemController@show')->name('items.show');
Route::post('/items/store', 'App\Http\Controllers\ItemController@store')->name('items.store');

Route::delete('/items/{id}', 'App\Http\Controllers\ItemController@destroy')->name('items.destroy');