<?php

use Illuminate\Database\Seeder;

class DegreeTableSeede extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alf_degree_student')->insert([
            'name_degree' =>'ม.ต้น',
        ]);
        DB::table('alf_degree_student')->insert([
            'name_degree' =>'ม.ปลาย',
        ]);

    }
}
