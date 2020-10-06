<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PythonController extends Controller
{
    public function store(Request $request)
    {



        list($day,$month,$year,$hour,$min,$sec) = explode("/",date('d/m/Y/h/i/s'));
        $yearsum = (int)$year+543;
        $datecon = $day.'/'.$month.'/'.$yearsum.' '.$hour.':'.$min.':'.$sec;


        $getdata_check = DB::table('alf_student_info')
            ->where('student_code_id', $request->username)
            ->where('name_school', $request->schoolcode)
            ->count();

        if ($getdata_check > 0) {

            $getdata = DB::table('alf_student_info')
                ->where('student_code_id', $request->username)
                ->where('name_school', $request->schoolcode)
                ->first();

            $key_notification = DB::table('alf_key_notification')
                ->where('code_reg', $request->username)
                ->where('login_status', '1')
                ->get();

            $parent_info = DB::table('alf_parent_info')
                ->where('student_parent', $request->username)
                ->where('school_parent', $request->schoolcode)
                ->first();
            $term = DB::table('alf_term_active')
                ->where('name_school_id', $getdata->name_school)
                ->where('active', "Y")
                ->first();

            $date = date("Y-m-d");
            $checkdata = DB::table('alf_timeattendance_student')->where('code_student', $request->username)
                ->where('date', $date)
                ->count();

            if ($checkdata == 1) {
                if (time() > strtotime(date('Y-m-d') . '14:30')) {

                    DB::table('alf_timeattendance_student')->insert(
                        ['code_student' => $request->username,
                            'code_term' => $term->name_term_id,
                            'code_school' => $getdata->name_school,
                            'code_month' => date("m"),
                            'code_status' => "2",
                            'inOrOut' => "2",
                            'timeattendance' => $datecon,
                            'img' => $request->file,
                            'date' => Carbon::now(),
                        ]
                    );

                    $i = DB::table('alf_notification_user')
                        ->Where('username_noti', $parent_info->username_id)
                        ->Where('menu_noti', '11')->first();

                    $y = $i->count_noti + 1;
                    DB::table('alf_notification_user')
                        ->Where('username_noti', $parent_info->username_id)
                        ->Where('menu_noti', '11')
                        ->update(['count_noti' => $y]);

                    if ($key_notification->count() > 0) {

                        foreach ($key_notification as $item) {

                            $key[] = $item->player_id;

                        }

                        $heading = array(
                            "en" => "แจ้งการเข้า-ออกโรงเรียน",
                        );

                        $content = array(
                            "en" => $getdata->title . "" . $getdata->name . " " . $getdata->lastname . 'ออกจากโรงเรียน ' . $datecon . ' น.',
                        );

                        $fields = array(
                            'app_id' => "f4333483-f278-46c3-9b7f-a5ea540c4dd5",
                            'include_player_ids' => $key,
                            'data' => array("foo" => "bar"),
                            'contents' => $content,
                            'headings' => $heading,
                        );

                        $fields = json_encode($fields);
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HEADER, false);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        $response = curl_exec($ch);
                        curl_close($ch);

                    }

                    if ($getdata->consult != "") {

                        $key_notification_consult = DB::table('alf_key_notification')
                            ->where('code_reg', $getdata->consult)
                            ->where('login_status', '1')
                            ->get();

                        if ($key_notification_consult->count() > 0) {

                            foreach ($key_notification_consult as $item) {

                                $key[] = $item->player_id;

                            }

                            $heading = array(
                                "en" => "แจ้งการเข้า-ออกโรงเรียน",
                            );

                            $content = array(
                                "en" => $getdata->title . "" . $getdata->name . " " . $getdata->lastname . 'ออกจากโรงเรียน ' . $datecon . ' น.',
                            );

                            $fields = array(
                                'app_id' => "f4333483-f278-46c3-9b7f-a5ea540c4dd5",
                                'include_player_ids' => $key,
                                'data' => array("foo" => "bar"),
                                'contents' => $content,
                                'headings' => $heading,
                            );

                            $fields = json_encode($fields);
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_HEADER, false);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            $response = curl_exec($ch);
                            curl_close($ch);

                        }

                    }

                }
            } else {

                $date = date("Y-m-d");
                $checkdata = DB::table('alf_timeattendance_student')->where('code_student', $request->username)
                    ->where('date', $date)
                    ->where('inOrOut', '1')
                    ->count();

                if ($checkdata == '0') {
                    if (time() > strtotime(date('Y-m-d') . '08:30')) {

                        DB::table('alf_timeattendance_student')->insert(
                            ['code_student' => $request->username,
                                'code_term' => $term->name_term_id,
                                'code_school' => $getdata->name_school,
                                'code_month' => date("m"),
                                'code_status' => "3",
                                'inOrOut' => "1",
                                'timeattendance' => $datecon,

                                'date' => Carbon::now(),
                            ]
                        );

                        $i = DB::table('alf_notification_user')
                            ->Where('username_noti', $parent_info->username_id)
                            ->Where('menu_noti', '11')->first();
                        $y = $i->count_noti + 1;
                        DB::table('alf_notification_user')
                            ->Where('username_noti', $parent_info->username_id)
                            ->Where('menu_noti', '11')
                            ->update(['count_noti' => $y]);

                        if ($key_notification->count() > 0) {

                            foreach ($key_notification as $item) {

                                $key[] = $item->player_id;

                            }

                            $heading = array(
                                "en" => "แจ้งการเข้า-ออกโรงเรียน",
                            );

                            $content = array(
                                "en" => $getdata->title . "" . $getdata->name . " " . $getdata->lastname . ' เข้าโรงเรียน ' . $datecon . ' น.',
                            );

                            $fields = array(
                                'app_id' => "f4333483-f278-46c3-9b7f-a5ea540c4dd5",
                                'include_player_ids' => $key,
                                'data' => array("foo" => "bar"),
                                'contents' => $content,
                                'headings' => $heading,
                            );

                            $fields = json_encode($fields);
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_HEADER, false);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            $response = curl_exec($ch);
                            curl_close($ch);

                        }

                        if ($getdata->consult != "") {
                            $key_notification_consult = DB::table('alf_key_notification')
                                ->where('code_reg', $getdata->consult)
                                ->where('login_status', '1')
                                ->get();

                            if ($key_notification_consult->count() > 0) {

                                foreach ($key_notification_consult as $item) {

                                    $key[] = $item->player_id;

                                }

                                $heading = array(
                                    "en" => "แจ้งการเข้า-ออกโรงเรียน",
                                );

                                $content = array(
                                    "en" => $getdata->title . "" . $getdata->name . " " . $getdata->lastname . 'เข้าโรงเรียน ' . $datecon . ' น.',
                                );

                                $fields = array(
                                    'app_id' => "f4333483-f278-46c3-9b7f-a5ea540c4dd5",
                                    'include_player_ids' => $key,
                                    'data' => array("foo" => "bar"),
                                    'contents' => $content,
                                    'headings' => $heading,
                                );

                                $fields = json_encode($fields);
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_HEADER, false);
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                $response = curl_exec($ch);
                                curl_close($ch);

                            }
                        }

                    } else {

                        DB::table('alf_timeattendance_student')->insert(
                            ['code_student' => $request->username,
                                'code_term' => $term->name_term_id,
                                'code_school' => $getdata->name_school,
                                'code_month' => date("m"),
                                'code_status' => "2",
                                'inOrOut' => "1",
                                'timeattendance' => $datecon,

                                'date' => Carbon::now(),
                            ]
                        );

                        $i = DB::table('alf_notification_user')
                            ->Where('username_noti', $parent_info->username_id)
                            ->Where('menu_noti', '11')->first();
                        $y = $i->count_noti + 1;
                        DB::table('alf_notification_user')
                            ->Where('username_noti', $parent_info->username_id)
                            ->Where('menu_noti', '11')
                            ->update(['count_noti' => $y]);

                        if ($key_notification->count() > 0) {

                            foreach ($key_notification as $item) {

                                $key[] = $item->player_id;

                            }

                            $heading = array(
                                "en" => "แจ้งการเข้า-ออกโรงเรียน",
                            );

                            $content = array(
                                "en" => $getdata->title . "" . $getdata->name . " " . $getdata->lastname . ' เข้าโรงเรียน ' . $datecon . ' น.',
                            );

                            $fields = array(
                                'app_id' => "f4333483-f278-46c3-9b7f-a5ea540c4dd5",
                                'include_player_ids' => $key,
                                'data' => array("foo" => "bar"),
                                'contents' => $content,
                                'headings' => $heading,
                            );

                            $fields = json_encode($fields);
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_HEADER, false);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            $response = curl_exec($ch);
                            curl_close($ch);

                        }

                        if ($getdata->consult != "") {
                            $key_notification_consult = DB::table('alf_key_notification')
                                ->where('code_reg', $getdata->consult)
                                ->where('login_status', '1')
                                ->get();

                            if ($key_notification_consult->count() > 0) {

                                foreach ($key_notification_consult as $item) {

                                    $key[] = $item->player_id;

                                }

                                $heading = array(
                                    "en" => "แจ้งการเข้า-ออกโรงเรียน",
                                );

                                $content = array(
                                    "en" => $getdata->title . "" . $getdata->name . " " . $getdata->lastname . 'เข้าโรงเรียน ' . $datecon . ' น.',
                                );

                                $fields = array(
                                    'app_id' => "f4333483-f278-46c3-9b7f-a5ea540c4dd5",
                                    'include_player_ids' => $key,
                                    'data' => array("foo" => "bar"),
                                    'contents' => $content,
                                    'headings' => $heading,
                                );

                                $fields = json_encode($fields);
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_HEADER, false);
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                $response = curl_exec($ch);
                                curl_close($ch);

                            }
                        }

                    }

                }

            }

            return $request->id;

        } else {
            return $request->id;
        }

        /*   $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/ichooltecios-firebase-adminsdk-lxmzr-054e4b431c.json');
    $firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://ichooltecios.firebaseio.com/')
    ->create();

    if($request->file != ""){

    $pb = new PushBots();
    $pb2 = new PushBots();
    // Application ID
    $appID = '5e1960579ef56720221e77a2';
    // Application Secret
    $appSecret = 'aa34ab1bd5741f7e839ee6ea59c49a07';
    // Your ID and token
    $token_db = DB::table('alf_token')->Where('id','1')->first();
    $authToken = $token_db->token;
    $imgbase64 = $request->file;
    // The data to send to the API
    $postData = array(
    'image_base64' => $imgbase64,
    'sort' => [array('timestamp' => 'asc')],
    'return_fields' => ["timestamp", "id"],
    'filter' => 'timestamp:12'
    );

    // Setup cURL
    $ch = curl_init('https://face.ap-southeast-2.myhuaweicloud.com/v2/062a3247960025ca2f69c01168dadaf6/face-sets/imgstudent_bbc/search');
    curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
    'X-Auth-Token: '.$authToken,
    'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
    ));
    // Send the request
    $response = curl_exec($ch);
    // Check for errors
    if($response === FALSE){
    die(curl_error($ch));
    }
    // Decode the response
    $responseData = json_decode($response, TRUE);
    //echo $response."<br>";
    // Print the date from the response
    foreach ($responseData['faces'] as $address)
    {

    if($address['similarity'] >= "0.9"){

    $checkgetdata = DB::table('alf_student_info')->where('student_code_id',$address['external_image_id'])->count();
    $getdata = DB::table('alf_student_info')->where('student_code_id',$address['external_image_id'])->first();
    $getdata_school = DB::table('alf_student_info')->where('student_code_id',$address['external_image_id'])->first();
    $term = DB::table('alf_term_active')
    ->where('name_school_id', $getdata_school->name_school)
    ->where('active',"Y")
    ->first();

    $parent_info = DB::table('alf_parent_info')
    ->where('student_parent', $address['external_image_id'])
    ->where('school_parent',$getdata_school->name_school)
    ->first();

    if($checkgetdata >0){

    $date = date("Y-m-d");
    $checkdata = DB::table('alf_timeattendance_student')->where('code_student',$address['external_image_id'])
    ->where('date',$date)
    ->count();

    if($checkdata > 0){
    if($checkdata == 1){
    if(time() > strtotime(date('Y-m-d').'15:00') ){

    DB::table('alf_timeattendance_student')->insert(
    ['code_student'=> $address['external_image_id'],
    'code_term' =>  $term->name_term_id,
    'code_school' =>  $getdata->name_school,
    'code_month' =>date("m"),
    'code_status' =>"2",
    'inOrOut' =>"2",
    'timeattendance' =>Carbon::now(),
    'img' => $request->file,
    'date' => Carbon::now()
    ]
    );

    $database_1 = $firebase->getDatabase();
    $newPost_1 = $database_1
    ->getReference('bbc')
    ->push([
    'name_student'=> $getdata->name."  ".$getdata->lastname,
    'code_student'=> $address['external_image_id'],
    'code_month' =>date("m"),
    'code_status' =>"มาปกติ",
    'inOrOut' =>"กลับจากโรงเรียน",
    'timeattendance' =>Carbon::now(),
    'img' => $request->file,
    'date' => Carbon::now()
    ]);

    $i =  DB::table('alf_notification_user')
    ->Where('username_noti',$parent_info->username_id)
    ->Where('menu_noti','11')->first();
    $y =  $i->count_noti + 1;
    DB::table('alf_notification_user')
    ->Where('username_noti',$parent_info->username_id)
    ->Where('menu_noti','11')
    ->update(['count_noti' => $y ]);

    $pb->App($appID, $appSecret);
    $pb->Platform(array("0","1"));
    $pb->Alias($parent_info->consult);
    // Notification Settings
    $pb->Alert( $getdata->title."".$getdata->name." ".$getdata->lastname." กลับจากโรงเรียนวันที่ ".date("d/m/Y h:i:sa"));
    $i =$pb->Push();

    if($getdata->consult != ""){
    $pb2->App($appID, $appSecret);
    $pb2->Platform(array("0","1"));
    $pb2->Alias($getdata->consult);
    // Notification Settings
    $pb2->Alert($getdata->title."".$getdata->name." ".$getdata->lastname."กลับจากโรงเรียนวันที่ ". date("d/m/Y h:i:sa"));
    $pb2->Push();

    }

    }

    }
    }else{
    if(time() > strtotime(date('Y-m-d').'08:30') ){

    DB::table('alf_timeattendance_student')->insert(
    ['code_student'=> $address['external_image_id'],
    'code_term' => $term->name_term_id,
    'code_school' =>  $getdata->name_school,
    'code_month' =>date("m"),
    'code_status' =>"3",
    'inOrOut' =>"1",
    'timeattendance' =>Carbon::now(),
    'img' => $request->file,
    'date' => Carbon::now()
    ]
    );

    $database_2 = $firebase->getDatabase();
    $newPost_2 = $database_2
    ->getReference('bbc')
    ->push([
    'name_student'=> $getdata->name." ".$getdata->lastname,
    'code_student'=> $address['external_image_id'],
    'code_month' =>date("m"),
    'code_status' =>"สาย",
    'inOrOut' =>"มาโรงเรียน",
    'timeattendance' =>Carbon::now(),
    'img' => $request->file,
    'date' => Carbon::now()
    ]);

    $i =  DB::table('alf_notification_user')
    ->Where('username_noti',$parent_info->username_id)
    ->Where('menu_noti','11')->first();
    $y =  $i->count_noti + 1;
    DB::table('alf_notification_user')
    ->Where('username_noti',$parent_info->username_id)
    ->Where('menu_noti','11')
    ->update(['count_noti' => $y ]);

    $pb->App($appID, $appSecret);
    $pb->Platform(array("0","1"));
    $pb->Alias($parent_info->username_id);
    // Notification Settings
    $pb->Alert($getdata->title."".$getdata->name." ".$getdata->lastname."มาโรงเรียนวันที่ ". date("d/m/Y h:i:sa"));
    $i =$pb->Push();

    if($getdata->consult != ""){
    $pb2->App($appID, $appSecret);
    $pb2->Platform(array("0","1"));
    $pb2->Alias($getdata->consult);
    // Notification Settings
    $pb2->Alert($getdata->title."".$getdata->name." ".$getdata->lastname."มาโรงเรียนวันที่ ". date("d/m/Y h:i:sa"));
    $pb2->Push();
    }

    }else{

    DB::table('alf_timeattendance_student')->insert(
    ['code_student'=> $address['external_image_id'],
    'code_term' => $term->name_term_id,
    'code_school' =>  $getdata->name_school,
    'code_month' =>date("m"),
    'code_status' =>"2",
    'inOrOut' =>"1",
    'timeattendance' =>Carbon::now(),
    'img' => $request->file,
    'date' => Carbon::now()
    ]
    );

    $database_3 = $firebase->getDatabase();
    $newPost_3 = $database_3
    ->getReference('bbc')
    ->push([
    'name_student'=> $getdata->name." ".$getdata->lastname,
    'code_student'=> $address['external_image_id'],
    'code_month' =>date("m"),
    'code_status' =>"มาปกติ",
    'inOrOut' =>"มาโรงเรียน",
    'timeattendance' =>Carbon::now(),
    'img' => $request->file,
    'date' => Carbon::now()
    ]);

    $i =  DB::table('alf_notification_user')
    ->Where('username_noti',$parent_info->username_id)
    ->Where('menu_noti','11')->first();
    $y =  $i->count_noti + 1;
    DB::table('alf_notification_user')
    ->Where('username_noti',$parent_info->username_id)
    ->Where('menu_noti','11')
    ->update(['count_noti' => $y ]);

    $pb->App($appID, $appSecret);
    $pb->Platform(array("0","1"));
    $pb->Alias($parent_info->username_id);
    // Notification Settings
    $pb->Alert($getdata->title."".$getdata->name." ".$getdata->lastname."มาโรงเรียนวันที่ ". date("d/m/Y h:i:sa"));
    $i =$pb->Push();

    if($getdata->consult != ""){
    $pb2->App($appID, $appSecret);
    $pb2->Platform(array("0","1"));
    $pb2->Alias($getdata->consult);
    // Notification Settings
    $pb2->Alert($getdata->title."".$getdata->name." ".$getdata->lastname."มาโรงเรียนวันที่ ".  date("d/m/Y h:i:sa"));
    $pb2->Push();
    }

    }

    }

    }

    }

    }
    //echo "similarity:". $address['similarity'] ."\n";
    }

    }

    public function getdata()
    {

    $data = DB::table('alf_timeattendance_student')
    ->leftJoin('alf_status_student', 'alf_timeattendance_student.code_status', '=', 'alf_status_student.id')
    ->leftJoin('alf_student_info', 'alf_timeattendance_student.code_student', '=', 'alf_student_info.student_code_id')
    ->last();

    return response()->json( $data );
    }

    public function upladimg(Request $request)
    {
    set_time_limit(0);
    $token_db = DB::table('alf_token')->Where('id','1')->first();
    $authToken = $token_db->token;

    if($request->hasfile('filename'))
    {

    foreach($request->file('filename') as $file)
    {
    $fullName=$file->getClientOriginalName();
    $image = base64_encode(file_get_contents($file));
    $name=explode('.',$fullName)[0];
    $postData = array( 'image_base64' =>$image,
    'external_image_id' =>$name,
    'external_fields' =>array(
    'timestamp' => 12,
    'id' =>   $name

    )   );

    $ch = curl_init('https://face.ap-southeast-2.myhuaweicloud.com/v2/062a3247960025ca2f69c01168dadaf6/face-sets/imgstudent_bbc/faces');
    curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
    'X-Auth-Token: '.$authToken,
    'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
    ));
    // Send the request
    $response = curl_exec($ch);
    // Check for errors
    if($response === FALSE){
    die(curl_error($ch));
    }
    // Decode the response
    $responseData = json_decode($response, TRUE);

    }
    }

     */

    }

}
