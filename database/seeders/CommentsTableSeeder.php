<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // vaciamos la tabla comments
        Comment::truncate();
        $faker = \Faker\Factory::create();

        //obtenemos todos los articulos
        $articles = Article::all();
        
        // obtenemos todos los usuarios
        $users = User::all();
        foreach ($users as $user) {
            //iniciamos sesion con cada uno
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);

            //Creamos comentarios en cada articulo
            foreach($articles as $article){
                Comment::create([
                    'text' => $faker->paragraph(),
                    'article_id' => $article->id,
                ]);
            }
        }

    }
}
