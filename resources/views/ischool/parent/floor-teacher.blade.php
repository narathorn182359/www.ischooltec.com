@extends('ischool.layout.app')
@section('contentheader')
<section class="content-header">
        

      </section>


@endsection
@section('content')
<div class="row">
    <div id="container">
    <div class="col-md-6">
    <div class="box box-success">
    <div class="box-header with-border">
    <h3 class="box-title">ครูประจำชั้น</h3>
    </div>
    <div class="box-body">
      @foreach($getuserstudent as  $getuserstudents)
      <img src="{{$getuserstudents->img}}"  alt="ครูประจำชั้น" class="profile-user-img img-responsive img-circle">
      <p><b>ชื่อ-สกุล:</b>{{$getuserstudents->titel_teacher }}   {{$getuserstudents->name_teacher }}  {{$getuserstudents->lastname_teacher }}   </p>
      <p><b>โทรศัพ</b>:{{$getuserstudents->phone_teacher }}      </p>
      @endforeach
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection