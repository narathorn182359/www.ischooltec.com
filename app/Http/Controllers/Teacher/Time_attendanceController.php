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
        ->first();

          $getroom =  DB::table('alf_room_consult')
          ->leftJoin('alf_teacher_info', 'alf_room_consult.id_username_tc_rm', '=', 'alf_teacher_info.username_id_tc')
          ->leftJoin('alf_name_school', 'alf_teacher_info.school_teacher', '=', 'alf_name_school.id') 
          ->leftJoin('alf_class_student', 'alf_room_consult.class_rm', '=', 'alf_class_student.id_s') 
          ->select('name_class','room_rm','id_s','name_school_a','school_rm')
          ->where('id_username_tc_rm',$user->username)->get();
         

         $liststuden = DB::table('alf_student_info')
         ->leftJoin('alf_degree_student', 'alf_degree_student.id', '=', 'alf_student_info.degree')
         ->leftJoin('alf_class_student', 'alf_class_student.id_s', '=', 'alf_student_info.class')
         ->leftJoin('alf_name_school', 'alf_name_school.id', '=', 'alf_student_info.name_school')
         ->where('consult',$user->username)
         ->where('name_school',$user->school_teacher)
         ->where('class',$user->school_section)
         ->where('room',$user->school_room)
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
            'getroom' =>   $getroom
        );

        return view('ischool.Teacher.section',$data);


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
          

         $alf_teacher_info = DB::table('alf_teacher_info')->where('username_id_tc',Auth::user()->username)->get();
         $alf_name_school ='';
         if(count($alf_teacher_info) >0){
             $alf_name_school = DB::table('alf_name_school')
             ->where('id',$alf_teacher_info[0]->school_teacher)
             ->first();
         }
          $data = array(
            'listmenu'=>$listmenu,
            'liststatus' => $liststatus,
            'listterm'=> $listterm,
            'listmonth' => $listmonth,
           // 'listtimeatt' => $listtimeatt,
            'id'         => $id,
            'alf_name_school' => $alf_name_school

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



        $alf_teacher_info = DB::table('alf_teacher_info')->where('username_id_tc',Auth::user()->username)->get();
        $alf_name_school ='';
        if(count($alf_teacher_info) >0){
            $alf_name_school = DB::table('alf_name_school')
            ->where('id',$alf_teacher_info[0]->school_teacher)
            ->first();
        }

        $data = array(
            'listmenu'=>$listmenu,
            'liststatus' => $liststatus,
            'listterm'=> $listterm,
            'listmonth' => $listmonth,
            'listtimeatt' => $listtimeatt,
            'id'         => $id,
            'alf_name_school' => $alf_name_school

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

    public function deletegrades(Request $request)
    {

        DB::table('alf_grade')->where('id_grade',$request->id)->delete();
    }


    public function grade($id)
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $decrypted = decrypt($id);
        $alf_term = DB::table('alf_term')->get();
        $alf_grade = DB::table('alf_grade')->get();


        $studeninfo = DB::table('alf_student_info')
        ->where('student_code_id',$decrypted)
        ->first();

        $alf_grade = DB::table('alf_grade')
        ->where('id_studens',$decrypted)
        ->where('id_school', $studeninfo->name_school)
        ->get();


        $alf_teacher_info = DB::table('alf_teacher_info')->where('username_id_tc',Auth::user()->username)->get();
        $alf_name_school ='';
        if(count($alf_teacher_info) >0){
            $alf_name_school = DB::table('alf_name_school')
            ->where('id',$alf_teacher_info[0]->school_teacher)
            ->first();
        }

        $data = array(
            'listmenu'=>$listmenu,
            'studeninfo' =>$studeninfo,
            'alf_term' => $alf_term,
            'alf_grade' => $alf_grade,
            'id' => $id,
            'alf_name_school' => $alf_name_school

        );


        return view('ischool.Teacher.grades',$data);
    }


    public function uploadImages($id ,$idt)
    {
        $decrypted = decrypt($id);
        $studeninfo = DB::table('alf_student_info')
        ->where('student_code_id',$decrypted)
        ->first();
        $imgName = request()->file->getClientOriginalName();
        request()->file->move(public_path('images'), $imgName);
        DB::table('alf_grade')->insert([
        'id_studens' =>$decrypted,
        'id_school' =>  $studeninfo->name_school,
        'image' => $imgName,
        'id_term' => $idt,
        'created_by' => Auth::user()->username,
        'created_at' => Carbon::now(),
        ]);
        $output = array('uploaded' => 'OK' );
        return response()->json($output);

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
