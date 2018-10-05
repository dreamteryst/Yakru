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
            'email' => 'k.pimnonthong@gmail.com',
            'password' => bcrypt('admin'),
            'firstname' => 'Kittisak',
            'lastname' => 'Pimnonthong',
            'level' => 9,
            'type' => 'admin',
            'money' => 999999,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
