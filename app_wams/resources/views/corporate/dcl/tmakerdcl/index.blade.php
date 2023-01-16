
@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Report Transaction Maker</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover table-responsive table-bordered ">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama PIC</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php
                        $nominal2 = 0;
                        foreach($tmdcl->detailtmdcl as $tm){
                                ?>
                    <tr>
                        <td>{{$tm->tanggal_po}}</td>
                        <td>{{$tm->nama_pic}}</td>
                        <td>{{$tm->nominal_po}}</td>
                    </tr>
                    <?php
                            $nominal2 +=$tm->nominal_po;
                        }
                    ?>
                </tbody>
            </table>

            <p>Total Advance :Rp. {{number_format($nominal2)}} </p>
            {{-- <p>Sisa :Rp. {{number_format($total_final2)}}</p> --}}

            <a href="{{ route('picdistiindex') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</section>

@endsection

@section('js')
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
@endsection