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
          {{-- <div class="text-right mb-2">
            <div class="row ml-1">
              <div>
                <a href="" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah Sales Order</a>
              </div>
              <div class="col mr-1">
                <a href="" class="btn btn-primary"><i class="fas fa-file-excel"></i> Export Excel</a>
              </div>
            </div>
          </div> --}}
          <div class="table-responsive">
            <table class="table table-bordered table-md">
              <tbody>
              <tr class="text-center">
                <th>No</th>
                <th>Solusi/Produk</th>
                <th>Principle</th>
                <th>Deskripsi Produk</th>
                <th>Pengalaman Implementasi Produk</th>
                <th>Dokumen Datasheet</th>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
            </table>
          </div>
        </div>
        {{-- <div class="card-footer text-right">
          <div class="row ml-2">
            <div>
              <h6>Page (<Strong>{{ $odr->currentPage() }}</Strong>)</h6>
            </div>
            <div class="col">
              {{ $odr->links() }}
            </div>
          </div>
        </div> --}}
      </div>
  </section>
@endsection