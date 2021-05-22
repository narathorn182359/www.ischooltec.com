<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

         $this->call(UsersTableSeeder::class);
         $this->call(MonthTableSeeder::class);
         $this->call(UsergroupTableSeeder::class);
         $this->call(UserRoleTableSeeder::class);
         $this->call(ClassTableSeede::class);
         $this->call(DegreeTableSeede::class);
         $this->call(StatusTableSeeder::class);
         $this->call(Public_holidayTableSeeder::class);
         $this->call(TermTableSeeder::class);

         

    }
}
