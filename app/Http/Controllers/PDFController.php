<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
class PDFController extends Controller
{
     public  function   pdftime(){
       

       $time = DB::table('alf_timeattendance_student')
        ->leftJoin('alf_student_info','alf_timeattendance_student.code_student','alf_student_info.student_code_id')
        ->leftJoin('alf_term','alf_timeattendance_student.code_term','alf_term.id_term')
        ->leftJoin('alf_status_student','alf_timeattendance_student.code_status','alf_status_student.id')
        ->where('code_student','24920')
        ->get();
       // dd($time);
        $data =  array(
        'time'  => $time
        );
        $pdf = PDF::loadView('pdf.time', $data);
        $content = $pdf->download()->getOriginalContent();
        $fileName =  'ttt.' . 'pdf' ;
        file_put_contents('pdf/file.pdf', $content);
        return response()->json([
            'status' => 200,
            'file' =>   $fileName
        ]);
     }
}
