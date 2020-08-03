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


class ManageUserController extends Controller
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

        $user = DB::table('users')
       ->leftJoin('alf_adminmaster_info', 'users.username', '=', 'alf_adminmaster_info.username_id')
       ->leftJoin('alf_adminschool_info', 'users.username', '=', 'alf_adminschool_info.username_id')
       ->leftJoin('alf_parent_info', 'users.username', '=', 'alf_parent_info.username_id')
       ->leftJoin('alf_teacher_info', 'users.username', '=', 'alf_teacher_info.username_id_tc')
       ->paginate(15);



        $namestudent = DB::table('alf_student_info')->get();
        $namegroup = DB::table('alf_users_group')->get();
        $nameschool = DB::table('alf_name_school')->get();
        $data = array(
                    'listmenu'=>$listmenu,
                    'user' =>  $user,
                    'namegroup' =>  $namegroup,
                    'nameschool' => $nameschool
                     );
//dd($user);
        return view('ischool.masteradmin.mgUser',$data);
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
        if( $request->user_id == ''){
            if($request->user_group == '1'){
                DB::table('alf_adminmaster_info')->insert(
                    ['username_id' => $request->username,
                     'titel_adminmaster' => $request->titel,
                     'name_adminmaster' => $request->name,
                     'lastname_adminmaster' =>$request->lastname,
                     'phone_adminmaster' =>$request->phone,
                     'school_adminmaster' =>$request->school,
                     'created_by' => Auth::user()->username,
                     'created_at' => Carbon::now()
                     ]
                );
                   //DB::table('users')->insert(
                //    ['username' => $request->username,
                //     'password' => Hash::make($request->password),
                //     'user_group' =>$request->user_group,
               //      'created_at' => Carbon::now()
                     //]
               // );
                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
                $user = User::create($input);
                $user->assignRole('masteradmin');
                $nati = DB::table('alf_role_auth')->where("group_id","1")->get();
                foreach($nati as $item){
                    DB::table('alf_notification_user')->insert(
                        ['menu_noti' => $item->id,
                         'username_noti' => $request->username,
                         'count_noti' => "0",
                         'school_noti' =>$request->school
                        
                         ]
                    );
                }

            }
             else if($request->user_group == '2'){
                DB::table('alf_adminschool_info')->insert(
                    ['username_id' => $request->username,
                     'titel_adminschool' => $request->titel,
                     'name_adminschool' => $request->name,
                     'lastname_adminschool' =>$request->lastname,
                     'phone_adminschool' =>$request->phone,
                     'school_adminschool' =>$request->school,
                     'created_by' => Auth::user()->username,
                     'created_at' => Carbon::now()
                     ]
                );
                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
                $user = User::create($input);
                $user->assignRole('adminschool');
                $nati = DB::table('alf_role_auth')->where("group_id","2")->get();
                foreach($nati as $item){
                    DB::table('alf_notification_user')->insert(
                        ['menu_noti' => $item->id,
                         'username_noti' => $request->username,
                         'count_noti' => "0",
                         'school_noti' =>$request->school
                       
                         ]
                    );
                }

            }

            else  if($request->user_group == '3'){
                DB::table('alf_parent_info')->insert(
                    ['username_id' => $request->username,
                     'titel_parent' => $request->titel,
                     'name_parent' => $request->name,
                     'lastname_parent' =>$request->lastname,
                     'phone_parent' =>$request->phone,
                     'school_parent' =>$request->school,
                     'student_parent' =>$request->id_student,
                     'created_by' => Auth::user()->username,
                     'created_at' => Carbon::now()
                     ]
                );
                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
                $user = User::create($input);
                $user->assignRole('parent');
                $nati = DB::table('alf_role_auth')->where("group_id","3")->get();
                foreach($nati as $item){
                    DB::table('alf_notification_user')->insert(
                        ['menu_noti' => $item->id,
                         'username_noti' => $request->username,
                         'count_noti' => "0",
                         'school_noti' =>$request->school
                    
                         ]
                    );
                }


            }

            else
            {
                DB::table('alf_teacher_info')->insert(
                    ['username_id_tc' => $request->username,
                     'titel_teacher' => $request->titel,
                     'name_teacher' => $request->name,
                     'lastname_teacher' =>$request->lastname,
                     'phone_teacher' =>$request->phone,
                     'school_teacher' =>$request->school,
                     'school_section' =>$request->section,
                     'school_room' =>$request->room,
                     'created_by' => Auth::user()->username,
                     'created_at' => Carbon::now()
                     ]
                );
                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
                $user = User::create($input);
                $user->assignRole('teacher');

                DB::table('alf_student_info')
                ->where('class', $request->section )
                ->where('room', $request->room )
                ->where('name_school',$request->school )
                ->update(
                    ['consult' => $request->username

                     ]);

            }
        }

        else
         {
            if($request->user_group == '1'){
                DB::table('alf_adminmaster_info')
                ->where('id_adminmaster', $request->info_id )
                ->update(
                    ['username_id' => $request->username,
                     'titel_adminmaster' => $request->titel,
                     'name_adminmaster' => $request->name,
                     'lastname_adminmaster' =>$request->lastname,
                     'phone_adminmaster' =>$request->phone,
                     'school_adminmaster' =>$request->school,
                     'update_by' => Auth::user()->username,
                     'updated_at' => Carbon::now()
                     ]
                );
                DB::table('users')
                ->where('id', $request->user_id )
                ->update(
                    ['username' => $request->username,
                     'user_group' =>$request->user_group,
                     'updated_at' => Carbon::now()
                     ]
                );
            }
             else if($request->user_group == '2'){
                DB::table('alf_adminschool_info')
                ->where('id_adminschool', $request->info_id )
                ->update(
                    ['username_id' => $request->username,
                     'titel_adminschool' => $request->titel,
                     'name_adminschool' => $request->name,
                     'lastname_adminschool' =>$request->lastname,
                     'phone_adminschool' =>$request->phone,
                     'school_adminschool' =>$request->school,
                     'update_by' => Auth::user()->username,
                     'updated_at' => Carbon::now()
                     ]
                );
                DB::table('users')
                ->where('id', $request->user_id )
                ->update(
                    ['username' => $request->username,
                     'password' => Hash::make($request->password),
                     'user_group' =>$request->user_group,
                     'updated_at' => Carbon::now()
                     ]
                );


            }

            else  if($request->user_group == '3'){
                DB::table('alf_parent_info')
                ->where('id_parent', $request->info_id )
                ->update(
                    ['username_id' => $request->username,
                     'titel_parent' => $request->titel,
                     'name_parent' => $request->name,
                     'lastname_parent' =>$request->lastname,
                     'phone_parent' =>$request->phone,
                     'school_parent' =>$request->school,
                     'student_parent' =>$request->id_student,
                     'update_by' => Auth::user()->username,
                     'updated_at' => Carbon::now()
                     ]
                );
                DB::table('users')
                ->where('id', $request->user_id )
                ->update(
                    ['username' => $request->username,
                     'password' => Hash::make($request->password),
                     'user_group' =>$request->user_group,
                     'updated_at' => Carbon::now()
                     ]
                );


            }

            else{
                DB::table('alf_teacher_info')
                ->where('id_teacher', $request->info_id )
                ->update(
                    ['username_id_tc' => $request->username,
                     'titel_teacher' => $request->titel,
                     'name_teacher' => $request->name,
                     'lastname_teacher' =>$request->lastname,
                     'phone_teacher' =>$request->phone,
                     'school_section' =>$request->section,
                     'school_room' =>$request->room,
                     'school_teacher' =>$request->school,
                     'update_by' => Auth::user()->username,
                     'updated_at' => Carbon::now()
                     ]
                );
                DB::table('users')
                ->where('id', $request->user_id )
                   ->update(
                    ['username' => $request->username,
                     
                     'user_group' =>$request->user_group,
                     'updated_at' => Carbon::now()
                     ]
                );
             DB::table('alf_student_info')
                ->where('class', $request->section )
                ->where('room', $request->room )
                ->where('name_school',$request->school )
                ->update(
                    ['consult' => $request->username

                     ]
                );

            }
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
        $count1 =   DB::table('alf_adminmaster_info')->where('username_id', $id )->count();
        $count2 =   DB::table('alf_adminschool_info')->where('username_id', $id )->count();
        $count3 =   DB::table('alf_parent_info')->where('username_id', $id )->count();
        $count4 =   DB::table('alf_teacher_info')->where('username_id_tc', $id )->count();
          if($count1 > 0){
          $masteradmin  = DB::table('users')
          ->leftJoin('alf_adminmaster_info', 'users.username', '=', 'alf_adminmaster_info.username_id')
          ->where('username_id', $id )->get();

            return response()->json([
                'id' =>  $masteradmin[0]->id,
                'id_info' =>  $masteradmin[0]->id_adminmaster,
                'user_group' =>  $masteradmin[0]->user_group,
                'username' => $masteradmin[0]->username,
                'titel' =>  $masteradmin[0]->titel_adminmaster,
                'name' =>  $masteradmin[0]->name_adminmaster,
                'lastname' =>  $masteradmin[0]->lastname_adminmaster,
                'phone' =>  $masteradmin[0]->phone_adminmaster,
                'school' =>  $masteradmin[0]->school_adminmaster,
            ]);
          }
          if($count2 > 0 ){
            $adminschool =    DB::table('users')
            ->leftJoin('alf_adminschool_info', 'users.username', '=', 'alf_adminschool_info.username_id')
            ->where('username_id', $id )->get();
            return response()->json([

                'id' =>  $adminschool[0]->id,
                'id_info' =>  $adminschool[0]->id_adminschool,
                'user_group' =>  $adminschool[0]->user_group,
                'username' => $adminschool[0]->username,
                'titel' =>  $adminschool[0]->titel_adminschool,
                'name' =>  $adminschool[0]->name_adminschool,
                'lastname' =>  $adminschool[0]->lastname_adminschool,
                'phone' =>  $adminschool[0]->phone_adminschool,
                'school' =>  $adminschool[0]->school_adminschool,
            ]);
        }

        if($count3 > 0){
            $parent =    DB::table('users')
            ->leftJoin('alf_parent_info', 'users.username', '=', 'alf_parent_info.username_id')
            ->where('username_id', $id )->get();
            return response()->json([
                'id' =>  $parent[0]->id,
                'id_info' =>  $parent[0]->id_parent,
                'user_group' =>  $parent[0]->user_group,
                'username' => $parent[0]->username,
                'titel' =>  $parent[0]->titel_parent,
                'name' =>  $parent[0]->name_parent,
                'lastname' =>  $parent[0]->lastname_parent,
                'phone' =>  $parent[0]->phone_parent,
                'school' =>  $parent[0]->school_parent,
                'id_student' =>  $parent[0]->student_parent,
            ]);
        }

        if($count4 > 0){
            $teacher =   DB::table('users')
            ->leftJoin('alf_teacher_info', 'users.username', '=', 'alf_teacher_info.username_id_tc')
            ->where('username_id_tc', $id )->get();
            return response()->json([
                'id' =>  $teacher[0]->id,
                'id_info' =>  $teacher[0]->id_teacher,
                'user_group' =>  $teacher[0]->user_group,
                'username' => $teacher[0]->username,
                'titel' =>  $teacher[0]->titel_teacher,
                'name' =>  $teacher[0]->name_teacher,
                'lastname' =>  $teacher[0]->lastname_teacher,
                'phone' =>  $teacher[0]->phone_teacher,
                'school' =>  $teacher[0]->school_teacher,
                'section' =>  $teacher[0]->school_section,
                'room' =>  $teacher[0]->school_room,
            ]);
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

        $count1 =   DB::table('alf_adminmaster_info')->where('username_id', $id )->count();
        $count2 =   DB::table('alf_adminschool_info')->where('username_id', $id )->count();
        $count3 =   DB::table('alf_parent_info')->where('username_id', $id )->count();
        $count4 =   DB::table('alf_teacher_info')->where('username_id_tc', $id )->count();
          if($count1 > 0){
          $masteradmin  = DB::table('users')
          ->leftJoin('alf_adminmaster_info', 'users.username', '=', 'alf_adminmaster_info.username_id')
          ->where('username_id', $id )->get();

            return response()->json([
                'id' =>  $masteradmin[0]->id,
                'id_info' =>  $masteradmin[0]->id_adminmaster,
                'user_group' =>  $masteradmin[0]->user_group,
                'username' => $masteradmin[0]->username,
                'titel' =>  $masteradmin[0]->titel_adminmaster,
                'name' =>  $masteradmin[0]->name_adminmaster,
                'lastname' =>  $masteradmin[0]->lastname_adminmaster,
                'phone' =>  $masteradmin[0]->phone_adminmaster,
                'school' =>  $masteradmin[0]->school_adminmaster,
            ]);
          }
          if($count2 > 0 ){
            $adminschool =    DB::table('users')
            ->leftJoin('alf_adminschool_info', 'users.username', '=', 'alf_adminschool_info.username_id')
            ->where('username_id', $id )->get();
            return response()->json([

                'id' =>  $adminschool[0]->id,
                'id_info' =>  $adminschool[0]->id_adminschool,
                'user_group' =>  $adminschool[0]->user_group,
                'username' => $adminschool[0]->username,
                'titel' =>  $adminschool[0]->titel_adminschool,
                'name' =>  $adminschool[0]->name_adminschool,
                'lastname' =>  $adminschool[0]->lastname_adminschool,
                'phone' =>  $adminschool[0]->phone_adminschool,
                'school' =>  $adminschool[0]->school_adminschool,
            ]);
        }

        if($count3 > 0){
            $parent =    DB::table('users')
            ->leftJoin('alf_parent_info', 'users.username', '=', 'alf_parent_info.username_id')
            ->where('username_id', $id )->get();
            return response()->json([
                'id' =>  $parent[0]->id,
                'id_info' =>  $parent[0]->id_parent,
                'user_group' =>  $parent[0]->user_group,
                'username' => $parent[0]->username,
                'titel' =>  $parent[0]->titel_parent,
                'name' =>  $parent[0]->name_parent,
                'lastname' =>  $parent[0]->lastname_parent,
                'phone' =>  $parent[0]->phone_parent,
                'school' =>  $parent[0]->school_parent,
                'id_student' =>  $parent[0]->student_parent,
            ]);
        }

        if($count4 > 0){
            $teacher =   DB::table('users')
            ->leftJoin('alf_teacher_info', 'users.username', '=', 'alf_teacher_info.username_id_tc')
            ->where('username_id_tc', $id )->get();
            return response()->json([
                'id' =>  $teacher[0]->id,
                'id_info' =>  $teacher[0]->id_teacher,
                'user_group' =>  $teacher[0]->user_group,
                'username' => $teacher[0]->username,
                'titel' =>  $teacher[0]->titel_teacher,
                'name' =>  $teacher[0]->name_teacher,
                'lastname' =>  $teacher[0]->lastname_teacher,
                'phone' =>  $teacher[0]->phone_teacher,
                'school' =>  $teacher[0]->school_teacher,
                'section' =>  $teacher[0]->school_section,
                'room' =>  $teacher[0]->school_room,
            ]);
        }
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
    public function destroy($id,$e)
    {


        $count1 =   DB::table('alf_adminmaster_info')->where('username_id', $id )->count();
        $count2 =   DB::table('alf_adminschool_info')->where('username_id', $id )->count();
        $count3 =   DB::table('alf_parent_info')->where('username_id', $id )->count();
        $count4 =   DB::table('alf_teacher_info')->where('username_id_tc', $id )->count();


        if($count1 > 0){
            DB::table('users')->where('username',$id)->delete();
            DB::table('alf_adminmaster_info')->where('username_id',$id)->delete();
            DB::table('model_has_roles')->where('model_id',$e)->delete();
            DB::table('alf_notification_user')->where('username_noti',$id)->delete();
           
        }
        if($count2 > 0){
            DB::table('users')->where('username',$id)->delete();
            DB::table('alf_adminschool_info')->where('username_id',$id)->delete();
            DB::table('model_has_roles')->where('model_id',$e)->delete();
            DB::table('alf_notification_user')->where('username_noti',$id)->delete();
        }
        if($count3 > 0){
            DB::table('users')->where('username',$id)->delete();
            DB::table('alf_parent_info')->where('username_id',$id)->delete();
            DB::table('model_has_roles')->where('model_id',$e)->delete();
            DB::table('alf_notification_user')->where('username_noti',$id)->delete();
        }
        if($count4 > 0){
            DB::table('users')->where('username',$id)->delete();
            DB::table('alf_teacher_info')->where('username_id_tc',$id)->delete();
            DB::table('model_has_roles')->where('model_id',$e)->delete();
            DB::table('alf_notification_user')->where('username_noti',$id)->delete();
        }

        return response()->json(['error' => false,], 200);
    }


    public function selectsubsector($sectorId)
    {

    $subsectors = DB::table('alf_student_info')->select('student_code_id')->where('name_school', $sectorId)->get();
    return response()->json($subsectors); //this line it's important since we are sending a json data variable that we are gonna use again in the last part of the view.
    }


    public function addexcel(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
           ]);

           $path = $request->file('select_file')->getRealPath();

           $data = Excel::load($path)->get();
           if($data->count()){
             
            foreach ($data as $key => $request) {
                if($request->user_group == '3' && $request->username != ''){
                    DB::table('alf_parent_info')->insert(
                        ['username_id' => $request->username,
                         'titel_parent' => $request->titel_parent,
                         'name_parent' => $request->name_parent,
                         'lastname_parent' =>$request->lastname_parent,
                         'phone_parent' =>$request->phone_parent,
                         'school_parent' =>$request->school_parent,
                         'student_parent' =>$request->student_parent,
                         'created_by' => Auth::user()->username,
                         'created_at' => Carbon::now()
                         ]
                    );
                    $user = new User;
                    $user->username = $request->username;
                    $user->password =  bcrypt('0000');
                    $user->user_group =  '3';
                    $user->save();
                    $user->assignRole('parent');
                    $nati = DB::table('alf_role_auth')->where("group_id","3")->get();
                    foreach($nati as $item){
                        DB::table('alf_notification_user')->insert(
                            ['menu_noti' => $item->id,
                             'username_noti' => $request->username,
                             'count_noti' => "0",
                             'school_noti' =>$request->school_parent
                        
                             ]
                        );
                    }
                }
                if($request->user_group == '4' && $request->username != ''){
                    DB::table('alf_teacher_info')->insert(
                        ['username_id_tc' => $request->username_id_tc,
                         'titel_teacher' => $request->titel_teacher,
                         'name_teacher' => $request->name_teacher,
                         'lastname_teacher' =>$request->lastname_teacher,
                         'phone_teacher' =>$request->phone_teacher,
                         'school_teacher' =>$request->school_teacher,
                         'school_section' =>$request->school_section,
                         'school_room' =>$request->school_room,
                         'created_by' => Auth::user()->username,
                         'created_at' => Carbon::now()
                         ]
                    );
                    $user = new User;
                    $user->username = $request->username;
                    $user->password = bcrypt('0000');
                    $user->user_group = '4';
                    $user->save();
                    $user->assignRole('teacher');
                    $nati = DB::table('alf_role_auth')->where("group_id","4")->get();
                    foreach($nati as $item){
                        DB::table('alf_notification_user')->insert(
                            ['menu_noti' => $item->id,
                             'username_noti' => $request->username,
                             'count_noti' => "0",
                             'school_noti' =>$request->school_teacher
                        
                             ]
                        );
                    }
                    




                }
              









            }

          
        }

        return back()->with('success', 'Insert Record successfully.');
    }










}
