<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use \Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //vaciar la tablañ
        User::truncate();

        $faker = \Faker\Factory::create();

        // crear la misma clave para todoslos usuarios
        $password = Hash::make('123456');

        User::create(['name' => 'Administrador', 'email' => 'admin@example.com', 'password' => $password]);

        //Generar 10 usuarios
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => $password,
            ]);
        }
    }
}
