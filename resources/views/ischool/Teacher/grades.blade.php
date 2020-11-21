@extends('ischool.layout.app')
@section('contentheader')
<section class="content-header">
        <h1>
         ผลการเรียน
        </h1>
      </section>
@endsection

@section('content')
    <input type="hidden" name="id" value="{{$id}}" id="id">
    <input type="hidden" name="team" value="" id="team">

<div class="col-md-12">
        <!-- MAP & BOX PANE -->
        <div class="box box-success">
          <div class="box-header with-border">
{{$studeninfo->name}} {{$studeninfo->lastname}}
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>

            </div>
          </div>
          <div class="box-body no-padding">
                <table class="table table-condensed">
                        <tr>
                          <th>เทอม</th>
                          <th>เพิ่มเติม</th>
                          <th>รูป</th>
                        </tr>
                        @foreach ( $alf_term  as $item)
                        <tr>
                            <td>
                                {{$item->term}}
                            </td>
                            <td>
                                <a class="btn btn-warning btn-xs  upload"   data-id="{{$item->id_term }}"  href="javascript:void(0)">อัพโหลด</a>


                            </td>
                            <td>
                                @foreach ($alf_grade as $items)

                                        @if ( $item->id_term  == $items->id_term)
                            <img src="{{url('images/'.$items->image)}}" alt=""  width="150"  height="150">
                            <a class="btn btn-danger btn-xs  delete"   data-id="{{$items->id_grade  }}"  href="javascript:void(0)">ลบ</a>
                                        @endif
                                @endforeach

                            </td>
                        </tr>
                        @endforeach

                  </table>

              </div>
        </div>
        <div class=" text-center">


        </div>

    </div>
    <div class="modal fade" id="modal-upload">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modelHeading"></h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <div class="file-loading">
                <input id="image-file" type="file" name="file" accept="image/*" data-min-file-count="1"
                multiple>
                </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('scripttable')
<script src="{{asset('js/grades.js')}}"></script>

<script type="text/javascript">
$('body').on('click','.upload',function(){
        $('#form-upgrade').trigger("reset");
        $('#modelHeading').html("อัพโหลด");
        $('#modal-upload').modal('show');
        document.getElementById("team").value = $(this).data('id');
        var id = document.getElementById('id').value
        var idt = document.getElementById('team').value
           $("#image-file").fileinput({
           theme: 'fa',
           uploadUrl: "/uploadimag/" + id +"/"+idt,
           uploadExtraData: function() {
           return {
           _token: "{{ csrf_token() }}",
           };
           },
           allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
           overwriteInitial: false,
           maxFileSize: 2048,
           maxFilesNum: 10
           })
           $('#image-file').on('fileuploaded', function(event, data, previewId, index) {
           window.location.reload();
           })
           function encodeImageFileAsURL(element) {
           var file = element.files[0];
           var reader = new FileReader();
           reader.onloadend = function() {
           $('#img').val(reader.result);
           }
           reader.readAsDataURL(file);
           }
      });

    </script>
@endsection
