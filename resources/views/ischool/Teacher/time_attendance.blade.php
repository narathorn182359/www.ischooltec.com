@extends('ischool.layout.app')
@section('contentheader')
<section class="content-header">
        <h1>
          การลงเวลาแต่ห้องเรียน
        </h1>
      </section>
@endsection
@section('content')
<div class="col-md-12">
        <!-- MAP & BOX PANE -->
        <div class="box box-success">
          <div class="box-header with-border">
              @if(isset($liststuden))
              <h3 class="box-title">รายละเอียดนักเรียน {{ $liststuden[0]->name_degree}}  ระดับ  {{ $liststuden[0]->name_class}}  / {{ $liststuden[0]->room}}  โรงเรียน  {{ $liststuden[0]->name_school_a}}   {{$liststuden->total()}} คน  </h3>
              @endif
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>

            </div>
          </div>
          <div class="box-body no-padding">
                <table class="table table-condensed">
                        <tr>
                          <th>รายชื่อนักเรียน</th>
                          <th>รายละเอียด</th>
                        </tr>
                       @forelse ($liststuden as $liststudens)
                       <tr>
                            <td style="width: 200px" >{{ $liststudens->title}} {{$liststudens->name}}  {{$liststudens->lastname}} </td>
                            <td style="width: 150px" >
                                <a class="btn btn-info btn-xs  viewStundentDetail"    href="{{url('time_attendance_teacherst/'.Crypt::encrypt($liststudens->student_code_id).'/'.Crypt::encrypt($liststudens->name_school))}}"><i class="fa fa-clock-o" ></i> ดูเวลาเข้า-ออก</a>
                            </td>
                         </tr>
                       @empty
                       <tr>
                            <td colspan="2"> ไม่พบข้อมูล !!</td>
                          </tr>
                       @endforelse

                  </table>

              </div>
        </div>
        <div class=" text-center">
                {{$liststuden->links()}}

        </div>

    </div>
@endsection
