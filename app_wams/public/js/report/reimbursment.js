$(function () {
    'use strict';

    var start = moment().subtract(29, 'days');
    var end = moment();
    var start_date = "",
        end_date = ""

    function cb(start, end) {
        $('#date-range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    
    function handleFilterDate(start, end) {
        start_date = start.format("YYYY-MM-DD")
        end_date = end.format("YYYY-MM-DD")

        cb(start, end)
    }

    $('#date-range').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, handleFilterDate);
    
    cb(start, end);

    $("#export").on("click", function() {
        cb(start, end);
        if (start_date == "") {
            alert("Harap tentukan tanggal");
        } else {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/report-reimbursement",
                dataType: "json",
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    client: $("#client").val(),
                    jenis: $("#jenis").val()
                }
            }).done(function(res) {
                Swal.fire('Berhasil', '', 'success')
                window.open(window.location.origin + res.link, '_blank' );
            })
        }
    })
})