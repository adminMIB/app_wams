
@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h4>Report Transaction Maker Reimbursement</h4>
    </div>
    <div class="card">
        <div class="card-body">
            <h6 class="text-capitalize">Detail Project - {{ $tmreim->nama_project }}</h6>

            <table class="table table-borderless">
                <tr>
                    <td width="30%">Jenis</td>
                    <td>:</td>
                    <td>{{ $tmreim->jenis }}</td>
                </tr>
                <tr>
                    <td>ID Oppty</td>
                    <td>:</td>
                    <td>{{ $tmreim->ID_opptyproject }}</td>
                </tr>
                <tr>
                    <td>Nama Project</td>
                    <td>:</td>
                    <td>{{ $tmreim->nama_project }}</td>
                </tr>
                <tr>
                    <td>PIC Busssines Chanel</td>
                    <td>:</td>
                    <td>{{ $tmreim->pic_bussiness_channel }}</td>
                </tr>
                <tr>
                    <td>Client</td>
                    <td>:</td>
                    <td>{{ $tmreim->client }}</td>
                </tr>
            </table>

            <hr>

            <h6>Detail Transaction Maker</h6>
            <div class="pb-3 pt-3">
                <button class="btn btn-primary btn-sm" onclick="CreateTMReim({{ $tmreim->id }})">
                    Transaction Maker 
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <table class="table table-hover table-responsive table-bordered ">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama PIC</th>
                        <th>Nominal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php
                        $nominal2 = 0;
                        foreach($tmreim->detailtmreim as $tm){
                                ?>
                    <tr>
                        <td>{{$tm->tanggal_reimbursement}}</td>
                        <td>{{$tm->nama_pic_reimbursement}}</td>
                        <td>Rp. {{ number_format($tm->nominal_reimbursement) }}</td>
                        <td>
                            <a class="btn btn-warning" onclick="moveData({{$tm->id}})">Pindah Data</a>
                            <a class="btn btn-primary" onclick="EditTMReim({{$tm->id}})">Edit</a>
                        </td>
                    </tr>
                    <?php
                            $nominal2 += $tm->nominal_reimbursement;
                        }
                    ?>
                </tbody>
            </table>

            <p>Total Advance : Rp. {{number_format($nominal2)}} </p>
            {{-- <p>Sisa :Rp. {{number_format($total_final2)}}</p> --}}

            <a href="{{ route('opptyprojectindex') }}" class="btn btn-secondary">Back</a>
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
    function EditTMReim(id){
        $.get("{{url('/Transaction-Maker/Reimbursement/viewEditTreimburs/')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Transaction Maker')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }

    function moveData(id){
        $.get("{{url('Transaction-Maker/Reimbursement/edit')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Move Transaction Maker')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }

    function CreateTMReim(id){
        $.get("{{url('createTMReim')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Transaction Maker')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection