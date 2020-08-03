


$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

$('body').on('click','.createNewUser',function(){
    $('#btnSave-createNewUser').val("บันทึก");
    $('#FormcreateNewUser').trigger("reset");
    $('#modelHeadingcreateNewUser').html("เพิ่มผู้ใช้");
    $('#modal-createNewUser').modal('show');
  });

  $("#FormcreateNewUser").submit(function(e) {
    e.preventDefault();
    var user_id = $(this).data('id');

      $.ajax({
        data: $('#FormcreateNewUser').serialize(),
        url: "/mgmaseteruser",
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


$('body').on('click', '.editUser', function () {
    var id_user = $(this).data('id');
    $.get("/mgmaseteruser" +'/' + id_user +'/edit', function (data) {
        $('#btnSave-createNewUser').val("บันทึก");
        $('#FormcreateNewUser').trigger("reset");
        $('#modelHeadingcreateNewUser').html("แก้ไขผู้ใช้");
        $('#modal-createNewUser').modal('show');
        document.getElementById("password").disabled = true;
        document.getElementById("btnSave-createNewUser").disabled = false;
        $('#user_id').val(data.id);
        $('#info_id').val(data.id_info);
        $('#user_group').val(data.user_group);
        $('#username').val(data.username);
        $('#school').val(data.school);
        $('#titel').val(data.titel);
        $('#name').val(data.name);
        $('#lastname').val(data.lastname);
        $('#phone').val(data.phone);
        $('#section').val(data.section);
        $('#room').val(data.room);
        $('#id_student').val(data.id_student);

      console.log(data);
        if(data.user_group == "1"     ){
            document.getElementById("section").disabled = true;
            document.getElementById("room").disabled = true;
            document.getElementById("id_student").disabled = true;

        }else{
            document.getElementById("section").disabled = false;
            document.getElementById("room").disabled = false;
            document.getElementById("id_student").disabled = false;

          }
        if(data.user_group == "2"   ){
            document.getElementById("section").disabled = false;
            document.getElementById("room").disabled = false;
            document.getElementById("id_student").disabled = false;

        }

        if(data.user_group == "3"   ){
            document.getElementById("section").disabled = true;
            document.getElementById("room").disabled = true;

        }

        if(data.user_group == "4"   ){
            document.getElementById("id_student").disabled = true;

        }


    })
  });

$('body').on('click', '.viewUser', function () {
    var id_user = $(this).data('id');
    $.get("/mgmaseteruser" +'/' + id_user , function (data) {
        $('#btnSave-createNewUser').val("บันทึก");
        document.getElementById("btnSave-createNewUser").disabled = true;
        $('#FormcreateNewUser').trigger("reset");
        $('#modelHeadingcreateNewUser').html("แก้ไขผู้ใช้");
        $('#modal-createNewUser').modal('show');
        document.getElementById("password").disabled = true;
        $('#user_id').val(data.id);
        $('#info_id').val(data.id_info);
        $('#user_group').val(data.user_group);
        $('#username').val(data.username);
        $('#school').val(data.school);
        $('#titel').val(data.titel);
        $('#name').val(data.name);
        $('#lastname').val(data.lastname);
        $('#phone').val(data.phone);
        $('#section').val(data.section);
        $('#room').val(data.room);
        $('#id_student').val(data.id_student);

        console.log(data);
        if(data.user_group == "1"     ){
            document.getElementById("section").disabled = true;
            document.getElementById("room").disabled = true;
            document.getElementById("id_student").disabled = true;

        }else{
            document.getElementById("section").disabled = false;
            document.getElementById("room").disabled = false;
            document.getElementById("id_student").disabled = false;

          }
        if(data.user_group == "2"   ){
            document.getElementById("section").disabled = false;
            document.getElementById("room").disabled = false;
            document.getElementById("id_student").disabled = false;

        }

        if(data.user_group == "3"   ){
            document.getElementById("section").disabled = true;
            document.getElementById("room").disabled = true;

        }

        if(data.user_group == "4"   ){
            document.getElementById("id_student").disabled = true;

        }

    })
  });


$('body').on('click', '.deleteUser', function () {
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
        url: "mgmaseteruserde"+'/'+questionsec_id+'/'+id,
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
function yesnoCheck(that) {

  if (that.value == "1") {
    document.getElementById("section").disabled = true;
    document.getElementById("room").disabled = true;
    document.getElementById("id_student").disabled = true;
    $('#school').val("1");


  }else{
    document.getElementById("section").disabled = false;
    document.getElementById("room").disabled = false;
    document.getElementById("id_student").disabled = false;
    $('#school').val("");
  }

  if (that.value == "2") {
    document.getElementById("section").disabled = true;
    document.getElementById("room").disabled = true;
    document.getElementById("id_student").disabled = true;

  }


  if (that.value == "3") {
    document.getElementById("section").disabled = true;
    document.getElementById("room").disabled = true;
  }


  if (that.value == "4") {
    document.getElementById("id_student").disabled = true;


  }

}


$('#school').change(function () { //we watch and execute the next lines when any value from the dropdown#1 is selected
    var id = $(this).val(); //we get the selected value on dropdown#1 and store it on id variable
    //var url = $('#application_url').val(); //we get the url from our hidden element that we used in first line of our view file, and store it on url variable
        //here comes the ajax function part
        $.ajax({
        url: "/school/" + id, //we use the same url we used in our route file and we are adding the id variable which have the selected value in dropdown#1
        dataType: "json", //we specify that we are going to use json type of data. That's where we sent our query result (from our controller)
        success: function (data) { //*on my understanding using json datatype means that the variable "data" gets the value and that's why we use it to tell what to do since here.*
            //and this final part is where we use the dropdown#1 value and we set the values for the dropdown#2 just adding the variables that we got from our query (in controllert) through "data" variable.
            $('#id_student').empty();
            $.each(data, function (key, value) {
                $('#id_student').append('<option value="' + value.student_code_id + '">' + value.student_code_id + '</option>');

            });


        }
    });
});


$('.select2').select2()
