
@extends('layouts.main')
@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5>Detail DCL</h5>
            <table class="table table-borderless">
                <tr>
                    <td width="40%">Jenis Kolateral</td>
                    <td>:</td>
                    <td>{{ $dtmcmm->jenis_kolateral }}</td>
                </tr>
                <tr>
                    <td>Jumlah CL</td>
                    <td>:</td>
                    <td>
                        Rp. {{ number_format($dtmcmm->jumlah_cl) }}
                    </td>
                </tr>
                <tr>
                    <td>Ketarangan</td>
                    <td>:</td>
                    <td>
                        {{ $dtmcmm->keterangan }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <div class="card">
        <div class="card-header">
            {{-- <a href="" class="btn btn-secondary btn-sm mb-3">Back</a> --}}
        </div>
        <div class="card-body">
            <a class="btn btn-primary btn sm mb-4" href="#" onclick="CreateTMCMM({{$dtmcmm->id}})">Transaction Maker</a>

            <table class="table table-hover table-responsive table-bordered ">
                <thead>
                    <tr>
                        <th>Tanggal PO</th>
                        <th>Nama Project</th>
                        <th>Nama Klien</th>
                        <th>Nama EU</th>
                        <th>Nominal PO</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    $nominal_po2 = 0;
                    foreach($dtmcmm->tmcmm as $tm){
                            ?>
                        {{-- <a href="{{route('penawaran.edit',$i->id)}}">     --}}
                            <tr  style="font-size: 13px;">
                                <td>{{ date('d-m-Y', strtotime($tm->tgl_po)) }}</td>
                                <td>{{$tm->nama_project}}</td>
                                <td>{{$tm->nama_klien}}</td>
                                <td>{{$tm->nama_eu}}</td>
                                <td>Rp. {{number_format($tm->nominal_po)}}</td>
                            </tr>
                        {{-- </a>     --}}
                            <?php

                            $nominal_po2 +=$tm->nominal_po;
                            // $diskon = $i->diskon;
                        }
                    ?>
                </tbody>
            </table>

            <p>Total Advance : Rp. {{number_format($nominal_po2)}} </p>
            <p>Sisa Saldo : Rp. {{number_format($dtmcmm->jumlah_cl - $nominal_po2)}} </p>
            
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
            <a href="/index-PRK" class="btn btn-secondary">Back</a>
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
    function CreateTMCMM(id){
      $.get("{{url('createTMCMM')}}/"+ id,{},function(data,status){
          $("#exampleModalLabel").html('Create Transaction Maker CMM')
          $("#page").html(data);
          $("#exampleModal").modal('show');
      });
  }
</script>
@endsection