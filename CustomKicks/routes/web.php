<?php

// Nicolas, Jacobo, Miguel, Santiago
use App\Http\Controllers\Admin\AdminCustomizationController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::middleware(['App\Http\Middleware\Locale'])->group(function () {
    Auth::routes();

    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/toggle-language', 'App\Http\Controllers\LangController@switchLanguage')->name('toggle.language');
    Route::get('/lang/{locale}', 'App\Http\Controllers\LangController@switchLanguage')->name('lang.switch');

    // Product Routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('product.index');
        Route::get('/products/{id}', 'show')->name('product.show');
    });

    // Cart Routes
    Route::controller(CartController::class)->group(function () {
        Route::post('/cart/add', 'addToCart')->name('cart.add');
        Route::get('/cart', 'listItems')->name('cart.list');
        Route::delete('/cart/{index}', 'removeFromCart')->name('cart.remove');
        Route::delete('/cart', 'clearCart')->name('cart.clear');
    });

    // Order Routes
    Route::controller(OrderController::class)->group(function () {
        Route::get('/order/checkout', 'checkout')->name('order.checkout');
        Route::get('/my-orders', 'myOrders')->name('order.my-orders');
        Route::post('/order/update-discount', 'updateDiscount')->name('order.update-discount');
    });

    // Admin Routes
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['auth'])
        ->group(function () {
            // Admin Product Routes
            Route::controller(AdminProductController::class)->group(function () {
                Route::get('/products', 'index')->name('products.dashboard');
                Route::get('/products/create', 'create')->name('products.create');
                Route::post('/products/save', 'save')->name('products.save');
                Route::get('/products/edit/{id}', 'edit')->name('products.edit');
                Route::put('/products/update/{id}', 'update')->name('products.update');
                Route::get('/product/{id}', 'destroy')->name('products.destroy');
            });

            // Admin Customization Routes
            Route::controller(AdminCustomizationController::class)->group(function () {
                Route::get('/', 'index')->name('customizations.dashboard');
                Route::get('/customizations/edit/{id}', 'edit')->name('customizations.edit');
                Route::post('/customizations/update/{id}', 'update')->name('customizations.update');
                Route::get('/customizations/delete/{id}', 'delete')->name('customizations.delete');
                Route::get('/customizations/add', 'add')->name('customizations.add');
                Route::post('/customizations/store', 'store')->name('customizations.store');
            });
        });

});
