<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'price' => $this->faker->randomFloat(2, 50, 200),
            'description' => $this->faker->paragraph(),
            'brand' => $this->faker->randomElement(['Nike', 'Adidas', 'Puma', 'Reebok']),
            'size' => $this->faker->randomFloat(1, 6, 12), // Tallas de zapatos comunes
            'quantity' => $this->faker->numberBetween(1, 100),
            'image' => 'https://via.placeholder.com/150', // O una URL de imagen falsa
        ];
    }
}
