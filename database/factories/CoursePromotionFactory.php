<?php

use App\Course;
use App\Promotion;
use Faker\Generator as Faker;

$factory->define(App\CoursePromotion::class, function (Faker $faker) {
    
    $promotions = Promotion::all();
    $courses = Course::all();
    return [
        'course_id' => $courses[array_rand($courses)]->id,
        'promotion_id' => $promotions[array_rand($promotions)]->id
    ];
});
