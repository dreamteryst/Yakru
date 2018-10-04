<?php

use App\Bank;
use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    
    $bank = Bank::inRandomOrder()->first();
    return [
        'bank_id' => $bank->id,
        'transferred_at' => $faker->unixTime(),
        'amount' => randomFloat($nbMaxDecimals = 20, $min = 0, $max = NULL),
        'slip' => imageUrl($width = 480, $height = 640)
    ];
});
