$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(document).ready(function () {
        var table2 = $("#table_admin_userteacher").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin_userteacher",
                dataType: "json",
                type: "POST",
                data: { _token: $("#token").val() 
            
            },
            },
            columns: [
                {
                    className: "details-control",
                    orderable: false,
                    data: null,
                    defaultContent: "",
                },
                { data: "username" },
                { data: "name_teacher" },
                {data: 'options', name: 'options', orderable: false, searchable: false},
            ],
        });

        function format2(callback, rowdata) {
            $.ajax({
                url: "/roomteacher/" + rowdata.username,
                type: "GET",
                contentType: "json",
                complete: function (response) {
                    console.log(response);
                    var data = JSON.parse(response.responseText);
                    var list = data;
                    var html = "";
                    $.each(list, function (index, item) {
                        html +=
                            "<tr>" +
                            '<td width="10"> '+ item.name_class + " / "
                        +    item.room_rm+
                                 "</td>" +
                            '<td width="10" > ' +
                          
                            "  </td>" +
                            "</tr>";
                    });

                    //console.log(html);
                    callback(
                        $(
                            '<table class="table table-bordered table-hover"><thead><tr><th width="10">ห้องที่ปรึกษา</th></tr></thead><tbody>' +
                                html +
                                "</tbody></table>"
                        )
                    ).show();
                },
                error: function () {
                    $("#output").html("Bummer: there was an error!");
                },
            });
        }

        $("#table_admin_userteacher tbody").on(
            "click",
            "td.details-control",
            function () {
                var tr = $(this).closest("tr");
                var row = table2.row(tr);

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass("shown");
                } else {
                    format2(row.child, row.data());
                    tr.addClass("shown");
                }
            }
        );
    });




    $(document).ready(function () {
        var table2 = $("#table_admin_studens").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin_userstudents",
                dataType: "json",
                type: "POST",
                data: { _token: $("#token").val() 
            
            },
            },
            columns: [
                {
                    className: "details-control",
                    orderable: false,
                    data: null,
                    defaultContent: "",
                },
                { data: "username" },
                { data: "name_parent" },
                { data: "options" },
            ],
        });

        function format2(callback, rowdata) {
            $.ajax({
                url: "/userstudents/" + rowdata.username,
                type: "GET",
                contentType: "json",
                complete: function (response) {
                    console.log(response);
                    var data = JSON.parse(response.responseText);
                    var list = data;
                    var html = "";
                    $.each(list, function (index, item) {
                        html +=
                        "<tr>" +
                        '<td width="10"> '+ item.name + "  "
                    +    item.lastname+ " "+
                    item.name_class + "/" + item.room +
                             "</td>" +
                         
                        "</tr>";
                    });

                    //console.log(html);
                    callback(
                        $(
                            '<table class="table table-bordered table-hover"><thead><tr><th width="10">ชื่อ  -  สกุล</th></tr></thead><tbody>' +
                                html +
                                "</tbody></table>"
                        )
                    ).show();
                },
                error: function () {
                    $("#output").html("Bummer: there was an error!");
                },
            });
        }

        $("#table_admin_studens tbody").on(
            "click",
            "td.details-control",
            function () {
                var tr = $(this).closest("tr");
                var row = table2.row(tr);

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass("shown");
                } else {
                    format2(row.child, row.data());
                    tr.addClass("shown");
                }
            }
        );
    });

    
});