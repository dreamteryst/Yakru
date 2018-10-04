<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Topup::class, function (Faker $faker) {
    
    $user = User::inRandomOrder()->first();
    $status = ['transfer', 'visa', 'paypal'];
    return [
        'user_id' => $user->id,
        'amount' => randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000000),
        'status' => 'paid',
        'method' => $status[array_rand($status)],
        'evidence' => $faker->imageUrl($width = 640, $height = 480)
    ];
});
