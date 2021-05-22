$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });


  $("#Form-viewStundentDetail").submit(function(e) {
    e.preventDefault();
    var id = $(this).data('id');

      $.ajax({
        data: $('#Form-viewStundentDetail').serialize(),
        url: "/mgmaseterstuden/"+id,
        type: "PUT",
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























  $('body').on('click', '.viewStundentDetail', function () {
    var id = $(this).data('id');
    $.get("/mgmaseterstuden" +'/' + id , function (data) {
        $('#btnSave-viewStundentDetail').val("บันทึก");
          document.getElementById("btnSave-viewStundentDetail").disabled = true;
          $('#Form-viewStundentDetail').trigger("reset");
          $('#modelHeading-viewStundentDetail').html("แสดงข้อมูล");
          $('#modal-viewStundentDetail').modal('show');
          $('#student_code_id').val(data[0].student_code_id);
          $('#degree').val(data[0].degree);
          $('#nationality').val(data[0].nationality);
          $('#title').val(data[0].title);
          $('#room').val(data[0].room);
          $('#race').val(data[0].race);
          $('#name').val(data[0].name);
          $('#card_number').val(data[0].card_number);
          $('#tel').val(data[0].tel);
          $('#lastname').val(data[0].lastname);
          $('#birthday').val(data[0].birthday);
          $('#email').val(data[0].email);
          $('#address').val(data[0].address);
          $('#father').val(data[0].father);
          $('#mom').val(data[0].mom);
          $('#name_school').val(data[0].name_school);
          $('#father_tel').val(data[0].father_tel);
          $('#mom_tel').val(data[0].mom_tel);
          $('#classroom').val(data[0].class);
          $('#consult').val(data[0].consult);
    })
  });

  $('body').on('click', '.editStundentDetail', function () {
    var id = $(this).data('id');
    $.get("/mgmaseterstuden" +'/' + id , function (data) {
        $('#btnSave-viewStundentDetail').val("บันทึก");
          document.getElementById("btnSave-viewStundentDetail").disabled = false;
          $('#Form-viewStundentDetail').trigger("reset");
          $('#modelHeading-viewStundentDetail').html("แสดงข้อมูล");
          $('#modal-viewStundentDetail').modal('show');
          $('#student_code_id').val(data[0].student_code_id);
          $('#degree').val(data[0].degree);
          $('#nationality').val(data[0].nationality);
          $('#title').val(data[0].title);
          $('#room').val(data[0].room);
          $('#race').val(data[0].race);
          $('#name').val(data[0].name);
          $('#card_number').val(data[0].card_number);
          $('#tel').val(data[0].tel);
          $('#lastname').val(data[0].lastname);
          $('#birthday').val(data[0].birthday);
          $('#email').val(data[0].email);
          $('#address').val(data[0].address);
          $('#father').val(data[0].father);
          $('#mom').val(data[0].mom);
          $('#name_school').val(data[0].name_school);
          $('#father_tel').val(data[0].father_tel);
          $('#mom_tel').val(data[0].mom_tel);
          $('#classroom').val(data[0].class);
          $('#consult').val(data[0].consult);
    })
  });












});
