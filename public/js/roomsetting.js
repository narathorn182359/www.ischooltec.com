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
                { data: "room_rm" },
                { data: "name_tc" },
                { data: "section_rm" },

                { data: "options" },
            ],
        });
    });


});
