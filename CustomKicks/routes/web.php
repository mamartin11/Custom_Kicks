<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\AdminCustomizationController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(CustomizationController::class)->group(function () {
    Route::get('/customizations/select', 'select')->name('customizations.select');
    Route::post('/customizations/apply', 'applyCustomization')->name('customizations.apply');
});

Route::controller(AdminCustomizationController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.customizations.dashboard');
    Route::get('/admin/customizations/edit/{id}', 'edit')->name('admin.customizations.edit');
    Route::post('/admin/customizations/update/{id}', 'update')->name('admin.customizations.update');
    Route::get('/admin/customizations/delete/{id}', 'delete')->name('admin.customizations.delete');
    Route::get('/admin/customizations/add', 'add')->name('admin.customizations.add');
    Route::post('/admin/customizations/store', 'store')->name('admin.customizations.store');
});

