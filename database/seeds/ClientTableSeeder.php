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
        //Client::truncate();

        factory(\pjLaravel\Entities\Client::class, 5)->create();
    }
}
