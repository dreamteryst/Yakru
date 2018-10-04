<?php

use App\User;
use App\Course;
use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    
    $users = User::all();
    $courses = Course::all();
    return [
        'user_id' => $users[array_rand($users)]->id,
        'course_id' => $courses[array_rand($courses)]->id,
        'stars' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5),
        'comment' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
