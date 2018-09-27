<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'dreamt451@gmail.com',
            'password' => bcrypt('055212028'),
            'firstname' => 'Kittisak',
            'lastname' => 'Pimnonthong',
            'date_of_birth' => '1996-09-06',
            'address' => '89/1 Tookluilai',
            'phone_number' => '0914168306',
            'degree' => 'ปริญาตรี',
            'level' => '4',
            'institution' => 'มหาวิทยาลัยขอนแก่น',
            'rank' => 1,
            'type' => 'student',
            'money' => 0
        ]);
    }
}
