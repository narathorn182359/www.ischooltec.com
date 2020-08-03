@extends('ischool.layout.app')
@section('contentheader')
<section class="content-header">
        <h1>
          การจัดการ
          <small>โรงเรียน</small>
        </h1>

      </section>


@endsection
@section('content')

 <div class="box box-primary">
        <div class="box-header with-border">
                <a class="btn btn-success btn-xs createNewSchool"  data-id=""  href="javascript:void(0)" id="createNewQuestionIAF">
                        <i class="fa fa-plus-circle"></i> เพิ่มโรงเรียน
                      </a>
          <h3 class="box-title">จัดการโรงเรียน</h3>
        </div>
          <div class="box-body table-responsive no-padding">
                <table class="table table-condensed">
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>ชื่อโรงเรียน</th>
                          <th>นักเรียนทั้งหมด</th>
                          <th>เพิ่มเติม</th>
                        </tr>

                        @foreach ($nameschool as $nameschools )
                         <tr>
                            <td>#</td>
                            <td> {{$nameschools->name_school_a}} </td>
                            <td>
                              -

                            </td>
                            <td>
                             <a class="btn btn-info btn-xs  viewStundentDetail"  data-id="{{$nameschools->id}}"  href="javascript:void(0)"><i class="fa fa-eye" ></i></a>
                             <a class="btn btn-warning btn-xs  editStundent"  data-id="{{$nameschools->id}}"  href="javascript:void(0)"><i class="fa fa-edit" ></i></a>
                             <a class="btn btn-danger btn-xs   deleteStundent" data-id="{{$nameschools->id}}" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                            </td>
                         </tr>
                        @endforeach
                      </table>
              </div>
          <div class="box-footer clearfix">
                <div class=" pull-right">
                        {{ $nameschool->links() }}
                </div>
              </div>
        </form>
      </div>
      <div class="modal fade" id="modal-createNewSchool">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">
                    <label id="modelHeadingcreateNewSchool"> </label>
                  </h4>
                </div>
                <form id="FormcreateNewSchool" name="FormcreateNewSchool" >
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_school" id="id_school">
                        <label>ชื่อโรงเรียน:</label>
                        <input type="text" class="form-control" name="name_school" id="name_school" required>
                    </div>
                    <div class="form-group">
                            <label>อีเมล:</label>
                            <input type="email" class="form-control" name="email" id="email"  >
                        </div>
                    <div class="form-group">
                        <label>ที่อยู่:</label>
                        <textarea class="form-control" name="address" id="address" cols="30" rows="2" style="resize:none" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>โทรศัพท์:</label>
                        <input type="text" class="form-control" name="phone" id="phone" required>
                    </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
                  <input type="submit" class="btn btn-primary" id="btnSave-createNewSchool" value="" >
                </div>
            </form>
              </div>
            </div>
          </div>
@endsection



@section('scriptSchool')
<script src="{{asset('js/School.js')}}"></script>
@endsection

