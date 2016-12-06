<?php

use Illuminate\Database\Seeder;

class ProjectNoteTableSeeder extends Seeder
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

        factory(\pjLaravel\Entities\ProjectNote::class, 5)->create();
    }
}
