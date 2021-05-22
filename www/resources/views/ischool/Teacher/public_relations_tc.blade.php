@extends('ischool.layout.app')
@section('contentheader')
<section class="content-header">
        <h1>
          ประชาสัมพันธ์
          
        </h1>

      </section>


@endsection
@section('content')
@foreach ($relations as $listgetnews)
         
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

@endsection