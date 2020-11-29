@extends('ischool.layout.app')
@section('content')

    <div class="row">
      
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
            <form
                action="{{ url('/search_useradminschool')}}"
                method="PUT" role="search">
                <input type="hidden" name="code_student" value="{{ request()->route('id') }}">
                <input type="hidden" name="code_school" value="{{ request()->route('school') }}">
      
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ชื่อผู้ใช้</label>
                               <input type="text" class="form-control" id="username" name="username">
                            </div>
                           
                        </div>
                       
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <input type="submit" class="btn btn-success" value="ค้นหา">
                </div>
            </form>
            <!-- /.box-footer -->
        </div>
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">จัดการผู้ใช้</h3>
                    <a class="btn btn-success btn-xs createNewUserSchool" data-id="" href="javascript:void(0)"
                        id="createNewQuestionIAF">
                        <i class="fa fa-plus-circle"></i> เพิ่มผู้ใช้
                    </a>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-condensed">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>ชื่อ-สกุล</th>
                            <th>กลุ่มผู้ใช้</th>
                            <th>เพิ่มเติม</th>
                        </tr>
                        @foreach ($userSchool as $users)
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    {{ $users->username }}

                                </td>
                                <td>
                                    {{ $users->titel_teacher }}
                                    {{ $users->name_teacher }}
                                    {{ $users->lastname_teacher }}
                                    {{ $users->titel_parent }}
                                    {{ $users->name_parent }}
                                    {{ $users->lastname_parent }}
                                </td>
                                <td>
                                    @forelse ($namegroup as $namegroups)
                                        @if ($users->user_group == $namegroups->id)
                                            {{ $namegroups->name_group }}
                                        @endif
                                    @empty
                                        ยังได้กำหนด
                        @endforelse
                        </td>
                        <td>
                            <a class="btn btn-info btn-xs  viewUser" data-id="{{ $users->username }}"
                                href="javascript:void(0)"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-warning btn-xs  editUser" data-id="{{ $users->username }}"
                                href="javascript:void(0)"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-xs   deleteUser_sc" data-id="{{ $users->username }}"
                                data-idd="{{ $users->id }}" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                        </td>
                        </tr>

                        @endforeach
                    </table>

                    {{ $userSchool->links() }}





                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-addnew">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <lable id="modelHeading"> </lable>
                    </h4>
                </div>
                <form id="add-user-school">
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
                                    <input type="text" class="form-control" name="password" id="password" required>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>กลุ่มผู้ใช้:</label>
                                    <select class="form-control" name="user_group" id="user_group"
                                        onchange="yesnoCheck(this);" required>
                                        <option value="">ระบุ</option>
                                        @forelse ($namegroup as $namegroups)
                                            <option value="{{ $namegroups->id }}">{{ $namegroups->name_group }}
                                            </option>
                                        @empty
                                            <option value="">ระบุ</option>
                                        @endforelse
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>คำนำหน้า:</label>
                                    <select class="form-control" name="titel" id="titel" required>
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
                                    <label>ชั้น:</label>
                                    <select class="form-control" style="width: 100%;" name="section" id="section" required>
                                        <option value=""> ระบุ </option>
                                        <option value="1"> ม.1 </option>
                                        <option value="2"> ม.2 </option>
                                        <option value="3"> ม.3 </option>
                                        <option value="4"> ม.4 </option>
                                        <option value="5"> ม.5 </option>
                                        <option value="6"> ม.6 </option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ห้อง:</label>
                                    <input type="text" class="form-control" name="room" id="room" required>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>ชื่อนักเรียน:</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_student"
                                        id="id_student" required>
                                        <option value=""> ระบุ</option>
                                        @foreach ($namestuden as $namestudens)
                                            <option value="{{ $namestudens->student_code_id }}"> {{ $namestudens->name }}
                                                {{ $namestudens->lastname }} </option>


                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary" id="submit">บันทึก</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection
@section('scriptSchool')
    <script src="{{ asset('js/adduser_school.js') }}"></script>
@endsection
