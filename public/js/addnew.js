$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
//----------------------------------------จัดการโรงเรียน------------------------------------------------------- //
  $('body').on('click','.createNew',function(){
  
    $('#form-addnew').trigger("reset");
    $('#modelHeading').html("เพิ่มข่าวใหม่");
    $('#modal-addnew').modal('show');
  });

    

  
  $("#form-addnew").submit(function(e) {
    e.preventDefault();
    var  id_new  =   $('#id_new').val();
    var  headnew   = $('#headnew').val();
    var  detailnew   = $('#detailnew').val();
    var  form_data = new FormData();
    form_data.append('fileimg',$("#fileimg")[0].files[0]);
  
    form_data.append('headnew', headnew);
    form_data.append('id_new', id_new);
    form_data.append('detailnew', detailnew);
      $.ajax({
        data: form_data,
        url: "/mgadminnewschool",
        type: "POST",
        contentType:false,
        processData:false,
        success: function (data) {
            Swal.fire({
                type: 'success',
                title: 'สำเร็จ',
                text: '-----------',
              }).then(function(){
                location.reload();
                });

        },
        error: function (data) {
            Swal.fire({
                type: 'error',
                title: 'ผิดพลาด',
                text: '-----------',
              })
        }
    });
});


$('body').on('click', '.editNew', function () {
  var id_new = $(this).data('id');
  $.get("/mgadminnewschool" +'/' + id_new +'/edit', function (data) {
    $('#form-addnew').trigger("reset");
    $('#modelHeading').html("แก้ใข้");
    $('#modal-addnew').modal('show');
    $('#id_new').val(data[0].id);
    $('#headnew').val(data[0].headnew);
    $('#detailnew').val(data[0].text);
   
  })
});

$('body').on('click', '.detailNew', function () {
    var id_school = $(this).data('id');
    $.get("/mgadminnewschool" +'/' + id_school , function (data) {
        $('#btnSave-createNewSchool').val("บันทึก");
        $('#form-addnew').trigger("reset");
        $('#modelHeading').html("เพิ่มข่าวใหม่");
        $('#modal-addnew').modal('show');
    

    })
  });


$('body').on('click', '.deleteNew', function () {
  var id_new = $(this).data("id");
  //confirm("Are You sure want to delete !");
  Swal.fire({
    title: 'ยืนยันการลบข้อมูล?',
    text: "กรุณาตรวจสอบก่อนยืนยัน!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ตกลง',
    cancelButtonText:  'ยกเลิก',
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "DELETE",
        url: "mgadminnewschool"+'/'+id_new,
        success: function (data) {
          Swal.fire(
            'ลบข้อมูลสำเร็จ!',
            'หากสงสัยข้อมูลกรุณาติดต่อทีมพัฒนา',
            'success'
          ).then(function(){
            location.reload();
            });
        },
        error: function (data) {
          Swal.fire({
            type: 'error',
            title: 'ผิดพลาด',
            text: 'ไม่สามารถลบได้กรุณาติดต่อทีมพัฒนา',
            confirmButtonText: 'ตกลง',

          })
        }
    });

    }
  })
});

});
