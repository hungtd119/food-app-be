<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Restaurent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
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
            'title' => fake()->title(),
            'thumbnail' => 'https://cdn3.dhht.vn/wp-content/uploads/2023/03/top-10-cach-nau-com-ga-thom-ngon-nhat-de-lam-tai-nha-21.jpg',
            'description' => fake()->text(),
            'portion' => fake()->numerify("#"),
            'calory' => fake()->numerify("####"),
            'unit' => fake()->numerify('##'),
            'prize' => fake()->numerify('##'),
            'category_id' => Category::all()->random()->id,
            'restaurent_id' => Restaurent::all()->random()->id
        ];
    }
}
