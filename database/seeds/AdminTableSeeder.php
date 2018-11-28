<?php

use App\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'email' => 'admin@yakru.com',
            'password' => bcrypt('admin'),
            'firstname' => 'Admin',
            'lastname' => 'Yakru',
            'level' => 9,
            'type' => 'admin',
            'money' => 999999,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Admin::create([
            'email' => 'teacher@yakru.com',
            'password' => bcrypt('teacher'),
            'firstname' => 'Teacher',
            'lastname' => 'Yakru',
            'level' => 9,
            'type' => 'teacher',
            'money' => 999999,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
