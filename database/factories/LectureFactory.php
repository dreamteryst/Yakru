<?php

use Faker\Generator as Faker;

$factory->define(App\Lecture::class, function (Faker $faker) {
    
    return [
        'lecture_name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'video_name' => 'courses/video_name.mp4'
    ];
});
