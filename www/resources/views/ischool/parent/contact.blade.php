@extends('ischool.layout.app')
@section('contentheader')
<section class="content-header">
        <h1>
         
          
        </h1>

      </section>


@endsection
@section('content')
<div class="row">
    <div id="container">
    <div class="col-md-6">
    <div class="box box-success">
    <div class="box-header with-border">
    <h3 class="box-title"> ติดต่อโรงเรียน</h3>
    </div>
    <div class="box-body">
        @foreach($getuserstudent as  $getuserstudents)
        
        <p><b>โรงเรียน:</b>{{$getuserstudents->name_school_a }} </p>
        <p><b>ที่อยู่:</b>{{$getuserstudents->address }}      </p>
        <p><b>โทรศัพท์:</b>{{$getuserstudents->phone }}      </p>
        <p><b>อีเมล์:</b>{{$getuserstudents->email }}      </p>
        @endforeach
    </div>
    </div>
    </div>
    </div>
    </div>

@endsection