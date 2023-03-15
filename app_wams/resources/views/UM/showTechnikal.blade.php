@extends('layouts.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <h4>Detail Page</h4>
        </div>
        <div class="card" id="mycard-dimiss" style="border-radius: 2em">
            <div class="card-header">
                <div class="card-header-action">
                    <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-primary" href="/reportp">Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($time->detail as $tm)
                        {{-- @if (Auth::user()->name == $tm->nama_technical) --}}
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
                            <label class="ml-4 mt-4" style="font-size: 12px">Weekly Report <b class="text-uppercase">{{$tm->nama_technical}}</b></label>
                            <hr class="mt-0 ml-4">
                            <div class="ml-4">
                            @foreach ($tm->weeklies as $i)
                            <label for="" class="mb-3">status: <b class="text-uppercase">{{ $i->status }}</b></label>
                            <div class="mb-3">
                                <span class=""><i class="bi bi-clock"></i></span>
                                <span class="" style="font-size: 10px" ><div class="badge bg-success"> {{$i->start_date}}</div></span> 
                                <span class="" style="font-size: 10px"><div class="badge bg-danger"> {{$i->end_date}} </div></span>
                            </div>
                            <label for="desk" class="font-weight-bold" style="text-decoration: underline;">Description</label>
                            <div class="text-dark">{{ $i->note }}</div>
                            <hr>
                            @endforeach
                            </div>
                            </div>
                        </div>
                        {{-- @endif --}}
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection