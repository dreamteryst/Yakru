<?php

use App\Unit;
use App\Schedule;
use Faker\Generator as Faker;

$factory->define(App\ScheduleUnit::class, function (Faker $faker) {
    
    $unit = Unit::inRandomOrder()->first();
    $schedule = Schedule::inRandomOrder()->first();
    return [
        'schedule_id' => $schedule->id,
        'unit_id' => $unit->id,
    ];
});
