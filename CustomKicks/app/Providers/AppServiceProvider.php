<?php

namespace App\Providers;

use App\Interfaces\ShippingServiceInterface;
use App\Services\CurrencyService;
use App\Services\ExpressShippingService;
use App\Services\StandardShippingService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ShippingServiceInterface::class, function ($app) {
            // Por defecto usamos el servicio estándar
            $shippingType = config('shipping.type', 'standard');

            return match ($shippingType) {
                'express' => new ExpressShippingService,
                default => new StandardShippingService,
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $rate = app(CurrencyService::class)->getUsdToCopRate();
            $view->with('usdToCop', $rate);
        });
    }
}
