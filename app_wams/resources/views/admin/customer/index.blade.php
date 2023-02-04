@extends('layouts.main')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1 class="text-center mb-5">List Customer</h1>
    </div>
    <div class="card">
      <div class="card-body ">
        <div class="d-flex justify-content-between">
          <div class="text-left mb-2">
            {{-- <a href="" data-bs-toggle="modal"><button type="submit" class="btn btn-md text-white" style="margin-bottom:1%; background-color: #5252FF">Add Distributor</button></a> --}}
            <button type="button"  style="margin-bottom:1%; background-color: #5252FF; border: none" class="btn ml-2 btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Add Customer</button>
          </div>
          {{-- <div class="text-right mb-3">
            <button class="btn ml-2 btn-md text-white" style="background-color: #32735F" onclick="tableToExcel('disti')">Export Excel</button>
          </div> --}}
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <thead>
              <tr class="text-center" style="font-size: 12px">
                <th>NO</th>
                <th>Customer Name</th>
                <th>PIC Name</th>
                <th>Position</th>
                <th>No Tlp</th>
                <th>Email</th>
                <th>Influencer Name</th>
                <th>Influencer Position</th>
                <th>Telp Influencer</th>
                <th>Influencer Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $key => $item)
              <tr style="font-size: 12px">
                <td>{{$key + $data->firstItem() }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->pic_name }}</td>
                <td>{{ $item->position }}</td>
                <td>{{ $item->no_telp }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->influencer_name}}</td>
                <td>{{ $item->influencer_position}}</td>
                <td>{{ $item->telp_influencer}}</td>
                <td>{{ $item->influencer_email}}</td>
                <td>
                  <div class="btn-group dropstart mb-1 text-center mx-auto" style="cursor: pointer;">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </div>
                    <div class="dropdown-menu text-center">
                      <a target="" href="{{url('/customer/show', $item->id)}}" class="btn btn-sm text-white btn-info" style="background-color: #0EC8F8">
                        Detail
                      </a>
                      <a type="button"  href="{{ url('/customer/edit', $item->id) }}" style="margin-bottom:1%; background-color: #5252FF" class="btn btn-sm ml-2 btn-warning" >Edit</a>
                      {{-- <a href="" class="btn btn-sm text-white btn-warning">Edit</a> --}}
                      <a onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" href="{{url('/customer/delete', $item->id)}}" class="btn btn-sm btn-danger">
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
          {{ $data->links() }}
        </div>
      </div> 
    </div>
  </section>

  {{-- !modal add data --}}
  <div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" style="text-align: center" id="exampleModalLabel">Add Data Customer</h5>
        </div>
        <form action="{{route('/customer/store')}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="modal-body">
            <input type="text" class="form-control d-none" id="" name="idCustomer" value="{{ $ResultsnoCustomer }}">
            <label for="dari">Customer Name</label>
            <input type="text" class="form-control" id="dari" name="namaCustomer">
            <label for="" class="mt-2">PIC Name</label>
            <input type="text" name="pic_name" class="form-control">
            <label for="" class="mt-2">Position</label>
            <input type="text" class="form-control" name="position">
            <label for="sampai" class="mt-2">Email</label>
            <input type="email" class="form-control" id="sampai" name="email">
            <label for="sampai" class="mt-2">No Telephone</label>
            <input type="text" class="form-control" id="sampai" name="noTelephone">
            <label for="sampai" class="mt-2">Address</label>
            <textarea name="alamat" style="height: 100px" class="form-control" id="" cols="10" rows="10"></textarea>
            <label for="" class="mt-2">Name Influencer</label>
            <input type="text" class="form-control" name="influencer_name">
            <label for="" class="mt-2" >Position Influencer</label>
            <input type="text" class="form-control" name="influencer_position">
            <label for="" class="mt-2">Telp/HP Influencer</label>
            <input type="text" name="telp_influencer" class="form-control">
            <label for="" class="mt-2">Email Influencer</label>
            <input type="email" class="form-control" name="influencer_email">
            {{-- <input type="text" class="form-control" id="sampai" name="sampai_tgl"> --}}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
              <button type="submit" class="btn text-white" style="background-color: #5252FF">Submit</button>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
 


  
  <script src="../assets/js/export_exel.js"></script>
@endsection

