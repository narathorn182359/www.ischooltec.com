<?php

namespace App\Http\Controllers\Parent;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ParentController extends Controller
{
    public function index_addten()
    {
        $listmonth = DB::table('alf_month')->get();
        $liststatus = DB::table('alf_status_student')->get();
        $listterm = DB::table('alf_term')->get();
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
       
        $data = array('listmenu'=>$listmenu,
        'liststatus' => $liststatus,
        'listterm'=> $listterm,
        'listmonth' => $listmonth,
    );
                     
        return view("ischool.parent.time_addten", $data);
    }

    public function index_contact()
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
     
        $getinfopar = DB::table('alf_parent_info')->where('username_id',Auth::user()->username)->get(); 
        $getuserstudent = DB::table('alf_student_info')
        ->leftJoin('alf_name_school', 'alf_student_info.name_school', '=', 'alf_name_school.id')     
        ->where('student_code_id',$getinfopar[0]->student_parent)
        ->get();      
        $data = array('listmenu'=>$listmenu,
                      'getuserstudent'=>$getuserstudent
    
                        );



          
        return view("ischool.parent.contact", $data);
    }

    public function index_public_relations()
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $listinfo = DB::table('alf_parent_info')->where('username_id',Auth::user()->username)->get(); 

        $relations = DB::table('alf_public_relations')->where('id_school',$listinfo[0]->school_parent)->orderBy('created_at','DESC')->get();
        $data = array('listmenu'=>$listmenu,
                       'relations' => $relations
    
                       );
            
        

        return view("ischool.parent.public_relations", $data);
    }


    public function index_report_problem()
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $data = array('listmenu'=>$listmenu);
                     
        return view("ischool.parent.report_problem", $data);
    }


    public function index_class_schedule()
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $data = array('listmenu'=>$listmenu);
                     
        return view("ischool.parent.class-schedule", $data);
    }
    

    public function index_floor_teacher()
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $getinfopar = DB::table('alf_parent_info')->where('username_id',Auth::user()->username)->get(); 
        $getuserstudent = DB::table('alf_student_info')
        ->leftJoin('alf_teacher_info', 'alf_student_info.consult', '=', 'alf_teacher_info.username_id_tc')     
        ->where('student_code_id',$getinfopar[0]->student_parent)
        ->get();      
        $data = array('listmenu'=>$listmenu,
                      'getuserstudent'=>$getuserstudent
    
                        );
      

        return view("ischool.parent.floor-teacher", $data);
    }

    public function index_list_att()
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $data = array('listmenu'=>$listmenu
    

          );
          return view("ischool.parent.list-att", $data);
    }
    






}
