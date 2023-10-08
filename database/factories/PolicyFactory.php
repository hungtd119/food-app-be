<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Policy>
 */
class PolicyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => fake()->numerify("######"),
            'title' => fake()->sentence(),
            'con_price' => fake()->numerify("######"),
            'con_quantity' => fake()->numerify("##"),
            'order_id' => Order::all()->random()->id
        ];
    }
}
