<?php

namespace App\Http\Controllers\Masteradmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ManageSchoolController extends Controller
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
        $nameschool = DB::table('alf_name_school')->paginate(15);

        $data = array(
                    'listmenu'=>$listmenu,
                    'nameschool' =>  $nameschool,

                     );

        return view('ischool.masteradmin.mgSchool',$data);
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
        if( $request->id_school == ''){
            DB::table('alf_name_school')->insert(
                ['name_school_a' => $request->name_school,
                 'address' => $request->address,
                 'email' => $request->email,
                 'phone' =>$request->phone,
                 'created_by' => Auth::user()->username,
                 'created_at' => Carbon::now()
                 ]
            );
        }
        else{
            DB::table('alf_name_school')
            ->where('id', $request->id_school )
            ->update( ['name_school_a' => $request->name_school,
            'address' => $request->address,
            'email' => $request->email,
            'phone' =>$request->phone,
            'update_by' => Auth::user()->username,
            'updated_at' => Carbon::now()
            ]);

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
        $data= DB::table('alf_name_school')->where('id', $id )->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $data= DB::table('alf_name_school')->where('id', $id )->get();
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


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('alf_name_school')->where('id',$id)->delete();
        return response()->json(['error' => false,], 200);
    }


    public function index_term()
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $nameschool = DB::table('alf_name_school')
        ->leftJoin('alf_term_active', 'alf_name_school.id', '=', 'alf_term_active.name_school_id')
        ->leftJoin('alf_term', 'alf_term_active.name_term_id', '=', 'alf_term.id_term')
        ->orWhere('active','Y')
        ->paginate(15);
        $list_term = DB::table('alf_term')->get();
        $data = array(
                    'listmenu'=>$listmenu,
                    'nameschool' =>  $nameschool,
                    'list_term' =>  $list_term,
                     );
        return view('ischool.masteradmin.mgTerm',$data);
    }

    public function add_term(Request $request)
    {
        DB::table('alf_term_active')
        ->where('name_school_id',  $request->id_school, )
        ->where('active',  "Y", )
        ->update( [ 'active' => "N",
        'created_by' => Auth::user()->username,
        'created_at' => Carbon::now()
        ]);
       

        DB::table('alf_term_active')->insert(
            ['name_school_id' => $request->id_school,
             'name_term_id' => $request->term,
             'active' => "Y",
             'created_by' => Auth::user()->username,
             'created_at' => Carbon::now()
             ]
        );
     return response()->json(['error' => false,], 200);
    }

   
    public function  add_Newterm(Request $request)
    {
     
        if($request->id_term == ''){
            DB::table('alf_term')->insert(
                ['term' => $request->add_Newterm,
                 'created_by' => Auth::user()->username,
                 'created_at' => Carbon::now()
                 ]
            );
        }else{
            DB::table('alf_term')
            ->where('id',  $request->id_school, )
            ->update(  ['term' => $request->add_term,
            'update_by' => Auth::user()->username,
            'updated_at' => Carbon::now()
            ]);
        }
      




     return response()->json(['error' => false,], 200);
    }

}
