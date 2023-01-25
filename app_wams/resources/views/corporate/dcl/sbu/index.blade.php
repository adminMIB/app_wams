@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/datatables.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">
            <div class="text-center mt-2">
                <h2 class="text-capitalize">SBU</h2>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Create</button>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>No</th>
                        <th>Nama SBU</th>
                        <th>PIC (SALES)</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sbu as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->PicSales }}</td>
                        <td>
                          <a href="javascript:void(0)" class="btn btn-warning edit" data-id="{{ $item->id }}">Edit</a>
                          <a href="{{ route('dclsbudelete', $item->id) }}" onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</section>

<div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" style="text-align: center" id="exampleModalLabel">Create Personel Team</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('dclsbustore') }}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="modal-body">

            <label for="">Nama SBU</label>
            <input type="text" class="form-control" name="name">

            <label for="" class="mt-2">PIC(SALES)</label>
            <select name="PicSales" id="" class="form-select">
                <option value="">-----PILIH------</option>
                @foreach ($psteam as $item)
                    <option value="{{ $item->nama_personel }}">{{ $item->nama_personel }}</option>
                @endforeach
            </select>

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


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="sbu_id" id="sbu_id">
        <label for="">Nama SBU</label>
        <input type="text" id="nameUpdate" class="form-control" name="name">

        <label for="" class="mt-2">PIC(SALES)</label>
        <select name="pic" id="pic" class="form-select">
          <option value="">------PILIH------</option>
            @foreach ($psteam as $item)
              <option value="{{ $item->nama_personel }}">{{ $item->nama_personel }}</option>
            @endforeach
          </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update">Update changes</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('js')
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
<script>
  $(document).on("click", ".edit", function() {
    $.get("/edit/sbu/" + $(this).data("id")).done(function(res) {
      $("#editModal").modal("show")
      $("#nameUpdate").val(res.name);
      $("#pic").val(res.PicSales);
      $("#sbu_id").val(res.id)
    })
  });

  $("#update").on("click", function() {
    var id = $("#sbu_id").val()
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: "/update/sbu/" + id,
      method: "POST",
      data: {
        name: $("#nameUpdate").val(),
        pic: $("#pic").val()
      }
    }).done(function(res) {
      location.reload()
    })
  })

</script>
@endsection