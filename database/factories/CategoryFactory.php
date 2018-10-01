<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'category_name' => $faker->name,
        'category_description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
    ];
});
