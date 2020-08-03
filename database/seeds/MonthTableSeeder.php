<?php

use Illuminate\Database\Seeder;

class MonthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alf_month')->insert([
            'name_month' =>'ทั้งหมด'
        ]);
        DB::table('alf_month')->insert([
            'name_month' =>'มกราคม'
        ]);
        DB::table('alf_month')->insert([
            'name_month' =>'กุมภาพันธ์'
        ]);
        DB::table('alf_month')->insert([
            'name_month' =>'มีนาคม'
        ]);
        DB::table('alf_month')->insert([
            'name_month' =>'เมษายน'
        ]);
        DB::table('alf_month')->insert([
            'name_month' =>'พฤษภาคม'
        ]);
        DB::table('alf_month')->insert([
            'name_month' =>'มิถุนายน'
        ]);
        DB::table('alf_month')->insert([
            'name_month' =>'กรกฏาคม'
        ]);
        DB::table('alf_month')->insert([
            'name_month' =>'สิงหาคม'
        ]);
        DB::table('alf_month')->insert([
            'name_month' =>'กันยายน'
        ]);
        DB::table('alf_month')->insert([
            'name_month' =>'ตุลาคม'
        ]);
        DB::table('alf_month')->insert([
            'name_month' =>'พฤศจิกายน'
        ]);
        DB::table('alf_month')->insert([
            'name_month' =>'ธันวาคม'
        ]);

    }
}
