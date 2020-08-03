<?php

use Illuminate\Database\Seeder;

class UsergroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alf_users_group')->insert([
            'name_group' =>'ผู้ดูแลระบบหลัก'
        ]);

        DB::table('alf_users_group')->insert([
            'name_group' =>'ผู้ดูแลแต่ละโรงเรียน'
        ]);

        DB::table('alf_users_group')->insert([
            'name_group' =>'ผู้ปกครอง'
        ]);

        DB::table('alf_users_group')->insert([
            'name_group' =>'ครู/อาจารย์'
        ]);




    }
}
