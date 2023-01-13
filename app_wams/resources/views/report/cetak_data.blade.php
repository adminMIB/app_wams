<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
        </style>
    <title>CETAK DATA</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>Laporan Data Technikal</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width:95%;">
        <tr>
            <th>No</th>
            <th>Nama Client</th>
            <th>Nama Project</th>
            <th>Uraian Pekerjaan</th>
            <th>Start Date</th>
            <th>Finish Date</th>
            <th>Status</th>
            <th>Note</th>
            </tr>
            @foreach ($weekly_reports as $wk)
            <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $wk->name_client }}</td>
                    <td>{{ $wk->name_project }}</td>
                    <td>{{ $wk->job_essay }}</td>
                    <td>{{ $wk->start_date }}</td>
                    <td>{{ $wk->end_date }}</td>
                    <td>{{ $wk->status }}</td>
                    <td>{{ $wk->note }}</td>
            </tr>
            @endforeach
    </table>
    </div>
    
    <script type="text/javascript">
        window.print();
        </script>
</body>
</html>