@extends('ischool.layout.app')
@section('contentheader')
<section class="content-header">
        <h1>
          การจัดการ
          <small>นักเรียน</small>
        </h1>

      </section>


@endsection
@section('content')
    <a href="{{url('/mgmaseterstuden')}}">ย้อนกลับ</a>
    @if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload Validation Error<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif

   @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
    <form method="post" enctype="multipart/form-data" action="{{ url('/mgmaseterstuden') }}">
        {{ csrf_field() }}
        <div class="form-group">
                <label>Select File for Upload</label>
                <input type="file" name="select_file"/><span class="text-muted">.xls, .xslx</span>

        </div>
        <div class="form-group">
        <input type="submit" name="upload" class="btn btn-primary" value="อัพโหลดลายชื่อนักเรียน">
    </div>
    </form>
<div class="box box-primary">
    <div class="box-header with-border">
     <h3 class="box-title">นักเรียน</h3>
     <div class="box-body table-responsive no-padding">
        <table class="table table-condensed">
                <tr>
                  <th>ชื่อ</th>
                  <th>นามสกุล</th>
                  <th>ระดับ</th>
                  <th>เพิ่มเติม</th>
                </tr>

                @forelse ($liststudent as $liststudents )
                 <tr>

                    <td> {{$liststudents->name}} </td>
                    <td>
                        {{$liststudents->lastname}}
                    </td>
                    <td>
                        {{$liststudents->name_degree}}
                    </td>

                    <td>
                        <a class="btn btn-info btn-xs  viewStundentDetail"  data-id="{{$liststudents->student_code_id}}"  href="javascript:void(0)"><i class="fa fa-eye" ></i></a>
                        <a class="btn btn-warning btn-xs editStundentDetail "  data-id="{{$liststudents->student_code_id}}"  href="javascript:void(0)"><i class="fa fa-edit" ></i></a>
                        <a class="btn btn-danger btn-xs   " data-id="{{$liststudents->student_code_id}}" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                    </td>
                 </tr>
                 @empty
                 <tr>
                   <td colspan="3"> ไม่พบข้อมูล !!</td>
                 </tr>
                 @endforelse
          </table>
      </div>
    </div>
      <div class="box-body no-padding">
        <div class="box-footer clearfix">
            <div class=" pull-right">
              {{$liststudent->links()}}
            </div>
          </div>
    </form>
  </div>
  <div class="modal fade" id="modal-viewStundentDetail">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">
            <label id="modelHeading-viewStundentDetail"> </label>
          </h4>
        </div>
        <form id="Form-viewStundentDetail" name="Form-viewStundentDetail" >
        <div class="modal-body">
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>รหัสนักเรียน</label>
                    <input type="text" class="form-control" name="student_code_id" id="student_code_id" required>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>ระดับ</label>
                    <select  class="form-control" name="degree"  id="degree"  required>
                        <option value="">ระบุ</option>
                        <option value="1">ม.ต้น</option>
                        <option value="2">ม.ปลาย</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>สัญชาติ</label>
                    <input type="text" class="form-control" name="nationality" id="nationality" required>
                  </div>

                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label>คำนำหน้า</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label>ห้อง</label>
                        <input type="text" class="form-control" name="room" id="room" required>
                      </div>
                      <div class="form-group">
                        <label>เชื้อชาติ</label>
                        <input type="text" class="form-control" name="race" id="race" required>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>ชื่อ:</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label>เลขบัตรประชาชน</label>
                        <input type="text" class="form-control" name="card_number" id="card_number" required>
                      </div>
                      <div class="form-group">
                        <label>โทรศัพท์</label>
                        <input type="text" class="form-control" name="tel" id="tel" required>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>นามสกุล</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" required>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label>วันเกิด</label>
                        <input type="text" class="form-control" name="birthday" id="birthday" required>
                      </div>
                      <div class="form-group">
                        <label>อีเมล</label>
                        <input type="text" class="form-control" name="email" id="email" required>
                      </div>
                </div>
                <!-- /.col -->
              </div>

              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>ที่อยู่</label>
                    <input type="text" class="form-control" name="address" id="address" required>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>ชื่อ-นามสกุลพ่อ</label>
                    <input type="text" class="form-control" name="father" id="father" required>
                  </div>
                  <div class="form-group">
                    <label>ชื่อ-นามสกุลแม่</label>
                    <input type="text" class="form-control" name="mom" id="mom" required>
                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label>โรงเรียน</label>
                        <select name="name_school" id="name_school"  class="form-control">
                            @foreach ($getschool as $getschools )
                           <option value="{{$getschools->id}}" >{{$getschools->name_school_a}}</option>
                            @endforeach
                        </select>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label>โทรศัพท์พ่อ</label>
                        <input type="text" class="form-control" name="father_tel" id="father_tel" required>
                      </div>
                      <div class="form-group">
                        <label>โทรศัพท์เเม่</label>
                        <input type="text" class="form-control" name="mom_tel" id="mom_tel" required>
                      </div>

                </div>
                <div class="col-md-3">
                <div class="form-group">
                        <label>ครูที่ปรึกษา</label>
                        <select name="consult"  id="consult" required class="form-control ">
                            <option value="" >ระบุ</option>
                            @foreach ($listteacher as $listteachers )
                            <option value="{{$listteachers->username_id_tc}}" >{{$listteachers->name_teacher}}{{$listteachers->lastname_teacher}} </option>
                            @endforeach
                        </select>

                      </div>
                      <div class="form-group">
                            <label>ชั้นศึกษา</label>
                            <select name="classroom"  id="classroom" required class="form-control ">
                                <option value="" >ระบุ</option>
                                <option value="1" >ม.1</option>
                                <option value="2" >ม.2</option>
                                <option value="3" >ม.3</option>
                                <option value="4" >ม.4</option>
                                <option value="5" >ม.5</option>
                                <option value="6" >ม.6</option>
                                <option value="7" >ปวช.1</option>
                                <option value="8" >ปวช.2</option>
                                <option value="9" >ปวช.3</option>
                            </select>

                          </div>
                </div>

            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
          <input type="submit" class="btn btn-primary" id="btnSave-viewStundentDetail" value="" >
        </div>
        </div>
    </form>
      </div>
    </div>
  </div>
@endsection
@section('scriptSchoolShow')
<script src="{{asset('js/SchoolShow.js')}}"></script>
@endsection
