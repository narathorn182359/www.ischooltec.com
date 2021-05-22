<?php

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alf_role_auth')->insert([
            'group_id' =>'1',
            'title' =>'หน้าแรก',
            'url' =>'/home',
            'icon' =>'home'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'1',
            'title' =>'จัดการโรงเรียน',
            'url' =>'/mgmaseterschool',
            'icon' =>'people'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'1',
            'title' =>'จัดการผู้ใช้',
            'url' =>'/mgmaseteruser',
            'icon' =>'people'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'1',
            'title' =>'จัดการนักเรียน',
            'url' =>'/mgmaseterstuden',
            'icon' =>'people'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'1',
            'title' =>'จัดการกลุ่มผู้ใช้',
            'url' =>'/mgmasetergroup',
            'icon' =>'people'
        ]);


        DB::table('alf_role_auth')->insert([
            'group_id' =>'2',
            'title' =>'หน้าแรก',
            'url' =>'/home',
            'icon' =>'home'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'2',
            'title' =>'จัดการผู้ใช้',
            'url' =>'/mgadminschool',
            'icon' =>'people'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'2',
            'title' =>'จัดการข่าวสาร',
            'url' =>'/mgadminnewschool',
            'icon' =>'people'
        ]);



        DB::table('alf_role_auth')->insert([
            'group_id' =>'3',
            'title' =>'หน้าแรก',
            'url' =>'/home',
            'icon' =>'home'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'3',
            'title' =>'นักเรียนลงเวลามาเรียน',
            'url' =>'/profile',
            'icon' =>'people'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'3',
            'title' =>'รายการเข้า-ออกโรงเรียน',
            'url' =>'/list',
            'icon' =>'people'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'3',
            'title' =>'ตารางเรียน',
            'url' =>'/class-schedule',
            'icon' =>'journal'
        ]);

       DB::table('alf_role_auth')->insert([
            'group_id' =>'3',
            'title' =>'ประชาสัมพันธิ์',
            'url' =>'/public-relations',
            'icon' =>'megaphone'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'3',
            'title' =>'อาจารย์ประจำชั้น',
            'url' =>'/floor-teacher',
            'icon' =>'person'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'3',
            'title' =>'ติดต่อโรงเรียน',
            'url' =>'/contact-school',
            'icon' =>'school'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'3',
            'title' =>'แจ้งปัญหาการใช้งานแอพ',
            'url' =>'/report-problems',
            'icon' =>'build'
        ]);











        DB::table('alf_role_auth')->insert([
            'group_id' =>'4',
            'title' =>'หน้าแรก',
            'url' =>'/home',
            'icon' =>'home'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'4',
            'title' =>'นักเรียนลงเวลามาเรียน',
            'url' =>'/time_attendance_teacher',
            'icon' =>'people'
        ]);
        DB::table('alf_role_auth')->insert([
            'group_id' =>'4',
            'title' =>'ตารางเรียน',
            'url' =>'/class_schedule_teacher',
            'icon' =>'journal'
        ]);

       DB::table('alf_role_auth')->insert([
            'group_id' =>'4',
            'title' =>'ประชาสัมพันธิ์',
            'url' =>'/public_relations',
            'icon' =>'megaphone'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'4',
            'title' =>'ข้อมูลอาจารย์ประจำชั้น',
            'url' =>'/floor_teacher',
            'icon' =>'person'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'4',
            'title' =>'ติดต่อโรงเรียน',
            'url' =>'/contact_school',
            'icon' =>'school'
        ]);

        DB::table('alf_role_auth')->insert([
            'group_id' =>'4',
            'title' =>'แจ้งปัญหาการใช้งานแอพ',
            'url' =>'/report_problems',
            'icon' =>'build'
        ]);






    }
}
