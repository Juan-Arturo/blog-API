<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //vaciar la tabla
            Article::truncate();

            $faker = \Faker\Factory::create();

        //insertar datos
        for ($i = 0; $i < 50; $i++) {
            Article::create([
                'title' => $faker->sentence(),
                'body' => $faker->paragraph(),
            ]);
        }
    }
}