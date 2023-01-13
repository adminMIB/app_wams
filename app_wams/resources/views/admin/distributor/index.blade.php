@extends('layouts.main')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1 class="text-center mb-5">List Distributor</h1>
    </div>
    <div class="card">
      <div class="card-body ">
        <div class="d-flex justify-content-between">
          <div class="text-left">
            {{-- <a href="" data-bs-toggle="modal"><button type="submit" class="btn btn-md text-white" style="margin-bottom:1%; background-color: #5252FF">Add Distributor</button></a> --}}
            <button type="button"  style="margin-bottom:1%; background-color: #5252FF" class="btn ml-2 btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Add Distributor</button>
          </div>
          <div class="text-right mb-3">
            <button class="btn ml-2 btn-md text-white" style="background-color: #32735F" onclick="tableToExcel('disti')">Export Excel</button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <thead>
              <tr class="text-center">
                <th>NO</th>
                <th>Distributor</th>
                <th>Email</th>
                <th>No Tlp</th>
                <th>Address</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($disti as $key => $item)
              <tr>
                <td>{{$key + $disti->firstItem() }}</td>
                <td>{{ $item->distributor }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->no_telp }}</td>
                <td>{{ $item->alamat_disti }}</td>
                <td>
                  <div class="btn-group dropstart mb-1 text-center mx-auto" style="cursor: pointer;">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </div>
                    <div class="dropdown-menu text-center">
                      <a target="" href="{{url('/distiShow', $item->id)}}" class="btn btn-sm text-white btn-info" style="background-color: #0EC8F8">
                        Detail
                      </a>
                      <a type="button"  href="{{ url('/editDisti', $item->id) }}" style="margin-bottom:1%; background-color: #5252FF" class="btn btn-sm ml-2 btn-warning" >Edit</a>
                      {{-- <a href="" class="btn btn-sm text-white btn-warning">Edit</a> --}}
                      <a onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" href="{{url('/deleteDiste', $item->id)}}" class="btn btn-sm btn-danger">
                          Delete
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="d-flex  justify-content-end">
          {{ $disti->links() }}
        </div>
      </div> 
    </div>
  </section>


  {{-- table hidden --}}
  <table id="disti" class="table table-bordered table-hover table-striped d-none">
    <thead>
      <tr class="text-center">
        <th>NO</th>
        <th>Distributor</th>
        <th>Email</th>
        <th>No Tlp</th>
        <th>Alamat</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($disti as $key => $item)
      <tr class="text-center">
        <td>{{ $key + $disti->firstItem() }}</td>
        <td>{{ $item->distributor }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->no_telp }}</td>
        <td>{{ $item->alamat_disti }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>


  {{-- !modal add data --}}
  <div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" style="text-align: center" id="exampleModalLabel">Add Data Distributor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('/storeDiste')}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="modal-body">
            <label for="dari">Distributor</label>
            <input type="text" class="form-control" id="dari" name="distributor">
            <label for="sampai" class="mt-2">Email</label>
            <input type="text" class="form-control" id="sampai" name="email">
            <label for="sampai" class="mt-2">No Telephone</label>
            <input type="text" class="form-control" id="sampai" name="noTelephone">
            <label for="sampai" class="mt-2">Address</label>
            <textarea name="alamat" style="height: 100px" class="form-control" id="" cols="10" rows="10"></textarea>
            {{-- <input type="text" class="form-control" id="sampai" name="sampai_tgl"> --}}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
              <button type="submit" class="btn text-white" style="background-color: #5252FF">Kirim</button>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>


  
  <script src="../assets/js/export_exel.js"></script>
@endsection

