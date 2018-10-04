<?php

use App\Course;
use Faker\Generator as Faker;

$factory->define(App\CoursePromotion::class, function (Faker $faker) {
    $course = Course::inRandomOrder()->first();
    return [
        'course_id' => $course->id
    ];
});
