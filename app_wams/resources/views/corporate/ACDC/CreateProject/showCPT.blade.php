
@extends('layouts.main')
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
            <table class="table table-hover table-responsive table-bordered ">
                <thead>
                    <tr>
                        <th>Kode Project</th>
                        <th> Client</th>
                        <th> Project</th>
                        <th>Jenis Pekerjaan</th>
                        <th>Start Date</th>
                        <th>Finish Date</th>
                        <th>Technikal</th>
                    </tr>
                </thead>
                {{-- @foreach($cpt as $tm) --}}
                    <tbody>
                    <tr>
                        <td>{{$cpt->project_name}}</td>
                        <td>{{$cpt->nama_principal}}</td>
                        <td>{{$cpt->nama_client}}</td>
                        <td>{{$cpt->total_final}}</td>
                    </tr>
                    <tr>
                        
                    </tr>
                </tbody>
                {{-- @endforeach --}}
            </table>

            <table class="table table-hover table-responsive table-bordered ">
                <thead>
                    <tr>
                        <th>Kode Project</th>
                        <th>Client</th>
                        <th>Project</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    $nominal2 = 0;
                    $total_final2=0;
                    foreach($cptac->detail as $tm){
                            ?>
                        {{-- <a href="{{route('penawaran.edit',$i->id)}}">     --}}
                            <tr  style="font-size: 13px;">
                                <td>{{$tm->nominal}}</td>
                                <td>
                                    <a style="float: left;" onclick="editTM({{$tm->id}})">Edit</a>
                                </td>
                            </tr>
                        {{-- </a>     --}}
                            <?php

                            $nominal2 +=$tm->nominal;
                            $total_final2 = $cptac->total_final - $nominal2;
                            // $diskon = $i->diskon;
                        }
                    ?>
                </tbody>
            </table>

            <p>Total Advance :Rp. {{number_format($nominal2)}} </p>
            <p>Sisa :Rp. {{number_format($total_final2)}}</p>
            
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
            <a href="{{ route('/indexCPT') }}" class="btn btn-secondary">Back</a>
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
<script>
    function editTM(id){
        $.get("{{url('editTM')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Product')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection