<?php

use Illuminate\Database\Seeder;
use pjLaravel\Entities\Client;

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
        
        factory(Client::class, 5)->create();
    }
}
