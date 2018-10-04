<?php

use Illuminate\Database\Seeder;

class TopupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Topup::class, 50)->create()->each(function($topup) {
            factory(App\Payment::class, 1)->create([
                'topup_id' => $topup->id
            ]);
        });
    }
}
