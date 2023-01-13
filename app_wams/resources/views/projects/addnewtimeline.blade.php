@extends('layouts.main')
@section('content')
    <div class="section-header">
        <h1>Add New Timeline</h1>
    </div>
    <div class="card">
        <div class="card-body">
            @foreach($shorder->listtimeline as $t)
            <div class="mb-3 row">
                <label for="inputinstitusi" class="col-sm-2 col-form-label">Nama Client</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$t->nama_institusi}}" readonly>
                </div>
            </div>

            <div class="mb-2 row">
                <label for="inputproject" class="col-sm-2 col-form-label">Nama Project</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$t->nama_project}}" readonly>
                </div>
            </div>
         @endforeach   
            <form action="{{route('addtimeline',$t->id)}}" method="post">
                {{csrf_field()}}
                <div class="container mt-5 mb-3">
                    {{-- <div class="col-6 col-sm-4">
                        <label for="" class="">Nama PM</label>
                        <select name="nama_pm[]" id="" class="form-control">
                            <option value=""></option>
                            @foreach ($pm as $l)
                            @foreach($l->users as $a)
                            <option value="{{$a->name}}">{{$a->name}}</option>
                            @endforeach
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="technical"></div>  
                </div>
                <div class="container">
                    <a href="#" class="addtechnical btn btn-success" style="float:right;">
                        <i class="bi bi-plus"></i>
                    </a>
                </div>
                
                <a href="{{url('detail_project',$shorder->id)}}" class="btn btn-secondary " style="border-radius: 3em;">Back</a>
                <button type="submit" class="btn btn-success " style="border-radius: 3em;">Save</button>

            </form>
        </div>
    </div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
  $('.addtechnical').on('click', function() {
    addtechnical();
  });

  function addtechnical() {
    var technical = '<div class="container"><div class="row"><div class="col-6 col-sm-5"><label for="" class="">Start Date</label><input type="date" class="form-control" name="start_date[]"> </div><div class="col-6 col-sm-5"><label for="" class="">Finish Date</label><input type="date" class="form-control" name="finish_date[]"></div><div class="w-100 d-none d-md-block"></div><div class="col-6 col-sm-5"><label for="" class="">Jenis Pekerjaan</label><input type="text" class="form-control" name="jenis_pekerjaan[]"></div><div class="col-8 col-sm-5 "><label for="" class="">Nama Technikal</label><select name="nama_technical[]" id="" class="form-control"><option value=""></option>@foreach ($user as $l)@foreach($l->users as $a)<option value="{{$a->name}}">{{$a->name}}</option>@endforeach @endforeach</select><br><a href="#" class="remove btn btn-danger" style="float:right;"><i class="bi bi-trash"></i></a></form></div></div></div>';
    $('.technical').append(technical);
  };
  $('.remove').live('click', function() {
    $(this).parent().parent().parent().remove();
  });
</script>
@endsection
