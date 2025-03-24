<?php

use App\Http\Controllers\AdminCustomizationController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('product.index');
    Auth::routes();
});

// Productos - Admin
Route::controller(AdminProductController::class)->group(function () {
    Route::get('/admin/products', 'index')->name('admin.dash');
    Route::get('/admin/products/create', 'create')->name('product.create');
    Route::post('/admin/products/save', 'save')->name('product.save');
    Route::get('/admin/products/edit/{id}', 'edit')->name('product.edit');
    Route::put('/admin/products/update/{id}', 'update')->name('product.update');
    Route::get('/admin/product/{id}', 'destroy')->name('product.destroy');
});

// Customizations - Admin
Route::controller(AdminCustomizationController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.customizations.dashboard');
    Route::get('/admin/customizations/edit/{id}', 'edit')->name('admin.customizations.edit');
    Route::post('/admin/customizations/update/{id}', 'update')->name('admin.customizations.update');
    Route::get('/admin/customizations/delete/{id}', 'delete')->name('admin.customizations.delete');
    Route::get('/admin/customizations/add', 'add')->name('admin.customizations.add');
    Route::post('/admin/customizations/store', 'store')->name('admin.customizations.store');
});

// Estas son las de item (Nico)
Route::get('/product/{id}', [ItemController::class, 'show'])->name('item.show');
Route::post('/product/customize', [ItemController::class, 'applyCustomization'])->name('item.apply');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::get('/items/list', [ItemController::class, 'list'])->name('item.list');
Route::delete('/items/cart/{index}', [ItemController::class, 'removeFromCart'])->name('item.remove');
Route::delete('/items/cart', [ItemController::class, 'clearCart'])->name('item.clear');

//Order
Route::get('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
