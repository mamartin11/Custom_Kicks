<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Services\CurrencyService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
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
