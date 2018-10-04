<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    
    return [
        'category_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'category_description' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
