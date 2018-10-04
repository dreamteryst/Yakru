<?php

use Faker\Generator as Faker;

$factory->define(App\Bank::class, function (Faker $faker) {
    
    return [
        'bank_logo' => $faker->imageUrl(128, 128),
        'bank_name' => $faker->bank,
        'account_no' => $faker->creditCardNumber,
        'account_name' => $faker->name,
        'bank_branch' => $faker->city
    ];
});
