<?php

namespace App\Http\Controllers\AdminSchool;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
class ManageNewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $school = DB::table('alf_adminschool_info')->where('username_id',Auth::user()->username)->get();
        
        $listgetnew = DB::table('alf_public_relations')->where('id_school',$school[0]->school_adminschool)->orderBy('created_at','DESC')->get();
        $class_school = DB::table('alf_class_student')->get();
        $alf_name_school = DB::table('alf_name_school')
        ->where('id',$school[0]->school_adminschool)
        ->first();

        $data = array(
            'listmenu'=>$listmenu,
             'listgetnew'=> $listgetnew,
             'class_school' => $class_school,
             'alf_name_school' => $alf_name_school
             );


        return view('ischool.adminschool.public_relations', $data);
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
        
        $school = DB::table('alf_adminschool_info')->where('username_id',Auth::user()->username)->get();
        $filename ="default-image.png";
        if($request->file('fileimg')){
            $extension = $request->file('fileimg');
            $filename = 'school'.$school[0]->school_adminschool.'_' . time() . '.' . $extension->getClientOriginalExtension();
            $request->file('fileimg')->move(public_path('imguploadnew'), $filename);

        }
         

      if($request->id_new == "0"){
          
        DB::table('alf_public_relations')->insert(
            [ 'id_school' => $school[0]->school_adminschool,
              'class_id' => $request->class_id,
              'headnew' =>$request->headnew,
              'text' => $request->detailnew,
              'img' =>$filename ,
              'created_at' => Carbon::now()
             ]
        );
      }else{
        DB::table('alf_public_relations')
        ->where('id', $request->id_new )
        ->update(
            ['id_school' => $school[0]->school_adminschool,
              'headnew' =>$request->headnew,
             'text' => $request->detailnew,
             'class_id' => $request->class_id,
             'img' =>$filename ,
             'updated_at' => Carbon::now()
             ]
        );
      }
     
        return response()->json(['error' => false,], 200);
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
         
        $data = DB::table('alf_public_relations')->Where('id',$id)->get();



          return response()->json($data);
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
        DB::table('alf_public_relations')->where('id',$id)->delete();
        return response()->json(['error' => false,], 200);
    }
}
