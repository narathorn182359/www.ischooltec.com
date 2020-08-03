@extends('ischool.layout.app')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <a class="btn btn-success btn-xs createNewterm"  data-id=""  href="javascript:void(0)" id="createNewQuestionIAF">
            <i class="fa fa-plus-circle"></i> เพิ่มภาคเรียน
          </a>
      <h3 class="box-title">จัดการภาคเรียน</h3>
    </div>
      <div class="box-body table-responsive no-padding">
            <table class="table table-condensed">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>ชื่อโรงเรียน</th>
                      <th>ภาคเรียนปัจจุบัน</th>
                      <th>เพิ่มเติม</th>
                    </tr>

                    @foreach ($nameschool as $nameschools )
                     <tr>
                        <td>#</td>
                        <td> {{ $nameschools->name_school_a}} </td>
                        <td>
                         {{  $nameschools->term }}
                        </td>
                        <td> 
                         <a class="btn btn-success btn-xs  createTerm"  data-id="{{$nameschools->id}}"  href="javascript:void(0)"><i class="fa fa-edit" ></i></a>
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

  <div class="modal fade" id="modal-term">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">ภาคเรียน</h4>
        </div>
        <form id="add-term">
        <div class="modal-body">
            <input type="hidden"  name="id_school" id="id_school" value="">
            <label>เลือกเทอม:</label>
        <select class="form-control"  name="term" id="term">
            <option value="">ระบุ</option>
            @foreach ($list_term as $item)
                <option value="{{ $item->id_term }}">{{$item->term}}</option>
            @endforeach

        </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
      </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



  <div class="modal fade" id="modal-term">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">ภาคเรียน</h4>
        </div>
        <form id="add-term">
        <div class="modal-body">
            <input type="hidden"  name="id_school" id="id_school" value="">
            <label>เลือกเทอม:</label>
          <select class="form-control"  name="term" id="term">
            <option value="">ระบุ</option>
            @foreach ($list_term as $item)
                <option value="{{ $item->id_term }}">{{$item->term}}</option>
            @endforeach

        </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
      </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modal-createNewterm">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">ภาคเรียน</h4>
        </div>
        <form id="add-Newterm">
        <div class="modal-body">
            <input type="hidden"  name="id_term" id="id_term" value="">
            <label>เพิ่มภาคเรียน:</label>
             <input class="form-control"  name="add_Newterm" id="add_Newterm" >
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
      </form>
      </div>
    </div>
  </div>








@endsection
@section('scriptSchool')
<script src="{{asset('js/term.js')}}"></script>
@endsection