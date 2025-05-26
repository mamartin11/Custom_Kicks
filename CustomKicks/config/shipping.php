<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Shipping Service Configuration
    |--------------------------------------------------------------------------
    |
    | Aquí puedes configurar el tipo de servicio de envío que deseas usar.
    | Opciones disponibles: 'standard', 'express'
    |
    */
    'type' => env('SHIPPING_TYPE', 'standard'),

    /*
    |--------------------------------------------------------------------------
    | Shipping Costs
    |--------------------------------------------------------------------------
    |
    | Configuración de costos para cada tipo de envío
    |
    */
    'costs' => [
        'standard' => [
            'base_cost' => 10.00,
            'order_value_percentage' => 0.05,
            'distance_factor' => 0.02,
        ],
        'express' => [
            'base_cost' => 25.00,
            'cost_per_kg' => 5.00,
            'distance_factor' => 1.5,
        ],
    ],
]; 