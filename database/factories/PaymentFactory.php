<?php

use App\Bank;
use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    $banks = Bank::all();
    return [
        'bank_id' => $banks[array_rand($banks)]->id,
        'transferred_at' => $faker->unixTime(),
        'amount' => randomFloat($nbMaxDecimals = 20, $min = 0, $max = NULL),
        'slip' => imageUrl($width = 480, $height = 640)
    ];
});
