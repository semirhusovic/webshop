<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_price' => rand(1, 150),
            'product_months_of_warranty' => 12,
            'product_manufacturing_date' => '2022-07-21',
            'unit_of_measure' => 'piece',
            'country_id' => 1,
            'manufacturer_id' => rand(1, 3),
            'product_name:en' => fake()->word(),
            'product_name:me' => fake()->word(),
            'product_description:en' => fake()->paragraph(),
            'product_description:me' => fake()->paragraph(),
        ];
    }
}
