<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // vaciar la tabla categories

        Category::truncate();
        $faker = Factory::create();

        for ($i = 0; $i < 3; $i++) {
            Category::create([
                'name' => $faker->name,
            ]);
        }
    }
}
