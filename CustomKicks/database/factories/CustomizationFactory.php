<?php

namespace Database\Factories;

use App\Models\Customization;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomizationFactory extends Factory
{
    protected $model = Customization::class;

    public function definition()
    {
        return [
            'color' => $this->faker->colorName(),
            'design' => $this->faker->word(),
            'pattern' => $this->faker->word(),
            'image' => 'https://via.placeholder.com/150',
        ];
    }
}
