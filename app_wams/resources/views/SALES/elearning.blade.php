@extends('layouts.main')
@section('content')
<style>
  .card-header-action {
    margin-left: 70%;
  }
</style>
<section class="section">
  <div class="section-header">
    <h1>List Elearning</h1>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Solution/Product</th>
              <th>Principal</th>
              <th>Description Product</th>
              <th>Experience</th>
              <th>Data Sheet Document</th>
            </tr>
          </thead>
          @foreach($ele as $item)
          <tbody>
            <tr>
              <th scope="row">{{$item->produk}}</th>
              <td>{{$item->principle}}</td>
              <td>{{$item->deskripsi}}</td>
              <td>
                @foreach ($item->elearn as $it)
                {{ $it->implementasi }},
                @endforeach
              </td>
              <td>
                <a href="dokumen/{{$item->upload}}">{{$item->upload}}</a>
              </td>          
            </tr>
          </tbody>
          @endforeach
        </table>
      </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
      {{ $ele->links() }}
    </div>
  </div>
</section>
@endsection