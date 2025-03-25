<?php
// Nicolas, Jacobo, Miguel, Santiago
use App\Http\Controllers\AdminCustomizationController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('product.index');
    Auth::routes();
});

Route::controller(AdminProductController::class)->group(function () {
    Route::get('/admin/products', 'index')->name('admin.dash');
    Route::get('/admin/products/create', 'create')->name('product.create');
    Route::post('/admin/products/save', 'save')->name('product.save');
    Route::get('/admin/products/edit/{id}', 'edit')->name('product.edit');
    Route::put('/admin/products/update/{id}', 'update')->name('product.update');
    Route::get('/admin/product/{id}', 'destroy')->name('product.destroy');
});

Route::controller(AdminCustomizationController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.customizations.dashboard');
    Route::get('/admin/customizations/edit/{id}', 'edit')->name('admin.customizations.edit');
    Route::post('/admin/customizations/update/{id}', 'update')->name('admin.customizations.update');
    Route::get('/admin/customizations/delete/{id}', 'delete')->name('admin.customizations.delete');
    Route::get('/admin/customizations/add', 'add')->name('admin.customizations.add');
    Route::post('/admin/customizations/store', 'store')->name('admin.customizations.store');
});

Route::controller(ItemController::class)->group(function () {
    Route::post('/cart/save', 'saveItemsToDatabase')->name('item.save');
    Route::get('/product/{id}', 'show')->name('item.show');
    Route::post('/product/customize', 'applyCustomization')->name('item.apply');
    Route::post('/items', 'store')->name('items.store');
    Route::get('/items/list', 'list')->name('item.list');
    Route::delete('/items/cart/{index}', 'removeFromCart')->name('item.remove');
    Route::delete('/items/cart', 'clearCart')->name('item.clear');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('/order/checkout', 'checkout')->name('order.checkout');
});
