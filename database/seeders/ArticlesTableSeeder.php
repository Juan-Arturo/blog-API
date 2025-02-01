<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

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

        /*Iteramos la lista de todos los usuario creados e iteramos
        sobre cada uno y simulamos un inicio de sesion con cada uno
        paracrear articulos en su nombre*/
        
        $users = User::all();
        foreach ($users as $user) {
            //iniciamos sesion con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);

            //Ahora con este usuario creamos articulos
            for ($i = 0; $i < 5; $i++) {
                Article::create([
                    'title' => $faker->sentence(),
                    'body' => $faker->paragraph(),
                    'category_id' =>  $faker->numberBetween(1,3),
                ]);
            }
        }
    
    }
}
