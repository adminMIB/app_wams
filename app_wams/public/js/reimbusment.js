$(function () {
    'use strict'

    var start = moment().subtract(29, 'days');
    var end = moment();
    var start_date = "",
        end_date = "",
        q = "",
        client = "",
        jenis = ""

    // $('.categories').select2();

    var table = $('#reimbusment').DataTable({
        "pageLength": 25,
        "loading": true,
        "processing": true,
        "serverSide": true,
        "dom": '<"dt-buttons"B><"clear">lrtip',
        "buttons": [
            'excel', 'pdf', 'print'
        ],
        responsive: true,
        ajax: {
            url: "/OpptyProject",
            data: function (d) {
                d.start_date = start_date
                d.end_date = end_date
                d.search = q
                d.client = client
                d.jenis = jenis
            },
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,},
            {data: 'jenis', name: 'jenis', orderable: false},
            {data: 'code', name: 'code', orderable: false},
            {data: 'name', name: 'name', orderable: false},
            {data: 'picBChanel', name: 'picBChanel', orderable: false},
            {data: 'client', name: 'client_name', orderable: false},
            {data: 'created_at', name: 'created_at', orderable: false},
            {data: 'action', name: 'action', orderable: true},
        ],
    });

    function cb(start, end) {
        $('#date-range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    function handleFilterDate(start, end) {
        start_date = start.format("YYYY-MM-DD")
        end_date = end.format("YYYY-MM-DD")

        table.draw()
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

    $(document).on('click', '.delete', function() { 
       var id = $(this).attr("data-id");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            title: "Apakah Anda Yakin ?",
            text: "Data Yang Sudah Dihapus Tidak Bisa Dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Tetap Hapus!"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: `/OpptyProject/${id}`,
                    type: "delete",
                    success: function (data) {
                        Swal.fire(data, '', 'success')
                        table.draw()
                    }
                })
            }
        })
     });

     var timeout = null;

     $('#search').keyup(function() {
         clearTimeout(timeout);
         var val = $(this).val()
         timeout = setTimeout(function() {
            q = val
            table.draw()
         }, 1000);
     });

     $("#client_filter").on("change", function() {
        client = $(this).val()
        table.draw();
     });

     $("#jenis").on("change", function() {
        jenis = $(this).val()
        table.draw();
     })

     $("#reset").click(function() {
        $('#jenis').val(null).trigger('change'),
        $('#client_filter').val(null).trigger('change'),

        client = ""
        jenis = ""
        start_date = ''
        end_date = ''
        $("#search").val("")

        table.draw();
     })
})