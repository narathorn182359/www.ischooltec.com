<?php

namespace App\Http\Controllers\Masteradmin;

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
use Excel;

class ManageStudenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:masteradmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $nameschool = DB::table('alf_name_school')

        ->whereNotIn('id',[1])->paginate(15);

        $data = array(
                    'listmenu'=>$listmenu,
                    'nameschool' =>  $nameschool,

                     );
//dd($user);
        return view('ischool.masteradmin.mgStudent',$data);
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


        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
           ]);

           $path = $request->file('select_file')->getRealPath();

           $data = Excel::load($path)->get();
           if($data->count()){
            foreach ($data as $key => $value) {

                if(  $value->student_code_id != ""){

                    $checkcard = DB::table('alf_student_info')->where('student_code_id', $value->student_code_id)->count();
                    if( $checkcard == 0){
                        $arr[] = [
                            'img_student' => $value->img_student,
                            'student_code_id' => $value->student_code_id,
                            'title' => $value->title,
                            'name' => $value->name,
                            'lastname' => $value->lastname,
                            'degree' => $value->degree,
                            'class' => $value->class,
                            'room' => $value->room,
                            'name_school' => $value->name_school,
                            'birthday' => $value->birthday,
                            'nationality' => $value->nationality,
                            'tel' => $value->tel,
                            'email' => $value->email,
                            'address' => $value->address,
                            'father' => $value->father,
                            'father_tel' => $value->father_tel,
                            'mom' => $value->mom,
                            'mom_tel' => $value->mom_tel,
                            'consult' => $value->consult,
                            'created_by' =>Auth::user()->username,
                            'created_at' =>Carbon::now()
                          ];
                    }else{
                        DB::table('alf_student_info')
                        ->where('student_code_id', $value->student_code_id)
                        ->update([
                            'img_student' => $value->img_student,
                            'student_code_id' => $value->student_code_id,
                            'title' => $value->title,
                            'name' => $value->name,
                            'lastname' => $value->lastname,
                            'degree' => $value->degree,
                            'class' => $value->class,
                            'room' => $value->room,
                            'name_school' => $value->name_school,
                            'birthday' => $value->birthday,
                            'nationality' => $value->nationality,
                            'tel' => $value->tel,
                            'email' => $value->email,
                            'address' => $value->address,
                            'father' => $value->father,
                            'father_tel' => $value->father_tel,
                            'mom' => $value->mom,
                            'mom_tel' => $value->mom_tel,
                            'consult' => $value->consult,
                            'update_by' =>Auth::user()->username,
                            'updated_at' =>Carbon::now()
                          ]);



                    }

                }

            }

            if(!empty($arr))
            {
             DB::table('alf_student_info')->insert($arr);
            }
        }

        return back()->with('success', 'Insert Record successfully.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $getstudent = DB::table('alf_student_info')->where('student_code_id',$id)->get();


        return response()->json($getstudent);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $liststudent = DB::table('alf_student_info')
        ->leftJoin('alf_degree_student', 'alf_degree_student.id', '=', 'alf_student_info.degree')
        ->where('name_school',Crypt::decrypt($id))->paginate(15);
        $getschool = DB::table('alf_name_school')
        ->whereNotIn('id',[1])->get();
        $listteacher= DB::table('alf_teacher_info')->where('school_teacher',Crypt::decrypt($id))->get();


        $data = array(
                    'listmenu'    =>  $listmenu,
                    'liststudent' =>  $liststudent,
                    'getschool'   =>  $getschool,
                    'listteacher' =>  $listteacher
                     );

        return view('ischool.masteradmin.mgStudentShow',$data);
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
        DB::table('alf_student_info')
            ->where('student_code_id', $request->student_code_id )
            ->update(
            ['img_student' => $request->img_student,
             'student_code_id' => $request->student_code_id,
             'title' => $request->title,
             'name' =>$request->name,
             'lastname' => $request->lastname,
             'degree' => $request->degree,
             'room' =>$request->room,
             'name_school' => $request->name_school,
             'card_number' => $request->card_number,
             'birthday' => $request->birthday,
             'nationality' =>$request->nationality,
             'race' => $request->race,
             'tel' => $request->tel,
             'email' => $request->email,
             'address' =>$request->address,
             'father' => $request->father,
             'father_tel' => $request->father_tel,
             'mom' => $request->mom,
             'mom_tel' =>$request->mom_tel,
             'consult' =>$request->consult,
             'class' => $request->classroom,
             'created_by' => Auth::user()->username,
             'created_at' => Carbon::now()
             ]
        );
        return response()->json(['error' => false,], 200);
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
}
