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
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\OrderTrackingController;

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
    });

    // Rutas de seguimiento de pedidos
    Route::get('/order-tracking', [ShippingController::class, 'showTracking'])->name('order.tracking');
    Route::get('/api/orders/{orderId}/tracking', [ShippingController::class, 'getTrackingInfo']);

    // Admin Routes
        Route::middleware(['auth', 'App\Http\Middleware\Admin'])->group(function () {
            // Admin Product Routes
            Route::controller(AdminProductController::class)->group(function () {
                Route::get('/admin/products', 'index')->name('admin.products.dashboard');
                Route::get('/admin/products/create', 'create')->name('admin.products.create');
                Route::post('/admin/products/save', 'save')->name('admin.products.save');
                Route::get('/admin/products/edit/{id}', 'edit')->name('admin.products.edit');
                Route::put('/admin/products/update/{id}', 'update')->name('admin.products.update');
                Route::get('/admin/product/{id}', 'destroy')->name('admin.products.destroy');
            });

            // Admin Customization Routes
            Route::controller(AdminCustomizationController::class)->group(function () {
                Route::get('/admin/customizations', 'index')->name('admin.customizations.dashboard');
                Route::get('/admin/customizations/edit/{id}', 'edit')->name('admin.customizations.edit');
                Route::post('/admin/customizations/update/{id}', 'update')->name('admin.customizations.update');
                Route::get('/admin/customizations/delete/{id}', 'delete')->name('admin.customizations.delete');
                Route::get('/admin/customizations/add', 'add')->name('admin.customizations.add');
                Route::post('/admin/customizations/store', 'store')->name('admin.customizations.store');
            });
        });

    Route::post('/api/shipping/calculate-cost', [ShippingController::class, 'calculateCost'])->name('shipping.calculate-cost');
    Route::post('/api/shipping/confirm-type', [ShippingController::class, 'confirmShippingType'])->name('shipping.confirm-type');
});