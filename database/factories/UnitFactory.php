<?php

use Faker\Generator as Faker;

$factory->define(App\Unit::class, function (Faker $faker) {
    return [
        'unit_name' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
