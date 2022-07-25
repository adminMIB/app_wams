@extends('layouts.main')
@section('content')
    <section class="section">
        <div class="card">
          <div class="card-header">
            <h1>Sales Order</h1>
          </div>
          <div class="card-body">
            {{-- <div class="text-right mb-2">
              <a href="{{route('createodr')}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah Sales Order</a>
              <a href="{{route('slsorder-export')}}" class="btn btn-primary"><i class="fas fa-file-excel"></i> Export Excel</a>
            </div> --}}
            <div class="text-right mb-2 d-flex justify-content-end">
              <div class="row ml-1">
                <div>
                  <a href="{{{route('/dashboard/addSalesOrder')}}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Add Sales Order</a>
                </div>
                {{-- <div class="col mr-1">
                  <a href="{{route('order-export')}}" class="btn btn-primary"><i class="fas fa-file-excel"></i> Export Excel</a>
                </div> --}}
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <tbody><tr>
                  <th>No</th>
                  <th>Nama Project</th>
                  <th>Nama Institusi</th>
                  <th>TGL Project</th>
                  <th>Kuantitas</th>
                  <th>Harga</th>
                  <th>Total Harga</th>
                  <th>Status</th>
                </tr>
                @php $no = 1; @endphp
                @foreach ($odr as $item)
                <tr>
                  <td>000{{ $no++ }}</td>
                  <td>{{ date('d/m/Y').'/'.$kd.$item->id }}</td>
                  <td>{{$item->institusi}}</td>
                  <td>{{$item->created_at->format('d/m/Y')}}</td>
                  <td>{{$item->status}}</td>
                  <td>{{$item->uploaddoc->jenis_doc}}</td>
                  <td>{{$item->uploaddoc->up_doc}}</td>
                  <td>{{$item->uploaddoc->editor}}</td>
                </tr>
                @endforeach
              </tbody></table>
            </div>
          </div>
          
          <div class="card-footer text-right">
            <div class="row ml-2">
              <div>
                <h6>Page (<Strong>{{ $odr->currentPage() }}</Strong>)</h6>
              </div>
              <div class="col">
                {{ $odr->links() }}
              </div>
            </div>
          </div>
        </div>
    </section>
@endsection