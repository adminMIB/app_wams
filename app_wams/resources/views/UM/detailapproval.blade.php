@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>Detail WO</h1>
        </div>

        <div class="card-body">
          <form action="{{route('updateStatusApproval', $detailId->id)}}" method="POST" enctype="multipart/form-data"> 
                  @method('put')
                  {{csrf_field()}}
                  {{-- no_so --}}
                <div class="form-group">
                  <label>No So</label>
                  <input type="text" name="no_so" class="form-control" value="{{$detailId->no_so}}" readonly>
                </div>
                  {{-- kode project --}}
                <div class="form-group">
                  <label>Kode Project</label>
                  <input type="text" name="kode_project" class="form-control" value="B{{$detailId->kode_project}}" readonly>
                </div>
                {{-- nama institusi --}}
                <div class="form-group">
                  <label>Nama Insitusi</label>
                  <input type="text" name="institusi" class="form-control" value="{{$detailId->institusi}}" readonly>
                </div>
                {{-- nama project--}}
                <div class="form-group">
                  <label>Nama project</label>
                  <input type="text" name="project" class="form-control" value="{{$detailId->project}}" readonly>
                </div>
                {{-- nama AM--}}
                <div class="form-group">
                  <label>Nama AM</label>
                  <input type="text" name="name_user" class="form-control" value="{{$detailId->name_user}}" readonly>
                </div>
                {{-- HPS--}}
                <div class="form-group">
                  <label>HPS</label>
                  <input type="text" name="hps" class="form-control" value="{{$detailId->hps}}" readonly>
                </div>
                {{-- status approve--}}
                {{-- <div class="form-group">
                  <label>Status Approve</label>
                  <input type="text" name="status_approve" class="form-control" value="{{$detailId->status}}">
                </div> --}}
                <div class="form-group row">
                  <div class="col-sm-9">
                    <p class="text-danger">Status : {{$detailId->status}}</p>
                    <select class="form-control select2" style="width: 100%;" name="status" id="inputEmail5" autofocus>
                      <option></option>
                      <option>Approve</option>
                      <option>Reject</option>
                    </select>
                  </div>
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
              </div>
      </div>
    </section>
@endsection