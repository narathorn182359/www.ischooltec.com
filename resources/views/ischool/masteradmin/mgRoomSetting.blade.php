@extends('ischool.layout.app')
@section('contentheader')
<section class="content-header">
        <h1>
          การจัดการ
          <small>ห้องเรียนทั้งหมด</small>
        </h1>

      </section>


@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
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
      <h3 class="box-title">ห้องเรียนทั้งหมด</h3>
    <form method="post" enctype="multipart/form-data" action="{{url('roomsetting')}}">
        {{ csrf_field() }}
        <div class="form-group">
                <label>Select File for Upload</label>
                <input type="file" name="select_file"/><span class="text-muted">.xls, .xslx</span>

        </div>
        <div class="form-group">
        <input type="submit" name="upload" class="btn btn-primary" value="อัพโหลด ครูประจำชั้น">
    </div>
    </form>
    </div>
      <div class="box-body table-responsive no-padding">
            <table class="table table-condensed" id='roomsetting'>
                <thead>
                  <th>ชั้น</th>
                    <th>ห้อง</th>
                    <th>Section</th>
                    <th>ชื่อครู</th>
                    <th>โรงเรืยน</th>
                    <th>เพิ่มเติม</th>
                </thead>

              </table>
          </div>
      <div class="box-footer clearfix">
            <div class=" pull-right">

            </div>
          </div>
    </form>
  </div>



@endsection

@section('scripttable')
<script src="{{asset('js/roomsetting.js')}}"></script>
@endsection
