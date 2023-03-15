@extends('layouts.main')

@section('title', 'All Projects')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">
            <div class="alert">
            <h2 class="text-capitalize">All Projects</h2>
        </div>
        </div>
        
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered ">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>Project Code</th>
                        <th>Client Name</th>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $id)
                    @if (Auth::user()->name == $id->pmo)
                    @if ($id->status == "Approve")
                    <tr align="center" style="font-size:13px">
                        <td><a href="{{route('detail_project',$id->id)}}">{{ $id->kode_project }}</a></td>
                        <td>{{$id->institusi}}</td>
                        <td>{{$id->project}}</td>
                        @if (!$id->start_date)
                            <td></td>
                        @elseif($id->start_date)
                        <td>{{ date('d-m-Y', strtotime($id->start_date)) }}</td>
                        @endif
                        @if (!$id->end_date)
                        <td></td>
                        @elseif($id->end_date)
                        <td>{{ date('d-m-Y', strtotime($id->end_date)) }}</td>
                        @endif
                        <td>
                            @if ($id->st_project == 'Open')
                                <div class="badge bg-warning">Open</div>
                                @elseif ($id->st_project== 'Completed')
                                <div class="badge bg-success">Completed</div>
                                @elseif ($id->st_project== 'Hold')
                                <div class="badge bg-danger">Hold</div>
                                @endif 
                        </td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#editproject{{$id->id}}"><button type="submit" class="btn btn-primary btn-sm" >Edit</button></a>
                        </td>
                    </tr>
                    @endif
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>


    @foreach ($data as $id)
    <div id="editproject{{$id->id}}" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('update.project',$id->id)}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
            <div class="modal-body">
                {{-- <input type="hidden" name="so_id" value="{{$id->id}}" readonly> --}}
                {{-- <input type="hidden" name="hps" value="{{$id->estimated_amount}}" readonly>
                <input type="hidden" name="amsales" id="" value="{{$id->amsales}}" readonly> --}}
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm text-black">No LTO</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="no_so" id="inputEmail3" value="{{$id->no_so}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm text-black">LTO Date</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="tgl_so" id="inputEmail3" value="{{ date('d-m-Y', strtotime($id->tgl_so)) }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="text-sm text-black col-sm-2 col-form-label">Project Code</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="kode_project" id="inputEmail3" value="{{$id->kode_project}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm text-black">Client Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="institusi" id="inputEmail3" value="{{$id->institusi}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm text-black">Project Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="project" id="inputEmail3" value="{{$id->project}}" readonly  >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm text-black">Start Date</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control text-sm " name="start_date" id="inputEmail3" value="{{$id->start_date}}" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm text-black">End Date</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control text-sm " name="end_date" id="inputEmail3" value="{{$id->end_date}}" >
                    </div>
                </div>

                <div class="row">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-info" >Submit</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
            </div>
            </form>
          </div>
        </div>
    </div>
    @endforeach

</section>
@endsection