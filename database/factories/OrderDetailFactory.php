<?php

namespace Database\Factories;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
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
            'order_id' => Order::all()->random()->id,
            'food_id' => Food::all()->random()->id,
            'sid'=>fake()->sentence(20),
            'quantity' => fake()->numerify('#'),
        ];
    }
}
