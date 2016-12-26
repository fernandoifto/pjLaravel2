<?php

use Illuminate\Database\Seeder;

class ProjectTaskTableSeeder extends Seeder
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

        factory(\pjLaravel\Entities\ProjectTask::class, 5)->create();
    }
}
