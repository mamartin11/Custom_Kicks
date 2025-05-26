<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Services\CurrencyService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\ShippingServiceInterface;
use App\Services\StandardShippingService;
use App\Services\ExpressShippingService;

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
            
            return match($shippingType) {
                'express' => new ExpressShippingService(),
                default => new StandardShippingService(),
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
