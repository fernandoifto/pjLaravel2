<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \pjLaravel\Client::truncate();
        
        factory(\pjLaravel\Client::class, 5)->create();
    }
}
