@extends('ischool.layout.app')

@section('content')
@hasrole('parent')

@foreach ($getuserstudent as  $getuserstudents)


 


          <div class="row">
                        <div class="col-md-6">
                                        <div class="nav-tabs-custom">
                                          <ul class="nav nav-tabs">
                                            <li class="active"><a href="#profile" data-toggle="tab">ประวัตส่วนตัว</a></li>
                                            <li><a href="#parent" data-toggle="tab">ผู้ปกครอง</a></li>
                                            <li><a href="#teacher" data-toggle="tab">ครูประจำชั้น</a></li>
                                          </ul>
                                          <div class="tab-content">
                                            <div class="active tab-pane" id="profile">
                                                 <div class="row">
                                                                <div class="box-body box-profile">
                                                                                <img class="profile-user-img img-responsive img-circle" src="{{url('/imgstudent/'.$getuserstudents->img_student)  }}" alt="User profile picture">
                                                                                  <h3 class="profile-username text-center"></h3>       
                                                                                </div>
                                                 </div>
                                                  <div class="row">
                                                      <div class="form-group">
                                                              <div class="col-sm-4 col-md-4">
                                                                      <b>ชื่อ-สกุล:</b>  
                                                                      {{$getuserstudents->title}}
                                                                      {{$getuserstudents->name}}
                                                                      {{$getuserstudents->lastname}}
                                                              </div>
                                                      </div>
                                                      <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>รหัสนักเรียน:</b>  
                                                                  {{$getuserstudents->student_code_id}}
                                                          </div>
                                                      </div>
                                                      
                                                      <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>ระดับชั้น:</b>
                                                                  -
                                                          </div>
                                                      </div>
                                                   
                                                  </div>
                                                 
                                                  <div class="row">
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>วันเกิด:</b>
                                                                  {{$getuserstudents->birthday}}  
                                                          </div>
                                                      </div>
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>สัญชาติ:</b>
                                                                  {{$getuserstudents->nationality}}  
                                                          </div>
                                                      </div>
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>ระดับชั้น:</b>
                                                                  {{$getuserstudents->name_degree}}  
                                                          </div>
                                                      </div>
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>ศาสนา:</b>
                                                                  {{$getuserstudents->race}}  
                                                          </div>
                                                      </div>
                          
                                                  </div>
                                                  <div class="row">
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>หมู่เลือด:</b>
                                                                   
                                                          </div>
                                                      </div>
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>โทรศัพท์:</b>
                                                                  {{$getuserstudents->tel}}  
                                                          </div>
                                                      </div>
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>เลขที่:</b>
                                                                 -
                                                          </div>
                                                      </div>
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>หมู่ที่:</b>
                                                                  -
                                                          </div>
                                                      </div>
                                                  </div>  
                                                  <div class="row">
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>ถนน:</b>
                                                                  -
                                                          </div>
                                                      </div>
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>ซอย:</b>
                                                                  - 
                                                          </div>
                                                      </div>
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>หมู่บ้าน:</b>
                                                                  -
                                                          </div>
                                                      </div>
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>ตำบล:</b>
                                                                  -  
                                                          </div>
                                                      </div>
                                                  </div>  
                                                  <div class="row">
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>อำเภอ:</b>
                                                                  -
                                                          </div>
                                                          </div>
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>จังหวัด:</b>
                                                                  -  
                                                          </div>
                                                      </div>
                                                          <div class="form-group">
                                                          <div class="col-sm-4 col-md-4">
                                                                  <b>รหัสไปรษณีย์:</b>
                                                                  - 
                                                          </div>
                                                      </div>
                                                          
                                                  </div>       
                                            </div>
                                            <div class="tab-pane" id="parent">
                                                  <div class="row">
                                                          <div class="form-group">
                                                                  <div class="col-sm-4 col-md-4">
                                                                          <b>ชื่อ-สกุล:</b>
                                                                          {{$getuserstudents->father}}    
                                                                  </div>
                                                         
                                                          
                                                              <div class="col-sm-4 col-md-4">
                                                                      <b>พ่อ</b>
                                                                      
                                                              </div>
                                                          </div>
                                                          </div>
                                                              <div class="row">
                                                                      <div class="form-group">
                                                              <div class="col-sm-4 col-md-4">
                                                                      <b>ชื่อ-สกุล:</b>
                                                                      {{$getuserstudents->mom}} 
                                                              </div>
                                                         
                                                         
                                                              <div class="col-sm-4 col-md-4">
                                                                      <b>แม่</b>
                                                                      
                                                              </div>
                                                          </div>
                                                      </div>
                                            </div>
                                            <div class="tab-pane" id="teacher">
                                                  <div class="row">
                                                          <div class="form-group">
                                                                  <div class="col-sm-4 col-md-4">
                                                                          <b>ชื่อ-สกุล:</b>
                                                                          {{$getuserstudents->titel_teacher}}  
                                                                          {{$getuserstudents->name_teacher}}  
                                                                          {{$getuserstudents->lastname_teacher}}  
                                                                  </div>
                                                         
                                                          
                                                              <div class="col-sm-4 col-md-4">
                                                                      
                                                              </div>
                                                          </div>
                                                          </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                                <div class="box box-solid">
                                                  <div class="box-header with-border">
                                                    <h3 class="box-title">ข่าวประชาสัมพันธ์</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body">
                                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                                      <ol class="carousel-indicators">
                                                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                                        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                                      </ol>
                                                      <div class="carousel-inner">
                                                        <div class="item active">
                                                          <img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">
                                      
                                                          <div class="carousel-caption">
                                                            First Slide
                                                          </div>
                                                        </div>
                                                        <div class="item">
                                                          <img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">
                                      
                                                          <div class="carousel-caption">
                                                            Second Slide
                                                          </div>
                                                        </div>
                                                        <div class="item">
                                                          <img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">
                                      
                                                          <div class="carousel-caption">
                                                            Third Slide
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                                        <span class="fa fa-angle-left"></span>
                                                      </a>
                                                      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                                        <span class="fa fa-angle-right"></span>
                                                      </a>
                                                    </div>
                                                  </div>
                                                  <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                              </div>
          </div>
     
          @endforeach
          @endrole
@endsection
