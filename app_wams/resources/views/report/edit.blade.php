@extends('layouts.main')
@section('content')
    <section class="section">
      <h1 style="color: black; margin-left: 10px; margin-top:20px"></h1>
    </section>

    <div class="card" id="mycard-dimiss" style="border-radius: 2em">
        <div class="card-header">
          <h4>Detail Page</h4>
          <div class="card-header-action">
            <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-danger" href="/report"><i class="fas fa-times"></i></a>
          </div>
        </div>
        <div class="card-body">
            <form action="/update/{{ $getOneById->id }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}   
            <div class="row">
                <div class="col-6">
                  <div class="form-group p-3">
                    <label for="name_client">Nama Client</label>
                    <input type="text" value="{{ $getOneById->name_client }}" id="name_client" name="name_client" class="form-control" style="width: 23rem; margin-bottom:25px;">
                    <label for="name_project">Nama Project</label>
                    <input type="text" value="{{ $getOneById->name_project }}"  id="name_project" name="name_project" class="form-control" style="width: 23rem; margin-bottom:25px;">
                      <label for="job_essay">Uraian Pekerjaan</label>
                      <textarea class="form-control" value="{{ $getOneById->job_essay }}" id="job_essay" name="job_essay" style="height: 37px; width:23rem;">{{ $getOneById->job_essay }}</textarea>              
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group p-3">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="start_date">Start Date</label>
                        <input type="date" value="{{ $getOneById->start_date }}" class="form-control" id="start_date" name="start_date">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="end_date">End Date</label>
                        <input type="date" value="{{ $getOneById->end_date }}" class="form-control" id="end_date" name="end_date">
                      </div>
                    </div>
                      <label for="status">Select</label>
                      <select class="form-control" id="status" name="status" style="width: 23rem; margin-bottom:25px;">
                        <option value="{{ $getOneById->status }}">{{ $getOneById->status }}</option>
                        <option value="{{ $getOneById->status }}">Done</option>
                        <option value="{{ $getOneById->status }}">On Progress</option>
                        <option value="{{ $getOneById->status }}">Issue</option>
                      </select>
                    <label for="note">Note</label>
                    <input type="text" value="{{ $getOneById->note }}" class="form-control" id="note" name="note" style="width: 23rem; margin-bottom:25px;">
                  </div>
                </div>
              </div>
        </div>
        <div class="card-footer text-right">
          <button class="btn btn-primary mr-1" type="submit">Edit</button>
          <a href="#" class="btn btn-danger delete" data-id="{{ $getOneById->name_client }}">Delete</a>
        </div>
    </form>
    </div>
@endsection

@section('js')
<script>
$('.delete').click( function(){
  var reportid = $(this).attr('data-id');
  swal({
  title: "Are you sure?",
  text: ""+reportid+" data will be deleted",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    window.location ="/destroy/{{ $getOneById->id }}"
    swal(""+reportid+" file has been deleted!", {
      icon: "success",
    });
  } else {
    swal("Your "+reportid+" file is safe!");
  }
});  
});
</script>    
@endsection