@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Project Timeline</h1>
    </div>
    <div class="row">
        @foreach($time->detail as $tm)
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card" style="box-shadow: 4px 5px 	#C3FDB8;  ">
                <div class="card-header">
                    <h4 style="color:black ; font-style:italic; ">{{$time->nama_institusi}}
                        /
                        {{$time->nama_project}}
                    </h4>
                </div>
                <div class="card-body">

                    <span class="">{{$tm->jenis_pekerjaan}}</span>
                    <br>
                    <span class="text-muted">{{$tm->start_date}}</span> -

                    <span class="text-muted">{{$tm->finish_date}}</span>
                </div>
                <div class="card-footer">
                    {{$tm->nama_technical}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <a href="{{route('timeline')}}" class="btn btn-danger btn-sm" style="border-radius: 3em;"><i class="fas fa-arrow-left"></i> Back</a>
</section>
@endsection