$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
//----------------------------------------จัดการโรงเรียน------------------------------------------------------- //
  $('body').on('click','.createNewSchool',function(){
    $('#btnSave-createNewSchool').val("บันทึก");
    $('#FormcreateNewSchool').trigger("reset");
    $('#modelHeadingcreateNewSchool').html("เพิ่มโรงเรียน");
    $('#modal-createNewSchool').modal('show');
  });

  $("#FormcreateNewSchool").submit(function(e) {
    e.preventDefault();
    var drgree_id = $(this).data('id');

      $.ajax({
        data: $('#FormcreateNewSchool').serialize(),
        url: "/mgmaseterschool",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            Swal.fire({
                type: 'success',
                title: 'สำเร็จ',
                text: '----------- ',
              }).then(function(){
                location.reload();
                });

        },
        error: function (data) {
            Swal.fire({
                type: 'error',
                title: 'ผิดพลาด',
                text: '----------- ',
              })
        }
    });
});


$('body').on('click', '.editStundent', function () {
  var id_school = $(this).data('id');
  $.get("/mgmaseterschool" +'/' + id_school +'/edit', function (data) {
        $('#btnSave-createNewSchool').val("บันทึก");
        document.getElementById("btnSave-createNewSchool").disabled = false;
        $('#FormcreateNewSchool').trigger("reset");
        $('#modelHeadingcreateNewSchool').html("แก้ไขโรงเรียน");
        $('#modal-createNewSchool').modal('show');
        $('#id_school').val(data[0].id);
        $('#name_school').val(data[0].name_school_a);
        $('#email').val(data[0].email);
        $('#address').val(data[0].address);
        $('#phone').val(data[0].phone);
         console.log(data);
  })
});

$('body').on('click', '.viewStundent', function () {
    var id_school = $(this).data('id');
    $.get("/mgmaseterschool" +'/' + id_school , function (data) {
        $('#btnSave-createNewSchool').val("บันทึก");
          document.getElementById("btnSave-createNewSchool").disabled = true;
          $('#FormcreateNewSchool').trigger("reset");
          $('#modelHeadingcreateNewSchool').html("แสดงข้อมูล");
          $('#modal-createNewSchool').modal('show');
          $('#id_school').val(data[0].id);
          $('#name_school').val(data[0].name_school);
          $('#email').val(data[0].email);
          $('#address').val(data[0].address);
          $('#phone').val(data[0].phone);

    })
  });


$('body').on('click', '.deleteStundent', function () {
  var questionsec_id = $(this).data("id");
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
        url: "mgmaseterschool"+'/'+questionsec_id,
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
//--------------------------จบจัดการโรงเรียน------------------------------------------------------------------------ //














});
