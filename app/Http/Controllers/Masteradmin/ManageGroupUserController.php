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

class ManageGroupUserController extends Controller
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

    public  function CheckPublicHoliday($strChkDate)
 {


    $publicHoliday = DB::table('alf_public_holiday')->where('PublicHoliday',$strChkDate)->get();

    if($publicHoliday->count()){
        foreach($publicHoliday as $row)
        {
            $objResult[] = array('FisYear' =>$row->FisYear,
            'PublicHoliday' => $row->PublicHoliday,
            'Descripiton' => $row->Descripiton
               );
        }
        if(!$objResult)
        {
         return false;
        }
        else
        {
         return  $publicHoliday[0]->Descripiton;
        }
    }
 }








     public function index()
    {
        $listmenu = DB::table('alf_role_auth')->where('group_id',Auth::user()->user_group)->get();



                 $strStartDate = '2019-10-1';
                 $strEndDate = '2019-10-31';
                  $intWorkDay = 0;
                 $intHoliday = 0;
                 $intPublicHoliday = 0;
                 $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate))/  ( 60 * 60 * 24 )) + 1;
                 while (strtotime($strStartDate) <= strtotime($strEndDate)) {
                    $DayOfWeek = date("w", strtotime($strStartDate));
                  if($DayOfWeek == 0 or $DayOfWeek ==6)  // 0 = Sunday, 6 = Saturday;
                  {
                   $intHoliday++;
                   $objResultHoliday[] = ['date' => $strStartDate,
                                                'Descripiton' =>"วันหยุด",];


                  }
                  elseif($this->CheckPublicHoliday($strStartDate))
                  {
                  $intPublicHoliday++;
                  $objResultHoliday[] = ['date' => $strStartDate,
                  'Descripiton' =>$this->CheckPublicHoliday($strStartDate),];



              // echo "$strStartDate = <font color=orange>".$this->CheckPublicHoliday($strStartDate)."</font><br>";
              }
                  else
                  {
                   $intWorkDay++;
                   $objResultHoliday[] = ['date' => $strStartDate,
                   'Descripiton' =>"วันธรรมดา",];

                  }
                  $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));
                 }
                // echo "<hr>";
               //  echo "<br>Total Day = $intTotalDay";
               //  echo "<br>Work Day = $intWorkDay";
              //   echo "<br>Holiday = $intHoliday";
              //   echo "<br>Public Holiday = $intPublicHoliday";
               //  echo "<br>All Holiday = ".($intHoliday+$intPublicHoliday);



               $collection = collect($objResultHoliday);





              // dd($collection);


                 $data = array(
                    'listmenu'=>$listmenu,
                       'collection' => $collection
                         );

        return view('ischool.masteradmin.mgUsergroup',$data);
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
}
