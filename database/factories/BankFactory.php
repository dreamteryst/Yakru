<?php

use Faker\Generator as Faker;

$factory->define(App\Bank::class, function (Faker $faker) {
    return [
        'bank_logo' => $faker->imageUrl(128, 128),
        'bank_name' => $faker->name,
        'account_no' => $faker->bankAccountNumber,
        'account_name' => $faker->name,
        'bank_branch' => $faker->city
    ];
});
