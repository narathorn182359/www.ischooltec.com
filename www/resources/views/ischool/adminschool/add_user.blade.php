@extends('ischool.layout.app')
@section('content')

    <div class="row">
      
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
               บันทึกสำเร็จ
              </div>
              @endif
       {{--    <div class="box box-primary">
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
        </div> --}}
   
         
        <div class="box box-success">
            <div class="box-header with-border">
              
            
            </div>
            <div class="box-body ">
                <div class="row">
                    <div  class="col-md-6">
                        <form action="{{ url('dowloadtexam') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">โหลดไฟล์สำหรับการอัพโหลด</label>
                                <input type="submit" value="โหลด  (นักเรียน ผู้ปกครอง)" class="btn btn-warning">
                            </div>
                        </form>
                        <form action="{{ url('dowloadtexamtech') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">โหลดไฟล์สำหรับการอัพโหลด</label>
                                <input type="submit" value="โหลด (ครู)" class="btn btn-info">
                            </div>
                        </form>
                    </div>
                    <div  class="col-md-6">
                        <form  action="{{ url('importDataUser') }}"  method="post" enctype="multipart/form-data">
                            @csrf
                     
                            <input type="file" name="import_file"  required/> <br>
                            <input type="submit" value="อัปโหลด" class="btn btn-success">
                            
                        </form>
                    </div>
                </div>
              
            
             
            
        

            </div>
        </div>
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">จัดการผู้ใช้ (ครู)</h3>
                    <a class="btn btn-success btn-xs createNewUserSchool" data-id="" href="javascript:void(0)"
                        id="createNewQuestionIAF">
                        <i class="fa fa-plus-circle"></i> เพิ่มผู้ใช้
                    </a>
                
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-condensed"  id="table_admin_userteacher">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ชื่อผู้ใช้</th>
                                <th>ชื่อ - นามสกุล</th>
                                <th>เพิ่มเติม</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">จัดการผู้ใช้ (นักเรียน ผู้ปกครอง)</h3>
                    <a class="btn btn-success btn-xs createNewUserSchool" data-id="" href="javascript:void(0)"
                        id="createNewQuestionIAF">
                        <i class="fa fa-plus-circle"></i> เพิ่มผู้ใช้
                    </a>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-condensed"  id="table_admin_studens">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ชื่อผู้ใช้</th>
                                <th>ชื่อ - นามสกุล</th>
                                <th>เพิ่มเติม</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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


    <div class="modal fade" id="modal-addroom">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <lable id="modelHeadingroom"> </lable>
                    </h4>
                </div>
                <form id="form-addroom">
                    <div class="modal-body">
                        <input type="hidden" name="user_id_addroom" id="user_id_addroom">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ชั้น:</label>
                                    <select class="form-control" style="width: 100%;" name="sectionaddroom" id="sectionaddroom" required>
                                        <option value=""> ระบุ </option>
                                        <option value="1"> ม.1 </option>
                                        <option value="2"> ม.2 </option>
                                        <option value="3"> ม.3 </option>
                                        <option value="4"> ม.4 </option>
                                        <option value="5"> ม.5 </option>
                                        <option value="6"> ม.6 </option>
                                        <option value="7"> ปวช.1 </option>
                                        <option value="8"> ปวช.2 </option>
                                        <option value="9"> ปวช.3 </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>ห้อง:</label>
                                  <input type="number" name="roomaddroom" id="roomaddroom" class="form-control" min="1" max="20" required>
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
    <script src="{{ asset('js/adduser_school.js?ver='.time()) }}"></script>
    <script src="{{ asset('js/datatables.js?ver='.time()) }}"></script>
    <script src="{{ asset('js/room.js?ver='.time()) }}"></script>
@endsection
