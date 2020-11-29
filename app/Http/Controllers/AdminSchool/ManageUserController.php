<?php

namespace App\Http\Controllers\AdminSchool;
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
class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
           $username = $request->username;
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();
        $userauth = DB::table('alf_adminschool_info')->where('username_id',Auth::user()->username)->first(); 

        $userSchool = DB::table('users')
        ->leftJoin('alf_parent_info', 'users.username', '=', 'alf_parent_info.username_id')
        ->leftJoin('alf_teacher_info', 'users.username', '=', 'alf_teacher_info.username_id_tc')
        ->where('school_parent',$userauth->school_adminschool)
        ->orWhere('school_teacher',$userauth->school_adminschool)
        ->where(function($query) use ($username){
            $query->orWhere('username', 'LIKE', '%' . $username . '%');
            
                  
            })->paginate(15);
        
        $namestudent = DB::table('alf_student_info')->get();
        $namegroup = DB::table('alf_users_group')->where('id', '3')
        ->orWhere('id', '4')
        ->get();
        $namestuden = DB::table('alf_student_info')->where('name_school',$userauth->school_adminschool)->get();
        $nameschool = DB::table('alf_name_school')->get();

        $school = DB::table('alf_adminschool_info')->where('username_id',Auth::user()->username)->get();
        $alf_name_school = DB::table('alf_name_school')
        ->where('id',$school[0]->school_adminschool)
        ->first();


//dd($userSchool);

        $data = array(
            'listmenu'=>$listmenu,
            'userSchool'=> $userSchool,
            'alf_name_school' =>  $alf_name_school,
            'namegroup' =>  $namegroup,
            'nameschool' => $nameschool,
            'namestuden' => $namestuden
             );
        return view('ischool.adminschool.add_user', $data);
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
                $check = $userauth = DB::table('users')->where('username',$request->username)->count();
                $userauth = DB::table('alf_adminschool_info')->where('username_id',Auth::user()->username)->first(); 
                if($check > 0){
                    return response()->json(['double' => "double",], 200);
                }else{
                if($request->user_group == '3'){
                DB::table('alf_parent_info')->insert(
                    ['username_id' => $request->username,
                     'titel_parent' => $request->titel,
                     'name_parent' => $request->name,
                     'lastname_parent' =>$request->lastname,
                     'phone_parent' =>$request->phone,
                     'school_parent' =>$userauth->school_adminschool,
                     'student_parent' =>$request->id_student,
                     'created_by' => Auth::user()->username,
                     'created_at' => Carbon::now()
                     ]
                );

                $role_menu =  DB::table('alf_role_auth')
                ->where("group_id","3")
                ->get();

                 foreach( $role_menu as  $item ){
                    DB::table('alf_notification_user')->insert(
                        ['menu_noti' => $item->id,
                         'username_noti' =>$request->username,
                         'count_noti' =>"0",
                         'school_noti' =>$userauth->school_adminschool,
                        
                         ]
                    );
                 }


                






                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
                $user = User::create($input);
                $user->assignRole('parent');
        
            }  else{
                $userauth = DB::table('alf_adminschool_info')->where('username_id',Auth::user()->username)->first(); 
                DB::table('alf_teacher_info')->insert(
                    ['username_id_tc' => $request->username,
                     'titel_teacher' => $request->titel,
                     'name_teacher' => $request->name,
                     'lastname_teacher' =>$request->lastname,
                     'phone_teacher' =>$request->phone,
                     'school_teacher' =>$userauth->school_adminschool,
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
    

                $role_menu =  DB::table('alf_role_auth')
                ->where("group_id","4")
                ->get();

                 foreach( $role_menu as  $item ){
                    DB::table('alf_notification_user')->insert(
                        ['menu_noti' => $item->id,
                         'username_noti' =>$request->username,
                         'count_noti' =>"0",
                         'school_noti' =>$userauth->school_adminschool,
                        
                         ]
                    );
                 }





                DB::table('alf_student_info')
                ->where('class', $request->section )
                ->where('room', $request->room )
                ->where('name_school',$userauth->school_adminschool )
                ->update(
                    ['consult' => $request->username
    
                     ]
                );
    
            }
        
        }
            }else{
                $userauth = DB::table('alf_adminschool_info')->where('username_id',Auth::user()->username)->first();
                if($request->user_group == '3'){
                    DB::table('alf_parent_info')
                    ->where('id_parent', $request->info_id )
                    ->update(
                        ['username_id' => $request->username,
                         'titel_parent' => $request->titel,
                         'name_parent' => $request->name,
                         'lastname_parent' =>$request->lastname,
                         'phone_parent' =>$request->phone,
                         'school_parent' =>$userauth->school_adminschool,
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
                         'school_teacher' =>$userauth->school_adminschool,
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
                 DB::table('alf_student_info')
                    ->where('class', $request->section )
                    ->where('room', $request->room )
                    ->where('name_school',$userauth->school_adminschool )
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
        ->where('username_id', $id )->first();

          return response()->json([
              'id' =>  $masteradmin->id,
              'id_info' =>  $masteradmin->id_adminmaster,
              'user_group' =>  $masteradmin->user_group,
              'username' => $masteradmin->username,
              'titel' =>  $masteradmin->titel_adminmaster,
              'name' =>  $masteradmin->name_adminmaster,
              'lastname' =>  $masteradmin->lastname_adminmaster,
              'phone' =>  $masteradmin->phone_adminmaster,
              'school' =>  $masteradmin->school_adminmaster,
          ]);
        }
        if($count2 > 0 ){
          $adminschool =    DB::table('users')
          ->leftJoin('alf_adminschool_info', 'users.username', '=', 'alf_adminschool_info.username_id')
          ->where('username_id', $id )->first();
          return response()->json([

              'id' =>  $adminschool->id,
              'id_info' =>  $adminschool->id_adminschool,
              'user_group' =>  $adminschool->user_group,
              'username' => $adminschool->username,
              'titel' =>  $adminschool->titel_adminschool,
              'name' =>  $adminschool->name_adminschool,
              'lastname' =>  $adminschool->lastname_adminschool,
              'phone' =>  $adminschool->phone_adminschool,
              'school' =>  $adminschool->school_adminschool,
          ]);
      }

      if($count3 > 0){
          $parent =    DB::table('users')
          ->leftJoin('alf_parent_info', 'users.username', '=', 'alf_parent_info.username_id')
          ->where('username_id', $id )->first();
          return response()->json([
              'id' =>  $parent->id,
              'id_info' =>  $parent->id_parent,
              'user_group' =>  $parent->user_group,
              'username' => $parent->username,
              'titel' =>  $parent->titel_parent,
              'name' =>  $parent->name_parent,
              'lastname' =>  $parent->lastname_parent,
              'phone' =>  $parent->phone_parent,
              'school' =>  $parent->school_parent,
              'id_student' =>  $parent->student_parent,
          ]);
      }

      if($count4 > 0){
          $teacher =   DB::table('users')
          ->leftJoin('alf_teacher_info', 'users.username', '=', 'alf_teacher_info.username_id_tc')
          ->where('username_id_tc', $id )->first();
          return response()->json([
              'id' =>  $teacher->id,
              'id_info' =>  $teacher->id_teacher,
              'user_group' =>  $teacher->user_group,
              'username' => $teacher->username,
              'titel' =>  $teacher->titel_teacher,
              'name' =>  $teacher->name_teacher,
              'lastname' =>  $teacher->lastname_teacher,
              'phone' =>  $teacher->phone_teacher,
              'school' =>  $teacher->school_teacher,
              'section' =>  $teacher->school_section,
              'room' =>  $teacher->school_room,
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
        }
        if($count2 > 0){
            DB::table('users')->where('username',$id)->delete();
            DB::table('alf_adminschool_info')->where('username_id',$id)->delete();
            DB::table('model_has_roles')->where('model_id',$e)->delete();
        }
        if($count3 > 0){
            DB::table('users')->where('username',$id)->delete();
            DB::table('alf_parent_info')->where('username_id',$id)->delete();
            DB::table('model_has_roles')->where('model_id',$e)->delete();
        }
        if($count4 > 0){
            DB::table('users')->where('username',$id)->delete();
            DB::table('alf_teacher_info')->where('username_id_tc',$id)->delete();
            DB::table('model_has_roles')->where('model_id',$e)->delete();
        }

        return response()->json(['error' => false,], 200);
    }
}
