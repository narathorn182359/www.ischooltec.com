@extends('ischool.layout.app')
@section('contentheader')

@section('content')


<div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
                    <a href="javascript:void(0)" class="btn btn-success createNew">เพิ่มข่าวใหม่</a>
              <h3 class="box-title">รายการข่าวทั้งหมด</h3>
             
              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>#</th>
                  <th>หัวข้อเรื่อง</th>
                  <th>เพิ่มเติม</th>
                </tr>
                @foreach ($listgetnew as $listgetnews)
                <tr>
                <td>#</td>
                    <td>{{ $listgetnews->headnew}}</td>
                    <td> 
                       
                        <a href="javascript:void(0)" class="btn-sm btn-warning editNew"  data-id="{{ $listgetnews->id}}">แก้ไข</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger deleteNew"  data-id="{{ $listgetnews->id}}">ลบ</a>
                    </td>
                    
                  </tr>
                @endforeach              
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
   <h4>  พรีวิว   </h4>
          @foreach ($listgetnew as $listgetnews)
         
          <div class="row">
              <div id="container">
          <div class="col-md-6">
     <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">{{ $listgetnews->headnew}}</h3>
        </div>
        <div class="box-body">
          <small><i class="fa fa-clock-o">   </i> สร้างวันที่ {{ $listgetnews->created_at}} น.</small>
          <br>

          <br>
          <div id="container">
              <img src="{{asset("imguploadnew/".$listgetnews->img)}} " class="img-thumbnail" alt="Cinque Terre" width="304" height="236"   />
          </div> <br>
          <p style="text-indent: 2.5em;"> {{ $listgetnews->text}} </p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    </div>
  </div>
    @endforeach   
  













      <div class="modal fade" id="modal-addnew">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <form id="form-addnew">
                    <input type="hidden" name="id_new" id="id_new"  value="0"/>
                <div class="modal-body">
                        <div class="form-group">
                                <label for="addnew">รูปภาพ</label>
                                <input type="file"   name="fileimg" id="fileimg"  >
                              </div>
                        <div class="form-group">
                                <label for="addnew">หัวข้อเรื่อง</label>
                                <input type="text" class="form-control" id="headnew" name="headnew"   required>
                              </div>
                              <div class="form-group">
                                <label for="detailnew">เนื้อหา</label>
                                <textarea class="form-control" name="detailnew" id="detailnew" rows="3" required>   </textarea>
                                
                              </div>
        </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
            </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

@endsection
@section('scriptUser')
<script src="{{asset('js/addnew.js')}}"></script>

@endsection