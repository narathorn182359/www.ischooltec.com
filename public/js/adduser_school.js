
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('body').on('click','.createNewUserSchool',function(){
  
    $('#add-user-school').trigger("reset");
    $('#modelHeading').html("เพิ่มผู้ใช้");
    $('#modal-addnew').modal('show');
    document.getElementById("password").disabled = false;
    document.getElementById("submit").disabled = false;
  });

  $("#add-user-school").submit(function(e) {
    e.preventDefault();
      $.ajax({
        data: $('#add-user-school').serialize(),
        url: "/mgadminschool",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            if(data.double == "double"){
                Swal.fire({
                    type: 'warning',
                    title: 'ชื่อผู้ใช้ซ้ำค่ะ',
                    text: '----------- ',
                  })
            }else{
                Swal.fire({
                    type: 'success',
                    title: 'สำเร็จ',
                    text: '----------- ',
                  }).then(function(){
                    location.reload();
                    });
            }
          

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



$('body').on('click', '.viewUser', function () {
    var id = $(this).data('id');
    $.get("/mgadminschool" +'/' + id , function (data) {
        $('#add-user-school').trigger("reset");
        $('#modelHeading').html("เพิ่มผู้ใช้");
        $('#modal-addnew').modal('show');

        $('#room').val(data.room);
        $('#lastname').val(data.lastname);
        $('#name').val(data.name);
        $('#phone').val(data.phone);
        $('#section').val(data.section);
        $('#username').val(data.username);
        $('#titel').val(data.titel);
        $('#user_group').val(data.user_group);
        if (data.user_group == "3") {
            document.getElementById("section").disabled = true;
            document.getElementById("room").disabled = true;
            document.getElementById("id_student").disabled = false;
          }
        
        
          if (data.user_group == "4") {
            document.getElementById("id_student").disabled = true;
            document.getElementById("section").disabled = false;
            document.getElementById("room").disabled = false;
        
          }
       document.getElementById("password").disabled = true;
       document.getElementById("submit").disabled = true;
    })
  });

  $('body').on('click', '.editUser', function () {
    var id = $(this).data('id');
    $.get("/mgadminschool" +'/' + id , function (data) {
        $('#add-user-school').trigger("reset");
        $('#modelHeading').html("เพิ่มผู้ใช้");
        $('#modal-addnew').modal('show');
        $('#room').val(data.room);
        $('#lastname').val(data.lastname);
        $('#name').val(data.name);
        $('#phone').val(data.phone);
        $('#section').val(data.section);
        $('#username').val(data.username);
        $('#titel').val(data.titel);
        $('#user_group').val(data.user_group);
        $('#user_id').val(data.id);
        $('#info_id').val(data.id_info);
        $('#id_student').val(data.id_student);
        console.log(data)
        if (data.user_group == "3") {
            document.getElementById("section").disabled = true;
            document.getElementById("room").disabled = true;
            document.getElementById("id_student").disabled = false;

          }
        
        
          if (data.user_group == "4") {
            document.getElementById("id_student").disabled = true;
            document.getElementById("section").disabled = false;
            document.getElementById("room").disabled = false;
           
        
          }
       document.getElementById("password").disabled = false;
       document.getElementById("submit").disabled = false;
    })
  });


  $('body').on('click', '.deleteUser_sc', function () {
    var questionsec_id = $(this).data("id");
    var id = $(this).data("idd");
  
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
          url: "mgadminschool_d"+'/'+questionsec_id+'/'+id,
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


  $('.select2').select2()


  function yesnoCheck(that) {

  
  
    if (that.value == "3") {
      document.getElementById("section").disabled = true;
      document.getElementById("room").disabled = true;
      document.getElementById("id_student").disabled = false;
    }
  
  
    if (that.value == "4") {
      document.getElementById("id_student").disabled = true;
      document.getElementById("section").disabled = false;
      document.getElementById("room").disabled = false;
  
    }
  
  }