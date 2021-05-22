$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

  $('body').on('click','.createTerm',function(){
    var id_school = $(this).data('id');
    $('#add-term').trigger("reset");
    $('#modelHeading').html("เพิ่มข่าวใหม่");
    $('#id_school').val(id_school);
    $('#modal-term').modal('show');
  });



  $("#add-term").submit(function(e) {
    e.preventDefault();
      $.ajax({
        data: $('#add-term').serialize(),
        url: "/mgadminschool_term",
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




$('body').on('click','.createNewterm',function(){
    var id_term = $(this).data('id');
    $('#add_term').trigger("reset");
    $('#id_term').val(id_term);
    $('#modal-createNewterm').modal('show');
  });

  $("#add-Newterm").submit(function(e) {
    e.preventDefault();
      $.ajax({
        data: $('#add-Newterm').serialize(),
        url: "/mgadminschool_add-Newterm",
        type: "POST",
        dataType: 'json',
        success: function (data) {
         
                Swal.fire({
                    type: 'success',
                    title: 'สำเร็จ',
                    text: '------------ ',
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