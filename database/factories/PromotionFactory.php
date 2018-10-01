<?php

use Faker\Generator as Faker;

$factory->define(App\Promotion::class, function (Faker $faker) {
    $start = $faker->dateTime($max = 'now', $timezone = 'Asia/bangkok');
    return [
        'promotion_name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'promotion_description' => $faker->text,
        'started_at' => $start,
        'ended_at' => $faker->dateTimeBetween(strtotime($start, '+3 days'), $endDate = 'now', $timezone = 'Asia/bangkok')
    ];
});
