
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
                        <td>{{$tm->nominal_reimbursement}}</td>
                        <td>
                            <a class="btn btn-primary" onclick="EditTMReim({{$tm->id}})">Edit</a>
                        </td>
                    </tr>
                    <?php
                            $nominal2 +=$tm->nominal_reimbursement;
                        }
                    ?>
                </tbody>
            </table>

            <p>Total Advance :Rp. {{number_format($nominal2)}} </p>
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
        $.get("{{url('Transaction-Maker/Reimbursement/edit')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Product')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection