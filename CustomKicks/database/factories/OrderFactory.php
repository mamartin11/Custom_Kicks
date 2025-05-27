<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // O un user_id existente
            'total' => $this->faker->randomFloat(2, 10, 500),
            'order_date' => $this->faker->date(),
            'details' => json_encode([
                ['product' => 'Item 1', 'price' => 10, 'quantity' => 1],
                ['product' => 'Item 2', 'price' => 20, 'quantity' => 2],
            ]),
            'discount' => 0,
        ];
    }
}