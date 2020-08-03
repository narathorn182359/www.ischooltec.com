@extends('ischool.layout.app')
@section('contentheader')
<section class="content-header">
        <h1>
          การจัดการ
          <small>ผู้ใช้</small>
        </h1>

      </section>
@endsection
@section('content')
<form method="post" enctype="multipart/form-data" action="{{ url('/masteradduserexcel') }}">
  {{ csrf_field() }}
  <div class="form-group">
          <label>Select File for Upload</label>
          <input type="file" name="select_file"/><span class="text-muted">.xls, .xslx</span>

  </div>
  <div class="form-group">
  <input type="submit" name="upload" class="btn btn-primary" value="อัพโหลดรายชื่อผู้ใช้">
</div>
</form>
<div class="box box-primary">
        <div class="box-header with-border">
                <a class="btn btn-success btn-xs createNewUser"  data-id=""  href="javascript:void(0)" id="createNewQuestionIAF">
                        <i class="fa fa-plus-circle"></i> เพิ่มผู้ใช้
                      </a>
          <h3 class="box-title">จัดการผู้ใช้</h3>
        </div>
          <div class="box-body table-responsive no-padding">
                <table class="table table-condensed">
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>ชื่อผู้ใช้</th>
                          <th>กลุ่มผู้ใช้</th>
                          <th>โรงเรียน</th>
                          <th>เพิ่มเติม</th>
                        </tr>
                        @foreach ($user as $users )
                         <tr>
                            <td>#</td>
                            <td> {{$users->username}} </td>
                            <td>
                             @forelse ($namegroup as $namegroups)
                                 @if($users->user_group ==  $namegroups->id)
                                 {{$namegroups->name_group }}
                                 @endif
                             @empty
                             ยังได้กำหนด
                             @endforelse
                            </td>
                            <td>
                         @if($users->user_group == '1')
                              @foreach ($nameschool as $nameschools )
                                @if($nameschools->id == $users->school_adminmaster)
                                    {{ $nameschools->name_school_a   }}
                                @endif
                               @endforeach
                          @endif
                          @if($users->user_group == '2')
                               @foreach ($nameschool as $nameschools )
                                 @if($nameschools->id == $users->school_adminschool)
                                    {{ $nameschools->name_school_a   }}
                                 @endif
                               @endforeach
                          @endif
                          @if($users->user_group == '3')
                               @foreach ($nameschool as $nameschools )
                                   @if($nameschools->id == $users->school_parent)
                                           {{ $nameschools->name_school_a   }}
                                    @endif
                               @endforeach
                           @endif
                           @if($users->user_group == '4')
                               @foreach ($nameschool as $nameschools )
                                   @if($nameschools->id == $users->school_teacher)
                                       {{ $nameschools->name_school_a   }}
                                    @endif
                               @endforeach
                          @endif
                            </td>
                            <td>
                             <a class="btn btn-info btn-xs  viewUser"  data-id="{{$users->username}}"  href="javascript:void(0)"><i class="fa fa-eye" ></i></a>
                             <a class="btn btn-warning btn-xs  editUser"  data-id="{{$users->username}}"   href="javascript:void(0)"><i class="fa fa-edit" ></i></a>
                             <a class="btn btn-danger btn-xs   deleteUser" data-id="{{$users->username}}" data-idd="{{$users->id}}" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                            </td>
                         </tr>
                        @endforeach
                      </table>
              </div>
          <div class="box-footer clearfix">
                <div class=" pull-right">
                        {{ $user->links() }}
                </div>
              </div>
        </form>
      </div>


      <div class="modal fade" id="modal-createNewUser">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">
                    <label id="modelHeadingcreateNewUser"> </label>
                  </h4>
                </div>
                <form id="FormcreateNewUser" name="FormcreateNewUser" >
                <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id">
                        <input type="hidden" name="info_id" id="info_id">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>ชื่อผู้ใช้:</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                          </div>
                          <!-- /.form-group -->
                          <div class="form-group">
                            <label>รหัสผ่าน:</label>
                            <input type="text" class="form-control" name="password" id="password"   required>
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>กลุ่มผู้ใช้:</label>
                            <select class="form-control"   name="user_group" id="user_group"  onchange="yesnoCheck(this);"   required>
                                <option value="">ระบุ</option>
                                @forelse ($namegroup as $namegroups)
                                <option value="{{$namegroups->id}}">{{$namegroups->name_group }}
                                </option>
                                @empty
                                <option value="">ระบุ</option>
                                @endforelse
                            </select>
                          </div>
                          <!-- /.form-group -->
                          <div class="form-group">
                            <label>ชื่อ:</label>
                            <select class="form-control"   name="titel" id="titel"  required>
                                    <option value="">ระบุ</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>ชื่อ:</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                          </div>
                          <!-- /.form-group -->
                          <div class="form-group">
                            <label>นามสกุล:</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" required>
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>โทรศัพท์:</label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                          </div>
                          <!-- /.form-group -->
                          <div class="form-group">
                            <label>โรงเรียน:</label>
                            <select class="form-control select2" style="width: 100%;"  name="school"  id="school" required>
                                    <option value="">  ระบุ  </option>
                                   @foreach ($nameschool as $nameschools )
                                    <option value="{{$nameschools->id}}">{{$nameschools->name_school_a}}</option>
                                   @endforeach
                                </select>
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>ชั้น:</label>
                            <select class="form-control" style="width: 100%;"  name="section"  id="section" required>
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
                          <!-- /.form-group -->
                          <div class="form-group">
                            <label>ห้อง:</label>
                            <input type="text" class="form-control" name="room" id="room" required  >
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>รหัสนักเรียน:</label>
                            <select class="form-control select2" style="width: 100%;"   name="id_student"  id="id_student" required>
                                <option value=""> ระบุ</option>

                            </select>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
                  <input type="submit" class="btn btn-primary" id="btnSave-createNewUser" value="" >
                </div>
            </form>
              </div>
            </div>
          </div>
@endsection


@section('scriptUser')
<script src="{{asset('js/User.js')}}"></script>

@endsection

