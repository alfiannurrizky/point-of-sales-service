<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            "id" => 2,
            "category_id" => 1,
            "name" => fake()->name(),
            "stock" => 100,
            "price" => 50000,
            "image" => fake()->image()
        ];
    }
}
