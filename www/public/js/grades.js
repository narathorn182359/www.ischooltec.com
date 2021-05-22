$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });





    $('body').on('click', '.delete', function () {
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
              url: "/deletegrades",
              data:{
                  id:id
              },
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






})
