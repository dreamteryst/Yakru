<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class, 20)->create()->each(function($category) {
            factory(App\Course::class, 5)->create([
                'category_id' => $category->id
            ])->each(function ($course) {
                factory(App\Unit::class, 5)->create([
                    'course_id' => $course->id
                ])->each(function ($unit) use ($course) {
                    factory(App\Lecture::class, 10)->create([
                        'unit_id' => $unit->id
                    ]);
                });
            });
        });
    }
}
