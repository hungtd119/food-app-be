<?php

namespace Database\Seeders;

use App\Models\Food;
use Database\Factories\FoodFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Food::factory()->count(1)->create();
    }
}
