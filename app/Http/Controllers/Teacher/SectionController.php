<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class SectionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:teacher']);
    }
    public function clssroom($id_class,$id_room){


        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();

        $user  =  DB::table('users')
        ->leftJoin('alf_teacher_info', 'users.username', '=', 'alf_teacher_info.username_id_tc')
        ->where('username',Auth::user()->username)
        ->first();

   
         

         $liststuden = DB::table('alf_student_info')
         ->leftJoin('alf_degree_student', 'alf_degree_student.id', '=', 'alf_student_info.degree')
         ->leftJoin('alf_class_student', 'alf_class_student.id_s', '=', 'alf_student_info.class')
         ->leftJoin('alf_name_school', 'alf_name_school.id', '=', 'alf_student_info.name_school')
         ->where('consult',$user->username)
         ->where('name_school',$user->school_teacher)
         ->where('class',$id_class)
         ->where('room',$id_room)
         ->paginate(15);

         $alf_teacher_info = DB::table('alf_teacher_info')
         ->where('username_id_tc',Auth::user()->username)
         ->first();
         $alf_name_school ='';
        // if(count($alf_teacher_info) >0){
             $alf_name_school = DB::table('alf_name_school')
             ->where('id',$alf_teacher_info->school_teacher)
             ->first();
       //  }


        $data = array(
            'listmenu'=>$listmenu,
            'liststuden' => $liststuden,
            'user'    =>  $user,
            'alf_name_school'=>$alf_name_school,
           
        );

        return view('ischool.Teacher.time_attendance',$data);
    }

}
