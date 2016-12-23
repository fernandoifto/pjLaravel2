<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(pjLaravel\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(pjLaravel\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentence,
    ];
});

$factory->define(pjLaravel\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => rand(1, 5),
        'client_id' => rand(1, 5),
        'name' => $faker->word,
        'description' => $faker->sentence,
        'progress' => rand(1, 100),
        'status' => rand(1, 3),
        'due_date' => $faker->dateTime('now')->format('Y-m-d')
    ];
});

$factory->define(pjLaravel\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1, 5),
        'title' => $faker->word,
        'note' => $faker->paragraph
    ];
});

$factory->define(pjLaravel\Entities\ProjectTask::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1, 5),
        'name' => $faker->word,
        'start_date' => $faker->dateTime('now')->format('Y-m-d'),
        'due_date' => $faker->dateTime('now')->format('Y-m-d'),
        'status' => rand(1, 3)
    ];
});

$factory->define(pjLaravel\Entities\ProjectMember::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1, 5),
        'member_id' => rand(1, 5)
    ];
});
