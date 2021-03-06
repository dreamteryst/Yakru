<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(OrdersTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        // $this->call(PromotionsTableSeeder::class);
        // $this->call(SchedulesTableSeeder::class);
        // $this->call(TopupsTableSeeder::class);
        // $this->call(UserCoursesTableSeeder::class);
    }
}
