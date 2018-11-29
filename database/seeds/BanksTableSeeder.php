<?php

use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Bank::class, 20)->create();
        App\Bank::create([
            'bank_logo' => "http://news.mthai.com/app/uploads/2016/10/734708-01-1.jpg",
            'bank_name' => "กสิกรไทย",
            'account_no' => "124-2-76195-9",
            'account_name' => "กิตธิศักดิ์ พิมพ์โนนทอง",
            'bank_branch' => "ชุมแพ",
        ]);
    }
}
