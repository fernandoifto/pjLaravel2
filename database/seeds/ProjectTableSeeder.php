<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
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

        factory(\pjLaravel\Entities\Project::class, 5)->create();
    }
}
