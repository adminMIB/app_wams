@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail LTO</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="/sales_order" class="btn btn-secondary btn-sm" style="border-radius: 3em;"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- @foreach($so as $o)
                @if ($o->amdetail) --}}
                <div class="col-8 col-md-4 ">
                    <div class="card shadow p-3 mb-5 rounded border">
                        <div class="row">
                            <span class="ml-4 ">{{$so->no_so}}
                            </span>
                            <span class="ml-4 "> {{$so->kode_project}}</span> 
                            <label class="ml-4 mt-3" style="font-size: 12px">Tanggal : {{$so->tgl_so}}</label>
                        </div>
                        <h6 class="ml-2 "> <span class="ml-2 "> {{$so->institusi}}</span></h6> 
                        <h6 class="ml-2 "><span class="ml-2 "> {{$so->project}}</span> </h6> 
                        <h6 class="ml-2 "><span class="ml-2 "> {{$so->file_project}}</span> </h6> 
                        <h6 class="ml-2 "><span class="ml-2 "> {{$so->distributor}}</span> </h6> 
                        <h6 class="ml-2 "><span class="ml-2 "> {{$so->principal}}</span></h6> 
                        <h6 class="ml-2 "><span class="ml-2 "> {{$so->pmo}}</span></h6> 
                        <h6 class="ml-2 "><span class="ml-2 "> {{$so->presales}}</span></h6> 
                        <h6 class="ml-2 "><span class="ml-2 "> {{$so->estimated_amount}}</span></h6> 
                        <h6 class="ml-2 "><span class="ml-2 "> {{$so->status_project}}</span></h6> 
                        <h6 class="ml-2 "><span class="ml-2 "> {{$so->status}}</span></h6> 
                    </div>
                </div>
                {{-- @endif
                @endforeach --}}
            </div>
        </div>
    </div>
</section>
@endsection