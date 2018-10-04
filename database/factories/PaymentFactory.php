<?php

use App\Bank;
use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    
    $bank = Bank::inRandomOrder()->first();
    return [
        'bank_id' => $bank->id,
        'transferred_at' => $faker->dateTime($max = 'now', $timezone = 'Asia/Bangkok'),
        'amount' => $faker->randomFloat($nbMaxDecimals = 20, $min = 0, $max = NULL),
        'slip' => $faker->imageUrl($width = 480, $height = 640)
    ];
});
