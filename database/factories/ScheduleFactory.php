<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    $start = $faker->dateTime($max = 'now', $timezone = 'Asia/bangkok');
    return [
        'start' => $start,
        'end' => $faker->dateTimeBetween(strtotime($start, '+3 hours'), $endDate = 'now', $timezone = 'Asia/bangkok')
    ];
});
