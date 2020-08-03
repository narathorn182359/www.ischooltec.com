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

class ScheduleController extends Controller
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
        $data = array(
            'listmenu'=>$listmenu
                 );

        return view('ischool.Teacher.class_schedule',$data);
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
        //
    }

    public function index_public_relations_tc(){
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $listinfo = DB::table('alf_teacher_info')->where('username_id_tc',Auth::user()->username)->first(); 

        $relations = DB::table('alf_public_relations')->where('id_school',$listinfo->school_teacher)->orderBy('created_at','DESC')->get();
        $data = array('listmenu'=>$listmenu,
                       'relations' => $relations
    
                       );
        return view('ischool.Teacher.public_relations_tc',$data);

     

    }

  

    public function   index_contact_school_tc(){
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $data = array(
            'listmenu'=>$listmenu
                 );

        return view('ischool.Teacher.contact_school_tc',$data);



    }


}
