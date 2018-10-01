<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    $type = ['Master', 'Teacher', 'Accounting', 'Student'];
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('user'), // secret
        'remember_token' => str_random(10),
        'date_of_birth' => $faker->dateTimeBetween($startDate = '-50 years', $endDate = '-10 years', $timezone = 'Asia/Bangkok'),
        'address' => $faker->address,
        'phone_number' => $faker->phoneNumber,
        'degree' => 'ปริญญาตรี',
        'level' => $faker->numberBetween(1, 4),
        'institution' => 'Khonkaen university',
        'rank' => 1,
        'type' => $type[array_rand($type)],
        'money' => $faker->randomFloat($nbMaxDecimals = 8, $min = 0, $max = 9999999)
    ];
});
