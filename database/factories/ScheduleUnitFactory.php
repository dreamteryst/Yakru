<?php

use App\Unit;
use Faker\Generator as Faker;

$factory->define(App\ScheduleUnit::class, function (Faker $faker) {
    
    $unit = Unit::inRandomOrder()->first();
    return [
        'unit_id' => $unit->id,
    ];
});
