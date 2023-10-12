<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurent>
 */
class RestaurentFactory extends Factory
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
            'user_id' => User::all()->random()->id,
            'name' => fake()->name(),
            'taxCode' => fake()->numerify("######"),
            'thumbnail' => 'https://images.foody.vn/res/g80/791257/prof/s/file_restaurant_photo_zj7d_16195-88cb1e38-210427122724.jpg',
            'address'=>fake()->address(),
            'rating'=>fake()->numerify("#"),
            'accessUnit'=>fake()->numerify("###")
        ];
    }
}
