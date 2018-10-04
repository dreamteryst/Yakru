<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {

    $user = User::inRandomOrder()->where('type', 'teacher')->orWhere('type', 'master')->first();
    $type = ['video', 'live'];
    return [
        'user_id' => $user->id,
        'course_name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'course_subtitle' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'course_description' => $faker->text,
        'course_price' => $faker->randomFloat($nbMaxDecimals = 8, $min = 0, $max = 100000.00),
        'requirements' => $faker->sentences($nb = 5, $asText = false),
        'result' => $faker->sentences($nb = 3, $asText = false),
        'tags' => $faker->words($nb = 3, $asText = false),
        'type' => $type[array_rand($type)],
        'secret' => $faker->sha1
    ];
});
