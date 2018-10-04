<?php

use Illuminate\Database\Seeder;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Promotion::class, 2)->create()->each(function($promotion) {
            factory(App\CoursePromotion::class, 5)->create([
                'promotion_id' => $promotion->id
            ]);
        });
    }
}
