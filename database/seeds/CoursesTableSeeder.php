<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Course::class, 50)->create()->each(function ($course) {
            factory(App\Unit::class, 5)->create([
                'course_id' => $course->id
            ])->each(function ($unit) {
                factory(App\Lecture::class, 10)->create([
                    'unit_id' => $unit->id
                ]);
            });
        });
    }
}
