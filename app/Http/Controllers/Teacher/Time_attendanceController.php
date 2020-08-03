<?php

namespace App\Http\Controllers\Teacher;
use Illuminate\Support\Facades\Input;
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
use Illuminate\Contracts\Encryption\DecryptException;

class Time_attendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:teacher']);
    }

    public function index()
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();

        $user  =  DB::table('users')
        ->leftJoin('alf_teacher_info', 'users.username', '=', 'alf_teacher_info.username_id_tc')
        ->where('username',Auth::user()->username)
        ->get();

         $liststuden = DB::table('alf_student_info')
         ->leftJoin('alf_degree_student', 'alf_degree_student.id', '=', 'alf_student_info.degree')
         ->leftJoin('alf_class_student', 'alf_class_student.id', '=', 'alf_student_info.class')
         ->leftJoin('alf_name_school', 'alf_name_school.id', '=', 'alf_student_info.name_school')
         ->where('consult',$user[0]->username)
         ->where('name_school',$user[0]->school_teacher)
         ->where('class',$user[0]->school_section)
         ->where('room',$user[0]->school_room)
         ->paginate(15);

        $data = array(
            'listmenu'=>$listmenu,
            'liststuden' => $liststuden,
            'user'    =>  $user
        );

        return view('ischool.Teacher.time_attendance',$data);

        





    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$school)
    {
        $decrypted = decrypt($id);
        $decryptedschool = decrypt($school);
        $code_term = Input::get ('code_term');
        $code_month = Input::get ('code_month');
        $code_status = Input::get ('code_status');
   
      
        if( $code_term != "" ||  $code_month != "" ||  $code_status != "" ){
            $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
            $listmonth = DB::table('alf_month')->get();
            $liststatus = DB::table('alf_status_student')->get();
            $listterm = DB::table('alf_term')->get();
        $pagination = DB::table('alf_timeattendance_student')->leftJoin('alf_status_student', 'alf_timeattendance_student.code_status', '=', 'alf_status_student.id')
        ->leftJoin('alf_student_info', 'alf_timeattendance_student.code_student', '=', 'alf_student_info.student_code_id')
        ->orderBy('date','DESC')
        ->orwhere( 'code_term', 'LIKE', '%'.$code_term.'%' )
        ->orWhere('code_month', 'LIKE', '%'.$code_month.'%' )
        ->orWhere('code_status', 'LIKE', '%'.$code_status.'%' )
        ->where('code_student', $decrypted)
        ->where('code_school', $decryptedschool)
        ->simplePaginate(16)
        ->setPath ( '' );
      $pagination->appends( array (
            'code_term' => Input::get ('code_term' ),
            'code_month' => Input::get ('code_month'),
            'code_status' => Input::get ('code_status'),
            'code_school' => Input::get ('code_school' ),
            'code_student' => Input::get ('code_student' )
          ) );

          $data = array(
            'listmenu'=>$listmenu,
            'liststatus' => $liststatus,
            'listterm'=> $listterm,
            'listmonth' => $listmonth,
           // 'listtimeatt' => $listtimeatt,
            'id'         => $id

        );
        if (count ( $pagination ) > 0){

        return view('ischool.Teacher.detail_timeattendance',$data)->withDetails($pagination);
       }
        return view('ischool.Teacher.detail_timeattendance',$data)->withMessage ( 'ไม่พบข้อมูล...' );
       
    }else{

        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $listmonth = DB::table('alf_month')->get();
        $liststatus = DB::table('alf_status_student')->get();
        $listterm = DB::table('alf_term')->get();
        $listtimeatt = DB::table('alf_timeattendance_student')
       ->leftJoin('alf_status_student', 'alf_timeattendance_student.code_status', '=', 'alf_status_student.id')
      ->leftJoin('alf_student_info', 'alf_timeattendance_student.code_student', '=', 'alf_student_info.student_code_id')
       ->orderBy('date','DESC')
       ->where('code_student', $decrypted)
        ->where('code_school', $decryptedschool)
        ->get();
       
        $data = array(
            'listmenu'=>$listmenu,
            'liststatus' => $liststatus,
            'listterm'=> $listterm,
            'listmonth' => $listmonth,
            'listtimeatt' => $listtimeatt,
            'id'         => $id

        );





        return view('ischool.Teacher.detail_timeattendance',$data)->withMessage ( 'ไม่พบข้อมูล...' );


    }
    
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function search()
    {
        $code_term = Input::get ('code_term');
        $code_month = Input::get ('code_month');
        $code_status = Input::get ('code_status');
        $code_school =decrypt(Input::get ('code_school')) ;
        $code_student = decrypt(Input::get ( 'code_student' ));
        $listmonth = DB::table('alf_month')->get();
        $liststatus = DB::table('alf_status_student')->get();
        $listterm = DB::table('alf_term')->get();
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $data = array(
            'listmenu' => $listmenu,
            'liststatus' => $liststatus,
            'listterm'=> $listterm,
            'listmonth' => $listmonth,

        );
        if($code_term != "" && $code_month != "" && $code_status !="" ){
        $pagination = DB::table('alf_timeattendance_student')->leftJoin('alf_status_student', 'alf_timeattendance_student.code_status', '=', 'alf_status_student.id')
        ->leftJoin('alf_student_info', 'alf_timeattendance_student.code_student', '=', 'alf_student_info.student_code_id')
        ->orderBy('date','DESC')
        ->orwhere( 'code_term', 'LIKE', '%'.$code_term.'%' )
        ->orWhere('code_month', 'LIKE', '%'.$code_month.'%' )
        ->orWhere('code_status', 'LIKE', '%'.$code_status.'%' )
        ->where('code_student', $code_student)
        ->where('code_school', $code_school)
        ->simplePaginate(16)
        ->setPath ( '' );
      $pagination->appends( array (
            'code_term' => Input::get ('code_term' ),
            'code_month' => Input::get ('code_month'),
            'code_status' => Input::get ('code_status'),
            'code_school' => Input::get ('code_school' ),
            'code_student' => Input::get ('code_student' )
          ) );


        if (count ( $pagination ) > 0){

        return view('ischool.Teacher.detail_timeattendance',$data)->withDetails($pagination);
       }

    }else{
        return view('ischool.Teacher.detail_timeattendance',$data)->withMessage ( 'ไม่พบข้อมูล...' );
    }


   
    }
}
