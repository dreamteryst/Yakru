<?php

use App\Course;
use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    
    $course = Course::inRandomOrder()->where('type', 'live')->first();
    $start = $faker->dateTime($max = 'now', $timezone = 'Asia/bangkok');
    return [
        'course_id' => $course->id,
        'start' => $start,
        'end' => $faker->dateTimeBetween($start->add(new DateInterval('PT3H')), $endDate = 'now', $timezone = 'Asia/bangkok')
    ];
});
