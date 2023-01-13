@extends('layouts.main')
@section('content')
    <section class="section">
      <div class="section-header">
        <h4>Detail Weekly Report</h4>
      </div>
      <div class="card" id="mycard-dimiss" style="border-radius: 2em">
          <div class="card-header">
            <div class="card-header-action">
              <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-secondary" href="/report">Back</a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              @foreach($time->detail as $tm)
              @if (Auth::user()->name == $tm->nama_technical)
              <div class="col-8 col-md-4 ">
                <a style="text-decoration: none; cursor: pointer;" class="text-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable{{$tm->id}}">
                  <div class="card shadow p-3 mb-5 bg-body rounded border">
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
                </a>
              </div>
              @endif
              @endforeach
            </div>
          </div>
      </div>
    </section>

      @foreach($time->detail as $tm)
      @foreach ($t as $it)
      @if ($it->listd_id == $tm->id)
      <!-- Modal -->
      <div id="exampleModalScrollable{{$tm->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog">
          <form action="{{route('updateT',$it->id)}}" method="POST">
            {{ csrf_field() }}
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Weekly Report <b class="text-dark">({{$tm->jenis_pekerjaan}})</b></h5>
            </div>
            <div class="modal-body">
              <input type="hidden" value="{{ $it->id }}" class="form-control" name="listd_id">
              <label for="pekerjaan">Pekerjaan</label>
              <input type="text" class="form-control mb-2" id="pekerjaan" name="job_essay" value="{{$it->job_essay}}" readonly>
              <div class="d-flex mb-2">
                <div class="w-100 mr-1">
                  <label for="start">Dari Tanggal</label>
                  <input type="date" class="form-control" id="start" name="start_date" value="{{ $it->start_date }}">
                </div>
                <div class="w-100">
                  <label for="end">Sampai Tanggal</label>
                  <input type="date" class="form-control" id="end" name="end_date" value="{{ $it->end_date }}">
                </div>
              </div>
              <div class="mb-2">
                <label for="status">Status Pekerjaan</label>
                <select class="form-control" id="status" name="status">
                  <option>{{ $it->status }}</option>
                  <option>Done</option>
                  <option>Issue</option>
                  <option>OnProgress</option>
                </select>
              </div>
              <label for="note">Deskripsi</label>
              <textarea name="note" class="form-control" id="note">{{ $it->note }}</textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Update</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
              </button>
            </div>
          </div>
          </form>
        </div>
      </div>
      @endif
      @endforeach
      <!-- Modal -->
      <div id="exampleModalScrollable{{$tm->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog">
          <form action="{{ url('/save-data') }}" method="POST">
            {{ csrf_field() }}
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Create Weekly Report <b class="text-dark">({{$tm->jenis_pekerjaan}})</b></h5>
            </div>
            <div class="modal-body">
              <input type="hidden" value="{{ $tm->id }}" class="form-control" name="listd_id">
              <label for="pekerjaan">Pekerjaan</label>
              <input type="text" class="form-control mb-2" id="pekerjaan" name="job_essay" value="{{$tm->jenis_pekerjaan}}" readonly>
              <div class="d-flex mb-2">
                <div class="w-100 mr-2">
                  <label for="start">Dari Tanggal</label>
                  <input type="date" class="form-control" id="start" name="start_date">
                </div>
                <div class="w-100">
                  <label for="end">Sampai Tanggal</label>
                  <input type="date" class="form-control" id="end" name="end_date">
                </div>
              </div>
              <div class="mb-2">
                <label for="status">Status Pekerjaan</label>
                <select class="form-control" id="status" name="status">
                  <option>Pilih Status....</option>
                  <option>Done</option>
                  <option>Issue</option>
                  <option>OnProgress</option>
                </select>
              </div>
              <label for="note">Deskripsi</label>
              <textarea name="note" class="form-control" id="note"></textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Save</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
              </button>
            </div>
          </div>
          </form>
        </div>
      </div>
      @endforeach
@endsection