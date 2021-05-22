@extends('ischool.layout.app')

@section('content')
<div class="col-md-12">
    <div class="box box-success">
      <div class="box-header with-border">
          ห้องเรียน
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body no-padding">
            <table class="table table-condensed">
                    <tr>
                      <th>ห้อง</th>
                      <th>เพิ่มเติม</th>
                    </tr>
                    @foreach ( $getroom  as $item)
                    <tr>
                        <td>
                          {{$item->name_class}} /  {{$item->room_rm}}
                        </td>
                        <td>
                        <a href="{{url('/clssroom/'.$item->id_s.'/'.$item->room_rm)}}" class="btn btn-success btn-sm">ดู</a>
                        <a href="#" class="btn btn-warning btn-sm">ประชามสัมพันธิ์</a>
                        </td>
                    </tr>
                    @endforeach
              </table>
          </div>
    </div>
    <div class=" text-center">


    </div>

</div>
@endsection