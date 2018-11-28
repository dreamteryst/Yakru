<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {

    $user = User::inRandomOrder()->where('type', 'teacher')->orWhere('type', 'master')->first();
    $type = ['video', 'live'];
    $price = $faker->randomFloat($nbMaxDecimals = 8, $min = 0, $max = 100000.00);
    return [
        'user_id' => $user->id,
        'course_picture' => 'https://fakeimg.pl/240x135/',
        'course_video' => 'https://www.youtube.com/embed/mkualZPRZCs',
        'course_name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'course_subtitle' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'course_description' => $faker->text,
        'course_price' => $price,
        'course_discounted' => $faker->randomFloat($nbMaxDecimals = 8, $min = 0, $max = $price),
        'course_limit' => $faker->randomNumber($nbDigits = 3, $strict = false),
        'requirements' => $faker->sentences($nb = 5, $asText = false),
        'result' => $faker->sentences($nb = 3, $asText = false),
        'tags' => $faker->words($nb = 3, $asText = false),
        'type' => $type[array_rand($type)],
        'secret' => $faker->sha1
    ];
});
