<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $school = DB::table('alf_adminschool_info')->where('username_id',Auth::user()->username)->get();
      
        $getuserstudent = DB::table('alf_parent_info')
        ->leftJoin('alf_student_info', 'alf_parent_info.student_parent', '=', 'alf_student_info.student_code_id')
        ->leftJoin('alf_degree_student', 'alf_student_info.degree', '=', 'alf_degree_student.id')
        ->leftJoin('alf_class_student', 'alf_student_info.class', '=', 'alf_class_student.id_s')
        ->leftJoin('alf_name_school', 'alf_student_info.name_school', '=', 'alf_name_school.id')
        ->leftJoin('alf_teacher_info', 'alf_student_info.consult', '=', 'alf_teacher_info.username_id_tc')
        ->where('username_id',Auth::user()->username)
        ->get();

        $alf_teacher_info = DB::table('alf_teacher_info')->where('username_id_tc',Auth::user()->username)->get();
        $alf_name_school ='';
        if(count($alf_teacher_info) >0){
            $alf_name_school = DB::table('alf_name_school')
            ->where('id',$alf_teacher_info[0]->school_teacher)
            ->first();


        }
        if($school->count()>0){
            $alf_name_school = DB::table('alf_name_school')
            ->where('id',$school[0]->school_adminschool)
            ->first();
        }
       
        $data = array(
                    'listmenu'=>$listmenu,
                    'getuserstudent' =>  $getuserstudent,
                      'alf_name_school' =>  $alf_name_school
                     );

//dd($getuserstudent);
        return view('ischool/home',$data);
    }
}
