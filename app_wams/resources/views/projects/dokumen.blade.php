@extends('layouts.main')
@section('content')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
<div class="section">
  {{-- <nav class="navbar navbar-expand-lg" style="background-color: white; border-radius:15px" >
    <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link  "  href="{{route('detail_project',$dk->id)}}">LTO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('timeline',$bs->id)}}">Timeline</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('bast',$bs->id)}}">Bast</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="">Dokumen</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{route('detail_report',$bs->id)}}">Report</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('task',$bs->id)}}">Task</a>
      </li>
        </ul>
    </div>
    </div>
</nav> --}}
<div class="row">
  <div class="col-md-12">
      <div class="card">
          <div class="card-body">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                      <a class="nav-link "  href="{{route('detail_project',$bs->id)}}" role="tab"
                        >LTO</a>
                  </li>
                  <li class="nav-item" role="presentation">
                      <a class="nav-link"   href="{{route('timeline',$bs->id)}}" role="tab"
                        >Timeline</a>
                  </li>
                  <li class="nav-item " role="presentation">
                      <a class="nav-link active" href="{{route('bast',$bs->id)}}" role="tab"
                        >Bast</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link"  href="" role="tab"
                        >Dokumen</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" href="{{route('detail_report',$bs->id)}}" role="tab"
                      >Report</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link"  href="{{route('task',$bs->id)}}" role="tab"
                      >Task</a>
                </li>
              </ul>
          </div>
      </div>
  </div>
</div>
  <div class="card">
    <div class="card-header">
        <button type="button" class="btn ml-2 btn-primary btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable{{$bs->id}}">Add Bast</button>
    </div>
    <div class="card-body">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Kode Project</th>
                    <th>Nama Client</th>
                    <th>Nama Project</th>
                    <th>Dokumen</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div id="exampleModalScrollable{{$dk->id}}" class="modal fade modal-xl" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Dokumen Bast</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('simpan-data')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                <input type="hidden" name="so_id" value="{{$dk->id}}">
                <input type="hidden" name="hps" value="{{$dk->estimated_amount}}">
                <input type="hidden" name="nama_sales" id="" value="{{$dk->amsales}}">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No LTO</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_sales" id="inputEmail3" value="{{$dk->no_so}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal LTO</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="tgl_sales" id="inputEmail3" value="{{$dk->tgl_so}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Project</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="kode_project" id="inputEmail3" value="{{$dk->kode_project}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Client</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_institusi" id="inputEmail3" value="{{$dk->institusi}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Project</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_project" id="inputEmail3" value="{{$dk->project}}" readonly  >
                    </div>
                </div>

                <div class="row">
                    <div class="column col-4">
                        <div class="form-group">
                        <label for="jenis_dokumen" >Status</label>
                        <select name="" id="" class="form-control">
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                        </div>
                    </div>
                    <div class="column col-4">
                        <div class="form-group">
                        <label for="" >Upload Dokumen</label>
                        <input type="file" class="form-control" id="" name="upload_dokumen" multiple="multiple" >
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn text-white" style="background-color: #5252FF">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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
  </div>
  </div>
</div>

@endsection

