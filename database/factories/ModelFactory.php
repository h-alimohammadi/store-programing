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
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Payment::class, function (Faker\Generator $faker) {

    return [
        'user_id' => rand(1,2),
        'resnumber' => rand(10000000,50000000),
        'price' => rand(1000 , 50000),
        'payment' => rand(0,1),
        'created_at' => $faker->dateTimeBetween('-5 months' , 'now')
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence(5),
        'lang' => 'fa',
        'description' => $faker->paragraph(),
        'body' => $faker->paragraph(12),
        'images' => [
            'thumb' => $faker->imageUrl(),
            'images' => [
                '300' => $faker->imageUrl(300,300),
                'original' => $faker->image()
            ]
        ],
        'tags' => 'tag1,tag2'
    ];
});
