$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(document).ready(function () {
        $("#roomsetting").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/roomsettingdata",
                dataType: "json",
                type: "POST",
                data: { _token: $("#token").val() },
            },
            columns: [
                
                { data: "name_class" },
                { data: "room_rm" },
                { data: "section_rm" },
                { data: "name_tc" },
                { data: "school_rm" },
                { data: "options" },
            ],
        });
    });



    $('body').on('click', '.deleteRoom', function () {
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
              type: "DELETE",
              url: "roomsetting"+'/'+id,
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
