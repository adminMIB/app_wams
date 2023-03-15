
@extends('layouts.main')
@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5>Detail DCL - {{ $tmdcl->nama_disti }}</h5>
            <table class="table table-borderless">
                <tr>
                    <td width="40%">Nama Disti</td>
                    <td>:</td>
                    <td>{{ $tmdcl->nama_disti }}</td>
                </tr>
                <tr>
                    <td>PIC Disti</td>
                    <td>:</td>
                    <td>{{ $tmdcl->pic_disti }}</td>
                </tr>
                <tr>
                    <td>PIC Jabatan PIC</td>
                    <td>:</td>
                    <td>{{ $tmdcl->jabatan_pic }}</td>
                </tr>
                <tr>
                    <td>Email PIC</td>
                    <td>:</td>
                    <td>{{ $tmdcl->email_pic }}</td>
                </tr>
                <tr>
                    <td>Email PIC</td>
                    <td>:</td>
                    <td>{{ $tmdcl->email_pic }}</td>
                </tr>
                <tr>
                    <td>No HP</td>
                    <td>:</td>
                    <td>{{ $tmdcl->nomor_hp }}</td>
                </tr>
                <tr>
                    <td>Pengajuan CL</td>
                    <td>:</td>
                    <td>
                        Rp. {{ number_format($tmdcl->pengajuan_cl) }}
                    </td>
                </tr>
                <tr>
                    <td>Jumlah CL</td>
                    <td>:</td>
                    <td>
                        Rp. {{ number_format($tmdcl->jumlah_cl) }}
                        <input type="hidden" id="jml_cl" value="{{$tmdcl->jumlah_cl}}">
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <div class="card">
        <div class="card-body">

            <a class="btn btn-primary btn-sm mb-4" onclick="CreateTM({{$tmdcl->id}})">Transaction Maker</a>

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
                        <td>Rp. {{ number_format($tm->nominal_po) }}</td>
                    </tr>
                    <?php
                            $nominal2 +=$tm->nominal_po;
                        }
                    ?>
                </tbody>
            </table>

            <p> Total Advance :Rp. {{number_format($nominal2)}} </p>
            <p> Sisa Saldo = Rp. {{ number_format($tmdcl->jumlah_cl - $nominal2) }}</p>
            <input type="hidden" id="sisa_saldo" value="{{ $tmdcl->jumlah_cl - $nominal2 }}">
            {{-- <p>Sisa :Rp. {{number_format($total_final2)}}</p> --}}

            <a href="{{ route('picdistiindex') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</section>
<div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="page" class="p-2">

            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>

<script>
    function CreateTM(id){
        $.get("{{url('Transaction-Maker/DCL')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Product')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>

@endsection