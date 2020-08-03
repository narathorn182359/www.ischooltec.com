<?php

use Illuminate\Database\Seeder;

class ClassTableSeede extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alf_class_student')->insert([
            'name_class' =>'ม.1',
        ]);

        DB::table('alf_class_student')->insert([
            'name_class' =>'ม.2',
        ]);

        DB::table('alf_class_student')->insert([
            'name_class' =>'ม.3',
        ]);

        DB::table('alf_class_student')->insert([
            'name_class' =>'ม.4',
        ]);

        DB::table('alf_class_student')->insert([
            'name_class' =>'ม.5',
        ]);

        DB::table('alf_class_student')->insert([
            'name_class' =>'ม.6',
        ]);
    }
}
