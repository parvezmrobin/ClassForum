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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'bio' => $faker->paragraph,
        'image' => $faker->imageUrl(),
        'email' => $faker->unique()->safeEmail,
        'sex' => array_random(['Male', 'Female', 'Other']),
        'is_approved' => rand(0, 1),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Channel::class, function(Faker\Generator $faker) {
    return [
        'channel' => $faker->word,
    ];
});

$factory->define(App\Thread::class, function(Faker\Generator $faker) {
    $users = App\User::all();
    $channels = App\Channel::all();
    return [
        'title' => $faker->sentence,
        'description' => $faker->realText(),
        'user_id' => $users->random()->id,
        'channel_id' => $channels->random()->id
    ];
});

$factory->define(App\Answer::class, function(Faker\Generator $faker) {
    $users = App\User::all();
    $threads = App\Thread::all();
    return [
        'answer' => $faker->sentence,
        'user_id' => $users->random()->id,
        'thread_id' => $threads->random()->id,
    ];
});

$factory->define(App\Reply::class, function(Faker\Generator $faker) {
    $users = App\User::all();
    $answers = App\Thread::all();
    return [
        'reply' => $faker->sentence,
        'user_id' => $users->random()->id,
        'answer_id' => $answers->random()->id,
    ];
});

$factory->define(App\EditHistory::class, function(Faker\Generator $faker) {
    $threads = App\Thread::all();
    $channels = App\Channel::all();
    return [
        'title' => $faker->sentence,
        'description' => $faker->realText(),
        'channel_id' => $channels->random()->id,
        'thread_id' => $threads->random()->id,
    ];
});



