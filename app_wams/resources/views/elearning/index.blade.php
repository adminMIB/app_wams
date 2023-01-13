@extends('layouts.main')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>List Elearning</h1>
  </div>
  <div class="row">
    <div class="card">
      <div class="card-header">
        <a href="{{route ('create-elearning')}}"> <button type="submit" class="btn btn-primary btn-sm">Create</button></a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Solution/Product</th>
                <th>Principal</th>
                <th>Product Description</th>
                <th>Experience</th>
                <th>Datasheet Document</th>
                <th>Action</th>
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
                <td class="text-center">
                  <div class="btn-group dropstart mb-1" style="cursor: pointer;">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </div>
                    <div class="dropdown-menu text-center">
                      <a href="{{url ('Eedit', $item->id)}}" class="btn btn-warning btn-sm">Edit</i></a>
                      <a href="{{url ('delete', $item->id)}}" onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                  </div>
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
  </div>
</section>
@endsection