@extends('layouts.main')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link  "  href="{{route('detail_project',$so->id)}}" role="tab"
                              >LTO</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active"   href="{{route('timeline',$so->id)}}" role="tab"
                              >Timeline</a>
                        </li>
                        <li class="nav-item " role="presentation">
                            <a class="nav-link " href="{{route('bast',$so->id)}}" role="tab"
                              >Bast</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link"  href="" role="tab"
                              >Dokumen</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{route('detail_report',$so->id)}}" role="tab"
                            >Report</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link"  href="{{route('task',$so->id)}}" role="tab"
                            >Task</a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
   
    <div class="card mt-4" style="border-radius: 2em">
        <div class="card-header">
            <div class="card-header-form">
                <form action="" method="GET">
                    <div class="input-group">
                        <button type="button" class="btn ml-2 btn-primary btn-sm" style="float: left;" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable{{$so->id}}">Add Timeline</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table  table-hover table-responsive table-bordered ">
                <thead>
                    <tr align="center">
                        <th>Kode Project</th>
                        <th> Client</th>
                        <th> Project</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>

                <tbody>
                    @foreach ($time as $id)
                   
                    <tr align="center">
                        <td><a href="{{route('detail_timeline',$id->id)}}">{{$id->kode_project}}</a></td>
                        <td>{{$id->nama_institusi}}</td>
                        <td>{{$id->nama_project}}</td>
                        {{-- <td>
                            <a href="{{route('detail_timeline',$id->id)}}"><button type="submit" class="btn btn-info" style="border-radius:3em ;">Detail</button></a>
                            <a href="{{route('newtimeline', $id->id)}}"><button type="submit" class="btn btn-primary" style="border-radius: 3em;">Add New Timeline</button></a>
                            <a href="{{route('edittml', $id->id)}}"><button type="submit" class="btn btn-warning" style="border-radius: 3em;">Edit</button></a>
                        </td> --}}
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
            <div id="exampleModalScrollable{{$so->id}}" class="modal fade modal-xl" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Create Project Timeline</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{route('simpan-data')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                      <div class="modal-body">
                        <input type="hidden" name="so_id" value="{{$so->id}}">
                        <input type="hidden" name="hps" value="{{$so->estimated_amount}}">
                        <input type="hidden" name="nama_sales" id="" value="{{$so->amsales}}">
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">No LTO</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_sales" id="inputEmail3" value="{{$so->no_so}}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal LTO</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="tgl_sales" id="inputEmail3" value="{{$so->tgl_so}}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Project</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="kode_project" id="inputEmail3" value="{{$so->kode_project}}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Client</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_institusi" id="inputEmail3" value="{{$so->institusi}}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Project</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_project" id="inputEmail3" value="{{$so->project}}" readonly  >
                            </div>
                        </div>

                        <div class="row">
                            <div class="column col-4">
                                <div class="form-group">
                                <label for="jenis_dokumen" >Nama Dokumen</label>
                                <input type="text" name="nama_dokumen" id="" class="form-control">
                                </div>
                            </div>
                            <div class="column col-4">
                                <div class="form-group">
                                <label for="" >Upload Dokumen</label>
                                <input type="file" class="form-control" id="" name="upload_dokumen" multiple="multiple" >
                                </div>
                                <a href="#" class="adddok btn btn-success" style="float:right;"><i class="bi bi-plus"></i> </a>
                            </div>
                            <div class="dok"></div>
                            </div>
                            <div class="row">
                                <div class="container mt-5 mb-3">
                                    <div class="row">
                                    {{-- <div class="col-6 col-sm-4">
                                      <label for="" class="">PM</label>
                                        <input type="text" class="form-control" name="">
                                    </div> --}}
                                    <div class="col-6 col-sm-4">
                                        <label for="" class="">Nama PM</label>
                                        <select name="nama_pm[]" id="" class="form-control">
                                        <option value=""></option>
                                        <option value="{{auth()->user()->name}}">{{auth()->user()->name}}</option>
                                        </select>
                                    </div>
                                    <div class="col-6 col-sm-4">
                                        <label for="" class="">Start Date</label>
                                        <input type="date" class="form-control " name="start_date[]">
                                    </div>
                                    <div class="col-6 col-sm-4">
                                        <label for="" class="">Finish Date</label>
                                        <input type="date" class="form-control" name="finish_date[]">
                                    </div>
                                    <div class="w-100 d-none d-md-block"></div>
                                    <div class="col-6 col-sm-4">
                                        <label for="" class="">Jenis Pekerjaan</label>
                                        <input type="text" class="form-control" name="jenis_pekerjaan[]">
                                    </div>
                                    <div class="col-6 col-sm-4">
                                        <label for="" class="">Nama Technikal</label>
                                        <select name="nama_technical[]" id="" class="form-control">
                                        <option value=""></option>
                                        @foreach ($user as $l)
                                        @foreach($l->users as $a)
                                        <option value="{{$a->name}}">{{$a->name}}</option>
                                        @endforeach
                                        @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <a href="#" class="addtechnical btn btn-success" style="float:right;"><i class="bi bi-plus"></i> </a>
                                </div>
                                <div class="technical"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn text-white" style="background-color: #5252FF">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
        </div>
        </div>
        </div>
    </div>
</section>
@endsection

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
  $('.addtechnical').on('click', function() {
    addtechnical();
  });

  function addtechnical() {
    var technical = '<div class="container"><div class="row"><div class="col-6 col-sm-5"><label for="" class="">Start Date</label><input type="date" class="form-control" name="start_date[]"> </div><div class="col-6 col-sm-5"><label for="" class="">Finish Date</label><input type="date" class="form-control" name="finish_date[]"></div><div class="w-100 d-none d-md-block"></div><div class="col-6 col-sm-5"><label for="" class="">Jenis Pekerjaan</label><input type="text" class="form-control" name="jenis_pekerjaan[]"></div><div class="col-6 col-sm-4"><label for="" class="">Nama PM</label><select name="nama_pm[]" id="" class="form-control"><option value=""></option><option value="{{auth()->user()->name}}">{{auth()->user()->name}}</option></select></div><div class="col-8 col-sm-5 "><label for="" class="">Nama Technikal</label><select name="nama_technical[]" id="" class="form-control"><option value=""></option>@foreach ($user as $l)@foreach($l->users as $a)<option value="{{$a->name}}">{{$a->name}}</option>@endforeach @endforeach</select><br><a href="#" class="remove btn btn-danger" style="float:right;"><i class="bi bi-trash"></i></a></form></div></div></div>';
    $('.technical').append(technical);
  };
  $('.remove').live('click', function() {
    $(this).parent().parent().parent().remove();
  });


  $('.adddok').on('click', function() {
    adddok();
  });

  function adddok() {
    var dok = '<div class="container"><div class="row"><div class="col-4 col-sm-4"><label for="" class="">Nama Dokumen</label><input type="text" class="form-control" name="nama_dokumen[]"> </div><div class="col-4 col-sm-4"><label for="" class="">Upload Dokumen</label><input type="file" class="form-control" name="upload_dokumen[]"></div><div class="w-100 d-none d-md-block"><br><a href="#" class="remove btn btn-danger" style="float:right;"><i class="bi bi-trash"></i></a></form></div></div></div>';
    $('.dok').append(dok);
  };
  $('.remove').live('click', function() {
    $(this).parent().parent().parent().remove();
  });
</script>


@endsection