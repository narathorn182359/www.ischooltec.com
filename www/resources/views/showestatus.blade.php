<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
</head>
<style>
    body{
        font-family: 'Kanit', sans-serif;
    }
#container {
    display: flex; /* or inline-flex */
  justify-content: center;
}
#sticky-footer {
  flex-shrink: none;
}

</style>

<body class="bg-secondary">

<div class="container-fluid">
        <div id="container">

        </div>
        <div class="col-md-12 bg-light p-4 rounded mt-5">
                <h1 class="text-center text-light bg-success mb-2 p-2 rounded lead" id="reult">แสดงการเข้า-ออกนักเรียนทั้งหมดโรงเรียน.....</h1>
        <div id="container">

                        <table class="table table-striped" id="myTable" align="center"  cellpadding="10">
                          <thead>
                            <tr>
                                    <td style="width: 300px" align="center"><h3>รูปถ่าย</h3></td>
                                    <td style="width: 300px" align="center"><h3>ชื่อ-นามสกุล</h3></td>
                                    <td style="width: 300px" align="center"><h3>เวลาแสกนใบหน้า</h3></td>
                                    <td style="width: 300px" align="center"><h3>สถานะ</h3></td>
                                    <td style="width: 300px" align="center"><h3>การเข้า-ออก</h3></td>
                            </tr>
                          </thead>
                          <tbody id="myBody"></tbody>
                        </table>

</div>
</div>

        </div>
<script>


    function getDataFromDb()
    {

        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});      $.ajax({
           type:'POST',
           url:'/getdata',
           success:function(data){
						  //$("#myTable tbody tr:not(:first-child)").remove();
						  $("#myBody").empty();
						  $.each(data, function(key, val) {

									var tr = "<tr>";
									tr = tr + "<td align=\"center\"  >" +"<img class=\"img-thumbnail\" src='data:image/JPG;base64,"+val["img"]+"'</img> </td>";
                                    tr = tr + "<td align=\"center\" ><h3>"+ val["name"] + "-"+val["lastname"] + "</h3></td>";
									tr = tr + "<td align=\"center\" ><h3>"+ val["timeattendance"] +"น.<br>"+val["date"] + "</h3></td>   ";

                                    if(val["code_status"] == 2){
                                        tr = tr + "<td align=\"center\" ><span  class=\"badge bg-success\"><h3>"+ val["name_status"] + "</h3></span></td>";


                                     }else{

                                        tr = tr + "<td align=\"center\" ><span  class=\"badge bg-warning\"><h3>"+ val["name_status"] + "</h3></span></td>";

                                           }
                                           if(val["inOrOut"] == 1){
                                            tr = tr + "<td align=\"center\" ><span  class=\"badge bg-info\"><h3>มาโรงเรียน</h3></span></td>";
                                           }else{
                                            tr = tr + "<td align=\"center\" ><span  class=\"badge bg-primary\"><h3>กลับจากโรงเรียน</h3></span></td>";
                                           }

									$('#myTable > tbody:last').append(tr);
			});
           }
        });
    }
    setInterval(getDataFromDb, 1000);   // 1000 = 1 second
    </script>
</body>
</html>
