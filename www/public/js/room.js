
$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });


    $('body').on('click','.addroom',function(){
        var id = $(this).data('id');
        $('#user_id_addroom').val(id);
        $('#btnSave-createNewSchool').val("บันทึก");
        $('#form-addroom').trigger("reset");
        $('#modelHeadingroom').html("เพิ่มเพิ่มห้องเรียน");
        $('#modal-addroom').modal('show');
      });




      

      $('body').on('click', '.editAddroom', function () {
        var id_room = $(this).data('id');
        $.get("/editaddroom/"+ id_room , function (data) {
              $('#form-addroom').trigger("reset");
              $('#modelHeadingroom').html("แก้ไขห้องเรียน");
              $('#modal-addroom').modal('show');
              $('#sectionaddroom').val(data.class_rm);
              $('#roomaddroom').val(data.room_rm);
        })
      });



      

      $('body').on('click', '.deleteAddroom', function () {
        var id = $(this).data("id");
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
              type: "POST",
              url: "deleteaddroom"+'/'+id,
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

      $("#form-addroom").submit(function(e) {
        e.preventDefault();
          $.ajax({
            data: $('#form-addroom').serialize(),
            url: "/addroomtc",
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


});




 
      