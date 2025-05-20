<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyService
{
    public function getUsdToCopRate()
    {
        $response = Http::get('https://open.er-api.com/v6/latest/USD');

        if ($response->successful()) {
            return $response->json()['rates']['COP'];
        }

        return null;
    }
}
