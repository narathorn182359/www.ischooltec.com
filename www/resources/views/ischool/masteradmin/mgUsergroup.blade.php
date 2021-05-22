@extends('ischool.layout.app')
@section('contentheader')
<section class="content-header">
        <h1>
          การจัดการ
          <small>กลุ่มผู้ใช้</small>
        </h1>

      </section>


@endsection
@section('content')

@foreach ($collection as $collections )
{{$collections['date']}}
{{$collections['Descripiton']}}  <br>
@endforeach


@endsection
