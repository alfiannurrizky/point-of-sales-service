<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => 3,
            'user_id' => 1,
            'product_id' => 2,
            'payment_id' => 3,
            'status' => 'unpaid',
            'price' => 100000,
            'total_paid'
        ];
    }
}
