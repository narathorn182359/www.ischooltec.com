<?php

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
        DB::table('users')->insert([
            'username' =>'94018',
            'password' => bcrypt('ad1234'),
            'user_group' => ('1')
        ]);

     






    }
}
