<?php
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/getStundenInfo', function (Request $request) {
    $user = $request->user();
    $getinfopar = DB::table('alf_parent_info')->where('username_id',$user->username)->first();
    $getinfotc = DB::table('alf_teacher_info')->where('username_id_tc',$user->username)->first();
    if(isset($getinfopar)){
        $getuserstudent = DB::table('alf_student_info')
        ->leftJoin('alf_name_school', 'alf_student_info.name_school', '=', 'alf_name_school.id')
        ->where('student_code_id',$getinfopar->student_parent)
        ->first();
    }
    if(isset($getinfotc)){
        $getuserstudent = DB::table('alf_teacher_info')
        ->leftJoin('alf_name_school', 'alf_teacher_info.school_teacher', '=', 'alf_name_school.id')
        ->where('username_id_tc',$getinfotc->username_id_tc)
        ->first();
    }

    return response()->json($getuserstudent);
});

Route::middleware('auth:api')->get('/getUserInfo', function (Request $request) {
    $user = $request->user();
    $getinfopar = DB::table('alf_parent_info')->where('username_id',$user->username)->first();

    $getinfotc = DB::table('alf_teacher_info')->where('username_id_tc',$user->username)->first();
     if(isset($getinfopar)){
             $data = $getinfopar;
     }
     if(isset($getinfotc)){
        $data = $getinfotc;
    }
    return response()->json($data);
});




Route::middleware('auth:api')->get('/UserLisrMenu', function (Request $request) {
    $user = $request->user();
    $data= DB::table('alf_role_auth')
    ->leftJoin('alf_notification_user', 'alf_role_auth.id', '=', 'alf_notification_user.menu_noti')
    ->where('group_id',$user->user_group)
    ->where('username_noti',$user->username)
    ->get();
    return response()->json($data);
});



Route::middleware('auth:api')->get('/dataTerm', function (Request $request) {
    $user = $request->user();
    $data= DB::table('alf_term')->get();
    return response()->json($data);
});

Route::middleware('auth:api')->get('/dataMonth', function (Request $request) {
    $user = $request->user();
    $data= DB::table('alf_month')->get();
    return response()->json($data);
});

Route::middleware('auth:api')->get('/dataStatus', function (Request $request) {
    $user = $request->user();
    $data= DB::table('alf_status')->get();
    return response()->json($data);
});


Route::middleware('auth:api')->get('/dataStatus', function (Request $request) {
    $user = $request->user();
    $data= DB::table('alf_status_student')->get();
    return response()->json($data);
});



Route::middleware('auth:api')->get('/public-relations', function (Request $request) {
    $user = $request->user();
    $listinfo = DB::table('alf_parent_info')->where('username_id',$user->username)->first();
    $relations = DB::table('alf_public_relations')->where('id_school',$listinfo->school_parent)->orderBy('created_at','DESC')->get();
    return response()->json($relations);
});

Route::middleware('auth:api')->get('/public-relations-tc', function (Request $request) {
    $user = $request->user();
    $listinfo = DB::table('alf_teacher_info')->where('username_id_tc',$user->username)->first();
    $relations = DB::table('alf_public_relations')->where('id_school',$listinfo->school_teacher)->orderBy('created_at','DESC')->get();
    return response()->json($relations);
});


Route::middleware('auth:api')->post('/searchdata', function (Request $request) {
    $data = $request->json()->all();
    $user = $request->user();
    $getinfopar = DB::table('alf_parent_info')->where('username_id',$user->username)->first();
    $getuserstudent = DB::table('alf_student_info')
    ->leftJoin('alf_name_school', 'alf_student_info.name_school', '=', 'alf_name_school.id')
    ->where('student_code_id',$getinfopar->student_parent)
    ->first();
    $term_active = DB::table('alf_term_active')->where('active','Y')
    ->where('name_school_id',$getinfopar->school_parent)
   ->first();

   if($data['searchTerm'] != "" && $data['searchMonth'] != "" &&  $data['searchStatus'] != "" ){
    $json= DB::table('alf_timeattendance_student')
    ->leftJoin('alf_student_info','alf_timeattendance_student.code_student','=','alf_student_info.student_code_id')
    ->leftJoin('alf_degree_student', 'alf_degree_student.id', '=', 'alf_student_info.degree')
    ->leftJoin('alf_class_student', 'alf_class_student.id_s', '=', 'alf_student_info.class')
    ->leftJoin('alf_name_school', 'alf_name_school.id', '=', 'alf_student_info.name_school')
    ->leftJoin('alf_status_student', 'alf_timeattendance_student.code_status', '=', 'alf_status_student.id')
    ->where('code_term',$data['searchTerm'])
    ->where('code_status',$data['searchMonth'])
    ->where('code_month',$data['searchStatus'])
    ->where('code_student', $getuserstudent->student_code_id)
    ->where('name_school',$getinfopar->school_parent)
    ->get();


   }else{
    $json= DB::table('alf_timeattendance_student')
    ->leftJoin('alf_student_info','alf_timeattendance_student.code_student','=','alf_student_info.student_code_id')
    ->leftJoin('alf_degree_student', 'alf_degree_student.id', '=', 'alf_student_info.degree')
    ->leftJoin('alf_class_student', 'alf_class_student.id_s', '=', 'alf_student_info.class')
    ->leftJoin('alf_name_school', 'alf_name_school.id', '=', 'alf_student_info.name_school')
    ->leftJoin('alf_status_student', 'alf_timeattendance_student.code_status', '=', 'alf_status_student.id')
    ->where('code_term',$term_active->name_term_id)
    ->where('code_month',date("m"))
    ->where('code_student', $getuserstudent->student_code_id)
    ->where('name_school',$getinfopar->school_parent)
    ->get();
   }

    return response($json,200)->header('Content-Type', 'application/json');
});


Route::middleware('auth:api')->post('/searchdata2', function (Request $request) {
    $data = $request->json()->all();
    $user = $request->user();
    $getinfopar = DB::table('alf_parent_info')->where('username_id',$user->username)->first();
    $getuserstudent = DB::table('alf_student_info')
    ->leftJoin('alf_name_school', 'alf_student_info.name_school', '=', 'alf_name_school.id')
    ->where('student_code_id',$getinfopar->student_parent)
    ->first();
    $term_active = DB::table('alf_term_active')->where('active','Y')
    ->where('name_school_id',$getinfopar->school_parent)
   ->first();
   $json= DB::table('alf_timeattendance_student')
   ->leftJoin('alf_student_info','alf_timeattendance_student.code_student','=','alf_student_info.student_code_id')
   ->leftJoin('alf_degree_student', 'alf_degree_student.id', '=', 'alf_student_info.degree')
   ->leftJoin('alf_class_student', 'alf_class_student.id_s', '=', 'alf_student_info.class')
   ->leftJoin('alf_name_school', 'alf_name_school.id', '=', 'alf_student_info.name_school')
   ->leftJoin('alf_status_student', 'alf_timeattendance_student.code_status', '=', 'alf_status_student.id')
   ->where('code_student', $getuserstudent->student_code_id)
   ->where('name_school',$getinfopar->school_parent)
   ->get();
    return response($json,200)->header('Content-Type', 'application/json');
});






Route::middleware('auth:api')->get('/getlisstudentroom_tc', function (Request $request) {
    $user = $request->user();
    $user_data  =  DB::table('users')
    ->leftJoin('alf_teacher_info', 'users.username', '=', 'alf_teacher_info.username_id_tc')
    ->where('username',$user->username)
    ->first();


    $liststuden = DB::table('alf_student_info')
    ->leftJoin('alf_degree_student', 'alf_degree_student.id', '=', 'alf_student_info.degree')
    ->leftJoin('alf_class_student', 'alf_class_student.id_s', '=', 'alf_student_info.class')
    ->leftJoin('alf_name_school', 'alf_name_school.id', '=', 'alf_student_info.name_school')
    ->where('consult',$user_data->username)
    ->where('name_school',$user_data->school_teacher)
    ->where('degree',$user_data->school_section)
    ->where('room',$user_data->school_room)
    ->paginate(15);
    return response()->json($liststuden);
});



Route::middleware('auth:api')->post('/searchdata_detail_time', function (Request $request) {
    $data = $request->json()->all();
    $user = $request->user();
    $getinfopar = DB::table('alf_teacher_info')->where('username_id_tc',$user->username)->first();
    $getuserstudent = DB::table('alf_student_info')
    ->leftJoin('alf_name_school', 'alf_student_info.name_school', '=', 'alf_name_school.id')
    ->where('student_code_id',$data['code_student'])
    ->where('name_school',$getinfopar->school_teacher)
    ->first();
    $term_active = DB::table('alf_term_active')->where('active','Y')
    ->where('name_school_id',$getinfopar->school_teacher)
   ->first();

   if($data['term'] != "" && $data['month'] != "" &&  $data['status'] != "" ){
    $json= DB::table('alf_timeattendance_student')
    ->leftJoin('alf_student_info','alf_timeattendance_student.code_student','=','alf_student_info.student_code_id')
    ->leftJoin('alf_degree_student', 'alf_degree_student.id', '=', 'alf_student_info.degree')
    ->leftJoin('alf_class_student', 'alf_class_student.id_s', '=', 'alf_student_info.class')
    ->leftJoin('alf_name_school', 'alf_name_school.id', '=', 'alf_student_info.name_school')
    ->leftJoin('alf_status_student', 'alf_timeattendance_student.code_status', '=', 'alf_status_student.id')
    ->where('code_term',$data['term'])
    ->where('code_status',$data['status'])
    ->where('code_month',$data['month'])
    ->where('code_student', $getuserstudent->student_code_id)
    ->where('name_school',$getinfopar->school_teacher)
    ->paginate(15);
}else{
    $json= DB::table('alf_timeattendance_student')
    ->leftJoin('alf_student_info','alf_timeattendance_student.code_student','=','alf_student_info.student_code_id')
    ->leftJoin('alf_degree_student', 'alf_degree_student.id', '=', 'alf_student_info.degree')
    ->leftJoin('alf_class_student', 'alf_class_student.id_s', '=', 'alf_student_info.class')
    ->leftJoin('alf_name_school', 'alf_name_school.id', '=', 'alf_student_info.name_school')
    ->leftJoin('alf_status_student', 'alf_timeattendance_student.code_status', '=', 'alf_status_student.id')
   // ->where('code_term',$term_active->name_term_id)
    //->where('code_month',date("m"))
    ->where('code_student', $getuserstudent->student_code_id)
    ->where('name_school',$getinfopar->school_teacher)
    ->paginate(15);



}
    return response($json,200)->header('Content-Type', 'application/json');
});


Route::middleware('auth:api')->get('/term_active', function (Request $request) {

    $user = $request->user();
    $getinfopar = DB::table('alf_parent_info')->where('username_id',$user->username)->first();
    $getinfotc = DB::table('alf_teacher_info')->where('username_id_tc',$user->username)->first();
     if(isset($getinfopar)){

             $data= DB::table('alf_name_school')
             ->leftJoin('alf_term_active', 'alf_name_school.id', '=', 'alf_term_active.name_school_id')
             ->leftJoin('alf_term', 'alf_term_active.name_term_id', '=', 'alf_term.id_term')
             ->Where('name_school_id', $getinfopar->school_parent)
             ->Where('active','Y')
             ->first();
     }
     if(isset($getinfotc)){

        $data= DB::table('alf_name_school')
        ->leftJoin('alf_term_active', 'alf_name_school.id', '=', 'alf_term_active.name_school_id')
        ->leftJoin('alf_term', 'alf_term_active.name_term_id', '=', 'alf_term.id_term')
        ->Where('name_school_id',$getinfotc->school_teacher)
        ->Where('active','Y')
        ->first();
    }




    return response()->json($data);
});

Route::middleware('auth:api')->get('/deletenoti', function (Request $request) {
    $user = $request->user();
    DB::table('alf_notification_user')
    ->Where('username_noti',$user->username)
    ->Where('menu_noti','11')
    ->update(['count_noti' => 0]);
    
    DB::table('alf_notification_user')
    ->Where('username_noti',$user->username)
    ->Where('menu_noti','18')
    ->update(['count_noti' => 0]);

    return response()->json($user);
});


Route::middleware('auth:api')->post('/password_ch', function (Request $request) {
    $user = $request->user();
    $data = $request->json()->all();
    if (Hash::check($data['password_old'], $user->password)) {
        DB::table('users')
        ->where('username', $user->username)
        ->update(['password' => Hash::make($data['password_new'])]);


        return response()->json([
            'success' => '200'
        ]);
    }else

    {
        return response()->json([
            'success' => "404"
        ]);
    }


});


Route::middleware('auth:api')->get('/get_in', function (Request $request) {
    $user = $request->user();
   $data = DB::table('alf_timeattendance_student')
    ->Where('inOrOut','1')
    ->whereDate('date', Carbon::today())
    ->first();


    return response()->json( $data);
});


Route::middleware('auth:api')->get('/get_out', function (Request $request) {
    $user = $request->user();
    $data =  DB::table('alf_timeattendance_student')
    ->Where('inOrOut','2')
    ->whereDate('date', Carbon::today())
    ->first();


    return response()->json($data);
});



Route::middleware('auth:api')->get('/get_techer', function (Request $request) {
    $user = $request->user();
    $getinfopar = DB::table('alf_parent_info')->where('username_id',$user->username)->first();
    $getuserstudent = DB::table('alf_student_info')
        ->leftJoin('alf_name_school', 'alf_student_info.name_school', '=', 'alf_name_school.id')
        ->where('student_code_id',$getinfopar->student_parent)
        ->first();

    $gettecher = DB::table('alf_teacher_info')
    ->where('username_id_tc', $getuserstudent->consult)
    ->first();

    return response()->json($gettecher);
});



Route::middleware('auth:api')->post('/save_key_player', function (Request $request) {

    $data = $request->json()->all();
    $user = $request->user();

    $alf_key_notification = DB::table('alf_key_notification')
        ->where('player_id', $data['key'])
        ->count();
    if( $alf_key_notification > 0){
        DB::table('alf_key_notification')
        ->where('player_id', $data['key'])
        ->update([
         'player_id'  =>  $data['key'],
         'code_reg' => $user->username,
         'login_status' => '1',
        ]);

    }
    else
    {
        DB::table('alf_key_notification')
        ->insert([
         'player_id'  =>  $data['key'],
         'code_reg' => $user->username,
         'login_status' => '1',
        ]);
    }

    return response()->json("200");

});

Route::middleware('auth:api')->post('/logout_key', function (Request $request) {

    $data = $request->json()->all();
    $user = $request->user();
    DB::table('alf_key_notification')
    ->where('player_id', $data['key'])
    ->update([

     'login_status' => '0'
    ]);


});

Route::post('register', 'Api\RegisterController@register');




Route::middleware('auth:api')->get('/get_room_techer', function (Request $request) {
    $user = $request->user();
    $data = DB::table('alf_room_consult')
    ->leftJoin('alf_teacher_info', 'alf_room_consult.id_username_tc_rm', '=', 'alf_teacher_info.username_id_tc')
    ->leftJoin('alf_name_school', 'alf_teacher_info.school_teacher', '=', 'alf_name_school.id') 
    ->leftJoin('alf_class_student', 'alf_room_consult.class_rm', '=', 'alf_class_student.id_s') 
    ->select('name_class','room_rm','id_s','name_school_a','school_rm')
    ->where('id_username_tc_rm',$user->username)->get();

    return response()->json(['data'=>$data]);
});


Route::middleware('auth:api')->post('/getlisstudentroom_tc_new', function (Request $request) {
    $user = $request->user();
    $data = $request->json()->all();


    $liststuden = DB::table('alf_student_info')
    ->leftJoin('alf_degree_student', 'alf_degree_student.id', '=', 'alf_student_info.degree')
    ->leftJoin('alf_class_student', 'alf_class_student.id_s', '=', 'alf_student_info.class')
    ->leftJoin('alf_name_school', 'alf_name_school.id', '=', 'alf_student_info.name_school')
   
    ->where('name_school',$data['school_teacher'])
    ->where('class',$data['school_section'])
    ->where('room',$data['school_room'])
    ->paginate(15);
    return response()->json($liststuden);
});

