<?php

use App\Course;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    $courses = Course::all();
    $course = $courses[array_rand($courses)];
    $users = User::all();
    return [
        'course_id' => $course->id,
        'user_id' => $users[array_rand($users)]->id,
        'order_no' => $faker->unixTime,
        'order_note' => $faker->text,
        'course_price' => $course->course_price
    ];
});
