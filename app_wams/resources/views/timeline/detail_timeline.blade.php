
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
                        <th>PM</th>
                    </tr>
                </thead>
                @foreach($time->detail as $tm)
                @if ($tm->nama_technical)
                    <tbody>
                    <tr>
                        <td>{{$time->kode_project}}</td>
                        <td>{{$time->nama_institusi}}</td>
                        <td>{{$time->nama_project}}</td>
                        <td>{{$tm->jenis_pekerjaan}}</td>
                        <td>{{$tm->start_date}}</td>
                        <td>{{$tm->finish_date}}</td>
                        <td>{{$tm->nama_technical}}</td>
                        <td>{{$tm->nama_pm}}</td>
                    </tr>
                </tbody>
                @endif
                @endforeach
            </table>
            
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
        </div>
    </div>
</section>
@endsection