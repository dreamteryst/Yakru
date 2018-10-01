<?php

use App\Course;
use App\Tag;
use Faker\Generator as Faker;

$factory->define(App\CourseTag::class, function (Faker $faker) {
    $courses = Course::all();
    $tags = Tag::all();
    return [
        'course_id' => $courses[array_rand($courses)]->id,
        'tag_id' => $tags[array_rand($tags)]->id
    ];
});
