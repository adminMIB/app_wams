
@extends('layouts.main')
@section("css")
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<section class="section">
    {{-- <div class="section-header">
        <h1>Detail Timeline</h1>
    </div> --}}
    <div class="card">
        <div class="card-header">
            {{-- <a href="" class="btn btn-secondary btn-sm mb-3">Back</a> --}}
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <td>BMT Awal</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($cpt->bmt) }}</td>
                </tr>
                <tr>
                    <td>Services</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($cpt->services) }}</td>
                </tr>
                <tr>
                    <td>Sub Total</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($cpt->sub_total) }}</td>
                </tr>
                <tr>
                    <td>Bunga Admin</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($cpt->bunga_admin) }}</td>
                </tr>
                <tr>
                    <td>Biaya Admin</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($cpt->biaya_admin) }}</td>
                </tr>
                <tr>
                    <td>Biaya Pengurangan</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($cpt->biaya_pengurangan) }}</td>
                </tr>
                <tr>
                    <td>Total Final</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($cpt->total_final) }}</td>
                </tr>
                <tr>
                    <td>File</td>
                    <td>:</td>
                    <td><a href="/file_hitungan/{{ $cpt->file }}" download>Download</a></td>
                </tr>
            </table>

            <hr>

            <div class="pt-3 pb-3">
                <a href="javascript:void(0)" class="btn btn-primary btn-sm maker" onclick="CreateTM({{$cpt->id}})">
                    Transaction Maker <i class="fa fa-plus"></i>
                </a>
            </div>
            <table class="table table-hover table-responsive table-bordered ">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis Transaksi</th>
                        <th>Nominal</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    $nominal2 = 0;
                    $total_final2=0;
                    foreach($cpt->detail as $tm){
                            ?>
                        {{-- <a href="{{route('penawaran.edit',$i->id)}}">     --}}
                            <tr  style="font-size: 13px;">
                                <td>{{$tm->tanggal}}</td>
                                <td>{{$tm->jenis_transaksi}} - {{$tm->nama_tujuan}} ({{$tm->keterangan}})</td>
                                <td>Rp. {{ number_format($tm->nominal) }}</td>
                                <td>
                                    <ul>
                                        <li>
                                            File Request : <br>
                                            <a href="/file_request/{{$tm->upload_request}}" download>Download</a>
                                        </li>
                                        <li>
                                            File Release : <br>
                                            <a href="/file_realese/{{$tm->upload_release}}" download>
                                                Download
                                            </a> 
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <a class="btn btn-warning" onclick="moveTM({{$tm->id}})">Pindah Data</a>
                                    <a class="btn btn-primary" onclick="editTM({{$tm->id}})">Edit Data</a>
                                </td>
                            </tr>
                        {{-- </a>     --}}
                            <?php

                            $nominal2 +=$tm->nominal;
                            $total_final2 = $cpt->total_final - $nominal2;
                            // $diskon = $i->diskon;
                        }
                    ?>
                </tbody>
            </table>

            <p>Total Advance : Rp. {{number_format($nominal2)}} </p>
            <p>Sisa : Rp. {{number_format($total_final2)}}</p>
            
            {{-- <div class="row">
                @foreach($time->detail as $tm)
                @if ($tm->nama_technical)
                <div class="col-8 col-md-4 ">
                    <div class="card shadow p-3 mb-5 rounded border">
                        <div class="">
                            <span class="ml-4 ">{{$time->nama_project}}
                            </span>
                        </div>
        
                        <div class="ml-4">
                            <span><i class="bi bi-building"></i> {{$time->nama_institusi}}</span> 
                        </div>
                        <label class="ml-4 mt-4" style="font-size: 12px">Timeline</label>
                        <hr class="mt-0 ml-4">
                        <div class="card-body ">
                            <span class=""><i class="bi bi-briefcase"></i> {{$tm->jenis_pekerjaan}}</span>
                            <br>
                            <span class="" style="font-size: 10px" ><div class="badge bg-success"> {{$tm->start_date}}</div></span> 
                            <span class="" style="font-size: 10px"><div class="badge bg-danger"> {{$tm->finish_date}} </div></span>
                        </div>
                        <label class="ml-4 mt-4" style="font-size: 12px">Technical</label>
                        <hr class="mt-0 ml-4">
                        <div class="ml-4">
                            <i class="bi bi-person"></i> {{$tm->nama_technical}}
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div> --}}
            <a href="{{ route('indexCPT') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
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
</section>

@endsection

@section('js')
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    function moveTM(id){
        $.get("{{url('editTM')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Pindah data')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }

    function editTM(id){
        $.get("{{url('editTransactionMaker')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit data')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }

    function CreateTM(id){
        $.get("{{url('createTM')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Transaction Maker')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection