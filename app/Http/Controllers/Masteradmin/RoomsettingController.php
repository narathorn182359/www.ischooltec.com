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

class RoomsettingController extends Controller
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
        return view('ischool.masteradmin.mgRoomSetting',$data);
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

                if(  $value->id_username_tc_rm != ""){

                    $checkcard = DB::table('alf_room_consult')->where('id_username_tc_rm', $value->id_username_tc_rm)->count();
                    if( $checkcard == 0){
                        $arr[] = [
                            'id_username_tc_rm' =>strval($value->id_username_tc_rm),
                            'room_rm' => strval($value->room_rm),
                            'section_rm' => strval($value->section_rm),
                            'school_rm' => strval($value->school_rm),
                            'class_rm' => strval($value->class_rm),
                            'created_by' =>Auth::user()->username,
                            'created_at' =>Carbon::now()
                          ];
                    }else{
                        DB::table('alf_room_consult')
                        ->where('id_username_tc_rm', $value->id_username_tc_rm)
                        ->update([
                            'id_username_tc_rm' =>strval($value->id_username_tc_rm),
                            'room_rm' => strval($value->room_rm),
                            'section_rm' => strval($value->section_rm),
                            'school_rm' => strval($value->school_rm),
                            'class_rm' => strval($value->class_rm),
                            'update_by' =>Auth::user()->username,
                            'updated_at' =>Carbon::now()
                          ]);



                    }

                }

            }

            if(!empty($arr))
            {
             DB::table('alf_room_consult')->insert($arr);
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
        //
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
        DB::table('alf_room_consult')->where('id_consult',$id)->delete();
        return response()->json(['error' => false,], 200);
    }



    public function data(Request $request)
    {
        $columns = array(
            0 => 'room_rm',
            1 => 'section_rm',
            2 => 'school_rm',
            3 => 'name_tc',
            4 => 'name_class'


        );

        $totalData = DB::table('alf_room_consult')->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {

            $posts = DB::table('alf_room_consult')
                 ->leftJoin('alf_teacher_info', 'alf_room_consult.id_username_tc_rm', '=', 'alf_teacher_info.username_id_tc')
                 ->leftJoin('alf_name_school', 'alf_teacher_info.school_teacher', '=', 'alf_name_school.id') 
                 ->leftJoin('alf_class_student', 'alf_room_consult.class_rm', '=', 'alf_class_student.id_s') 
                 ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

        } else {

            $search = $request->input('search.value');
            $posts = DB::table('alf_room_consult')
                ->leftJoin('alf_teacher_info', 'alf_room_consult.id_username_tc_rm', '=', 'alf_teacher_info.username_id_tc')
                ->leftJoin('alf_name_school', 'alf_teacher_info.school_teacher', '=', 'alf_name_school.id') 
                ->leftJoin('alf_class_student', 'alf_room_consult.class_rm', '=', 'alf_class_student.id_s') 
                ->Where('section_rm', 'LIKE', "%{$search}%")
                ->orWhere('school_rm', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = DB::table('alf_room_consult')
                 ->leftJoin('alf_teacher_info', 'alf_room_consult.id_username_tc_rm', '=', 'alf_teacher_info.username_id_tc')
                 ->leftJoin('alf_name_school', 'alf_teacher_info.school_teacher', '=', 'alf_name_school.id') 
                 ->leftJoin('alf_class_student', 'alf_room_consult.class_rm', '=', 'alf_class_student.id_s') 
                 ->Where('section_rm', 'LIKE', "%{$search}%")
                ->orWhere('school_rm', 'LIKE', "%{$search}%")
                ->count();

        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['name_class'] = $post->name_class;
                $nestedData['room_rm'] = $post->room_rm;
                $nestedData['section_rm'] = $post->section_rm;
                $nestedData['school_rm'] = $post->name_school_a;
                $nestedData['name_tc'] = $post->titel_teacher. $post->name_teacher. $post->lastname_teacher;
                $nestedData['options'] = "
                      
                          &emsp;<a href='javascript:void(0)' class='btn btn-danger btn-circle btn-xs  deleteRoom' data-id='{$post->id_consult}'>ลบ</a>";
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        echo json_encode($json_data);
    }











}
