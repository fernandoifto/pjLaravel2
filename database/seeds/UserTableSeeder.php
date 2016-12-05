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

        factory(\pjLaravel\Entities\User::class, 5)->create();
    }
}
