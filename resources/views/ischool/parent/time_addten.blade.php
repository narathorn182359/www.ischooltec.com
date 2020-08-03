@extends('ischool.layout.app')
@section('contentheader')
<section class="content-header">
        <h1>
         ประวัติการเข้าออกโรงเรียน
        
        </h1>

      </section>


@endsection
@section('content')
<div class="box box-success">
  <div class="box-body">
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
              <select class="form-control select2" style="width: 100%;" name="code_month">
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
                      <select class="form-control select2" style="width: 100%;" name="code_status">
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
</div>
@endsection