<?php

use App\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    $categories = Category::all();
    $users = User::where('type', 'teacher')->orWhere('type', 'master');
    $type = ['video', 'live'];
    return [
        'category_id' => $categories[array_rand($categories)]->id,
        'user_id' => $users[array_rand($users)]->id,
        'course_name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'course_subtitle' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'course_price' => $faker->randomFloat($nbMaxDecimals = 8, $min = 0, $max = 100000.00),
        'requirements' => $faker->sentences($nb = 5, $asText = false),
        'result' => $faker->sentences($nb = 3, $asText = false),
        'type' => $type[array_rand($type)],
        'secret' => $faker->sha1
    ];
});
