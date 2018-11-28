<?php

use Faker\Generator as Faker;

$factory->define(App\Lecture::class, function (Faker $faker) {
    $guest = [true, false];
    return [
        'lecture_name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'video_name' => 'courses/video_name.mp4',
        'guest' => $guest[array_rand($guest)]
    ];
});
