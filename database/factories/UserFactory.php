<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use src\Users\Models\User;
use src\Users\ValueObjects\UserId;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'id' => UserId::new()->getValue(),
        'name' => $faker->name,
        'emailAddress' => $faker->unique()->safeEmail,
        'emailVerifiedAt' => now(),
        'password' => bcrypt('password'),
        'remember_token' => Str::random(10),
    ];
});
