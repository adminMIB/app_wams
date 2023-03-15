@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Report Timeline</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="{{url('umViewPm')}}" class="btn btn-secondary btn-md" style="border-radius: 3em;"><i class="bi bi-arrow-left"></i> Back</a>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($rpt->detail as $tm)
                <div class="col-8 col-md-4 ">
                    <div class="card shadow p-3 mb-5 bg-body rounded border">
                        <div class="">
                            <span class="ml-4 ">{{$rpt->nama_project}}
                            </span>
                        </div>
        
                        <div class="ml-4">
                            <span><i class="bi bi-building"></i> {{$rpt->nama_institusi}}</span> 
                        </div>
                        <label class="ml-4 mt-4" style="font-size: 12px">Timeline</label>
                        <hr class="mt-0 ml-4">
                        <div class="card-body ">
                            <span class=""><i class="bi bi-briefcase"></i> {{$tm->jenis_pekerjaan}}</span>
                            <br>
                            <span class="" style="font-size: 12px" ><i class="bi bi-play"></i> {{$tm->start_date}}</span> /
                            <span class="" style="font-size: 12px"> {{$tm->finish_date}}</span>
                        </div>
                        <label class="ml-4 mt-4" style="font-size: 12px">Technical</label>
                        <hr class="mt-0 ml-4">
                        <div class="ml-4">
                            <i class="bi bi-person"></i> {{$tm->nama_technical}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection