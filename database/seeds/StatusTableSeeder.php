<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alf_status_student')->insert([
            'name_status' =>'ทั้งหมด'
        ]);
        DB::table('alf_status_student')->insert([
            'name_status' =>'มาปกติ'
        ]);
        DB::table('alf_status_student')->insert([
            'name_status' =>'มาสาย'
        ]);
        DB::table('alf_status_student')->insert([
            'name_status' =>'ขาดเรียน'
        ]);
        DB::table('alf_status_student')->insert([
            'name_status' =>'ลา'
        ]);
        DB::table('alf_status_student')->insert([
            'name_status' =>'ไปกิจกรรมโรงเรียน'
        ]);
        DB::table('alf_status_student')->insert([
            'name_status' =>'ไม่ลงเวลา'
        ]);
        DB::table('alf_status_student')->insert([
            'name_status' =>'ยังไม่ลงเวลา'
        ]);
    }
}
