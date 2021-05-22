<?php

use Illuminate\Database\Seeder;

class Public_holidayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alf_public_holiday')->insert([
            'FisYear' =>'2019',
            'PublicHoliday' =>'2019-10-13',
            'Descripiton'=>"วันหยุดชดเชย วันคล้ายสวรรคต"
        ]);

    }
}
