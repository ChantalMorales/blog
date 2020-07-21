<?php

use App\Category;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla
        User::truncate();

        $faker =\Faker\Factory::create();
        //Crear usuarios ficticios en la tabla
        $password = Hash::make('12345');
        User::create([
            'name'=> 'Administrador',
            'email'=> 'admin@prueba.com',
            'password'=>$password,
        ]);
        for ($i =0; $i <50; $i++){
            $user= User::create([
                'name' => $faker->name,
                'email'=>$faker->email,
                'password'=> $password,
            ]);
            $user->categories()->saveMany(
                $faker->randomElements(
                    array(
                        Category::find(1),
                        Category::find(2),
                        Category::find(3)
                    ), $faker->numberBetween(1, 3), false
                )
            );
        }
    }
}
