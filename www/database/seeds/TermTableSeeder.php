<?php

use Illuminate\Database\Seeder;

class TermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alf_term')->insert([
            'term' =>'2/2561',
            'status_run' => 'Y',
        ]);
        DB::table('alf_term')->insert([
            'term' =>'1/2561',
            'status_run' => 'N',
        ]);
        DB::table('alf_term')->insert([
            'term' =>'2/2560',
            'status_run' => 'N',
        ]);
        DB::table('alf_term')->insert([
            'term' =>'1/2560',
            'status_run' => 'N',
        ]);
    }
}
