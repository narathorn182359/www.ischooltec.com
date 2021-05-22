<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
        }
    </style>
     <style>
      .page-break {
       page-break-after: always;
      }
      </style>
    <style>
        #customers {
          font-family: "THSarabunNew";
          border-collapse: collapse;
          width: 100%;
        }
        
        #customers td, #customers th {
          border: 1px solid #ddd;
          padding: 8px;
          height: 20px;
        }
        
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #4CAF50;
          color: white;
          height: 20px;
        }
        </style>
</head>
<body>

   <center><h2>รายงานการเข้า-ออกโรงเรียน</h2></center> 
    <table id="customers">
        <tr>
          <th>ชื่อ-สกุล</th>
          <th>เวลา</th>
          <th>สถานะ</th>
          <th>ปีการศึกษา</th>
        </tr>
        @foreach ($time as $item)
        <tr>
        <td>{{$item->code_student }} {{$item->name }} {{$item->lastname }}</td>
            <td>{{$item->timeattendance }}</td>
            <td>{{$item->name_status }}</td>
            <td>{{$item->term }}</td>
          </tr>
         
        @endforeach
       

      </table>
      <div class="page-break"></div>
</body>
</html>