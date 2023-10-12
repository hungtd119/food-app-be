<?php

namespace Database\Factories;

use App\Models\Restaurent;
use App\Models\User;
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
    public function definition()
    {
        return [
            'id' => fake()->numerify("######"),
            'restaurent_id' => Restaurent::all()->random()->id,
            'customer_id' => User::all()->random()->id,
            'sid'=>fake()->sentence(20),
            'total_amount' => fake()->numerify("######"),
        ];
    }
}
