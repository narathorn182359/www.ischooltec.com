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

      <h3 class="box-title">ห้องเรียนทั้งหมด</h3>

    </div>
      <div class="box-body table-responsive no-padding">
            <table class="table table-condensed" id='roomsetting'>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>ชื่อโรงเรียน</th>
                      <th>รายชื่อนักเรียน</th>
                    </tr>


              </table>
          </div>
      <div class="box-footer clearfix">
            <div class=" pull-right">

            </div>
          </div>
    </form>
  </div>



@endsection
