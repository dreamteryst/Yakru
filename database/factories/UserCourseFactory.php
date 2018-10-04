<?php

use App\User;
use App\Course;
use Faker\Generator as Faker;

$factory->define(App\UserCourse::class, function (Faker $faker) {
    
    $user = User::inRandomOrder()->first();
    $course  = Course::inRandomOrder()->first();
    return [
        'user_id' => $user->id,
        'course_id' => $course->id
    ];
});
