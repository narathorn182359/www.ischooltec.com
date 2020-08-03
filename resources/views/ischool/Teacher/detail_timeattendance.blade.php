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

        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">ค้นหา </h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
              
                <!-- /.box-header -->
                <form action="{{url('/time_attendance_teacherst/'.request()->route('id').'/'.request()->route('school'))}}" method="PUT" role="search">
                  <input type="hidden" name="code_student" value="{{ request()->route('id') }}">
                  <input type="hidden" name="code_school" value="{{   request()->route('school') }}">

              <div class="box-body ">
                      <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>ภาคเรียน</label>
                                  <select class="form-control select2" style="width: 100%;" name="code_term">
                                    <option value="">ระบุ</option>
                                    @foreach ($listterm as $listterms )
                                    <option value="{{$listterms->term}}">{{$listterms->term}}</option>

                                    @endforeach

                                  </select>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                      <label>สถานะ</label>
                                      <select class="form-control select2" style="width: 100%;" name="code_status" >
                                          <option value="">ระบุ</option>
                                          @foreach ($liststatus as $liststatuss )
                                          <option value="{{$liststatuss->id}}">{{$liststatuss->name_status}}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                <!-- /.form-group -->
                              </div>
                              <!-- /.col -->
                              <div class="col-md-6">
                                      <div class="form-group">
                                              <label>เดือน</label>
                                              <select class="form-control select2" style="width: 100%;" name="code_month">
                                                  <option value="">ระบุ</option>
                                                  @foreach ($listmonth as  $listmonths)
                                                  <option value="{{$listmonths->id}}">{{$listmonths->name_month}}</option>
                                                  @endforeach
                                              </select>
                                            </div>


                              </div>
                              <!-- /.col -->
                            </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                      <input type="submit" class="btn btn-success"  value="ค้นหา">
              </div>
              </form>
              <!-- /.box-footer -->
            </div>


</div>
<div class="col-md-12">
  <!-- MAP & BOX PANE -->
          <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">แสดงการเข้า-ออกรายบุคคล</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body table-responsive no-padding">
                          <table class="table table-hover">
                            <tr>
                              <th>วันที่</th>
                              <th>รูปเข้า</th>
                              <th>ชื่อ-นามสกุล</th>
                              <th>เวลา</th>
                              <th>สถานะ</th>
                            </tr>
                            @if(isset($listtimeatt))
                            @forelse ($listtimeatt as $listtimeatts)
                            <tr>
                              <td>{{$listtimeatts->date}}</td>
                              <td></td>
                                <td>{{$listtimeatts->name}} {{$listtimeatts->lastname}}</td>
                                <td>{{$listtimeatts->timeattendance}} น.</td>
                                <td>{{$listtimeatts->name_status}}t</td>
                              </tr>
                            @empty
                            
                            @endforelse
                            @endif
                            @if(isset($details))
                            @forelse ($details as $listtimeatts)
                            <tr>
                              <td>{{$listtimeatts->date}}</td>
                              <td></td>
                                <td>{{$listtimeatts->name}} {{$listtimeatts->lastname}}</td>
                                <td>{{$listtimeatts->timeattendance}} น.</td>
                                <td>{{$listtimeatts->name_status}}</td>
                              </tr>
                            @empty
                                      
                                    @endforelse
                            @endif
        
                          </table>
                        </div>
                  <!-- /.box-body -->
                 
                  <!-- /.box-footer -->
                </div>
                <!-- /.box -->
</div>




@endsection
