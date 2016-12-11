<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Project::truncate();
        
        factory(\pjLaravel\Entities\User::class)->create([
            'name' => 'Fernando de Souza Arantes',
            'email' => 'fernando.arantes@ifto.edu.br',
            'password' => bcrypt(buchin26),
            'remember_token' => str_random(10),
        ]);
        
        //factory(\pjLaravel\Entities\User::class, 5)->create();
    }
}
