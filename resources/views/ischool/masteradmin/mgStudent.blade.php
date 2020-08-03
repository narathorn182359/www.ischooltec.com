@extends('ischool.layout.app')
@section('contentheader')
<section class="content-header">
        <h1>
          การจัดการ
          <small>นักเรียน</small>
        </h1>

      </section>


@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

      <h3 class="box-title">นักเรียน</h3>

    </div>
      <div class="box-body table-responsive no-padding">
            <table class="table table-condensed">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>ชื่อโรงเรียน</th>
                      <th>รายชื่อนักเรียน</th>
                    </tr>

                    @forelse ($nameschool as $nameschools )
                     <tr>
                        <td>#</td>
                        <td> {{$nameschools->name_school_a}} </td>
                        <td>
                        <a class="btn btn-warning btn-xs"  href="{{url('/mgmaseterstuden/'.Crypt::encrypt($nameschools->id))}}.'/edit"><i class="fa fa-users" ></i></a>
                        </td>
                     </tr>

                     @empty
                     <tr>
                       <td colspan="2"> ไม่พบข้อมูล !!</td>
                     </tr>

                    @endforelse
              </table>
          </div>
      <div class="box-footer clearfix">
            <div class=" pull-right">
                {{ $nameschool->links() }}
            </div>
          </div>
    </form>
  </div>



@endsection
