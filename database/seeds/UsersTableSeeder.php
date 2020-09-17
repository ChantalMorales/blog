<?php

use App\Category;
use App\User;
use App\Writer;
use App\Admin;
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
        $admin = Admin::create(['credential_number'=>'16842131']);
        $admin->user()->create([
            'name'=> 'Administrador',
            'email'=> 'admin@prueba.com',
            'password'=>$password,
            'role'=> 'ROLE_ADMIN'
        ]);
        for ($i =0; $i <50; $i++){
            $writer=Writer::create([
                'editorial'=>$faker->company,
                'short_bio'=>$faker->paragraph
            ]);
            $writer->user()->create([
                'name' => $faker->name,
                'email'=>$faker->email,
                'password'=> $password,
            ]);
            $writer->user->categories()->saveMany(
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
