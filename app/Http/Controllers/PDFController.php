<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
class PDFController extends Controller
{
     public  function   pdftime(){
        $data = [
            'name'=>'รรรรรร'
        ];
        $pdf = PDF::loadView('pdf.time', $data);
        $content = $pdf->download()->getOriginalContent();
        $fileName =  $post['title'] . '.' . 'pdf' ;
        file_put_contents('pdf/file.pdf', $content);
        return response()->json([
            'status' => 200,
            'file' =>   $fileName
        ]);
     }
}
