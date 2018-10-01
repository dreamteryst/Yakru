<?php

use App\Course;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    $course = Course::inRandomOrder()->first();
    $user = User::inRandomOrder()->first();
    return [
        'course_id' => $course->id,
        'user_id' => $user->id,
        'order_no' => $faker->unixTime,
        'order_note' => $faker->text,
        'course_price' => $course->course_price
    ];
});
