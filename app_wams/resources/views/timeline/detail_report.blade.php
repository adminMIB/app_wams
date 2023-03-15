
@extends('layouts.main')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link  "  href="{{route('detail_project',$rpt->id)}}" role="tab"
                              >LTO</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link "   href="{{route('timeline',$rpt->id)}}" role="tab"
                              >Timeline</a>
                        </li>
                        <li class="nav-item " role="presentation">
                            <a class="nav-link " href="{{route('bast',$rpt->id)}}" role="tab"
                              >Bast</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link"  href="" role="tab"
                              >Dokumen</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" href="{{route('detail_report',$rpt->id)}}" role="tab"
                            >Report</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link"  href="{{route('task',$rpt->id)}}" role="tab"
                            >Task</a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-hover table-responsive table-bordered ">
                <thead>
                    <tr>
                        <th>Kode Project</th>
                        <th>Nama Client</th>
                        <th>Nama Project</th>
                        <th>Jenis Pekerjaan</th>
                        <th>Start Date</th>
                        <th>Finish Date</th>
                        <th>Technikal</th>
                        <th>PM</th>
                    </tr>
                </thead>
                @foreach ($rpt->detail as $t)
                    <tbody>
                    <tr>
                        <td>{{$rpt->kode_project}}</td>
                        <td>{{$rpt->nama_institusi}}</td>
                        <td>{{$rpt->nama_project}}</td>
                        <td>{{$t->jenis_pekerjaan}}</td>
                        <td>{{$t->start_date}}</td>
                        <td>{{$t->finish_date}}</td>
                        <td>{{$t->nama_technical}}</td>
                        <td>{{$t->nama_pm}}</td>
                    </tr>
                </tbody>
                @endforeach
                
            </table>
        </div>
    </div>

    {{-- <a href="{{route('report-timeline')}}" class="btn btn-secondary btn-sm" style="border-radius: 3em;float: right; ">Back</a> --}}
</section>
@endsection