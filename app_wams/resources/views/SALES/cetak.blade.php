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
        <p align="center"><b>Laporan Data Sales Opty</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width:95%;">
        <tr>
            <th>No</th>
            <th>Nama Client</th>
            <th>Nama Project</th>
            <th>Produk / Solusi</th>
            <th colspan="4" style="text-align:center">Timeline</th>
            <th>Date</th>
            <th>Status</th>
            <th>Note</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Q1</th>
                <th>Q2</th>
                <th>Q3</th>
                <th>Q4</th>
                <th></th>
               
            </tr>
            @foreach ($sales as $opty)
            <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $opty->NamaClient }}</td>
                    <td>{{ $opty->NamaProject }}</td>
                    <td>{{ $opty->elearning_id }}</td>
                    <td>
                        @if ($opty->Timeline == 'Q1')
                            {{ number_format($opty->Angka,0,',','.') }}
                        @endif
                    </td>
                    <td>
                        @if ($opty->Timeline == 'Q2')
                            {{ number_format($opty->Angka,0,',','.') }}
                        @endif
                    </td>
                    <td>
                        @if ($opty->Timeline == 'Q3')
                            {{ number_format($opty->Angka,0,',','.') }}
                        @endif
                    </td>
                    <td>
                        @if ($opty->Timeline == 'Q4')
                            {{ number_format($opty->Angka,0,',','.') }}
                        @endif
                    </td>
                    <td>{{ $opty->Date }}</td>
                    <td>{{ $opty->Status }}</td>
                    <td>{{ $opty->Note }}</td>
            </tr>
            @endforeach
    </table>
    </div>
    
    <script type="text/javascript">
        window.print();
        </script>
</body>
</html>