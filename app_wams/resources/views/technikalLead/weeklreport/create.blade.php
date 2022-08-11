@extends('layouts.main')
@section('content')
    <section class="section">
      <h1 style="color: black; margin-left: 10px; margin-top:20px"></h1>
    </section>
    
    <form action="{{ url('/tlStore') }}" method="POST">
      {{ csrf_field() }}  
    <!-- Table Report -->
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
          <h4>Create Weekly Report</h4>
          <div class="card-header-action">
            <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-danger" href="/tlWeeklyReport"><i class="fas fa-times"></i></a>
          </div>
          <div class="card-header-form">
          </div>
        </div>
        <div class="collapse show" id="mycard-collapse">
            <div class="card-body p-0">
              <div class="table-responsive">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group p-3">
                      <label for="name_institusi">Nama Client</label>
                      <select class="selectric-wrapper form-control selectric-selectric selectric-below selectric-open" style="width: 23rem;  margin-bottom:25px;" id="id" name="listp_id">
                        <div class="selectric-hide-select">
                          @foreach ($listp as $value)
                          <option value="{{ $value->id }}" class="form-control selectric">{{ $value->nama_institusi }}</option>  
                          @endforeach  
                        </div>
                      </select>
                      <label for="name_institusi">Nama Institusi</label>
                      <input type="text" id="nama_institusi" name="name_client" class="form-control" style="width: 23rem; margin-bottom:25px;">
                      <label for="name_project">Nama Project</label>
                      <input type="text" id="nama_project" name="name_project" class="form-control" style="width: 23rem; margin-bottom:25px;">
                        <label for="job_essay">Uraian Pekerjaan</label>
                        <textarea class="form-control" id="job_essay" name="job_essay" style="height: 37px; width:23rem;"></textarea>              
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group p-3">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="start_date">Start Date</label>
                          <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="end_date">End Date</label>
                          <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                      </div>
                        <label for="status">Select</label>
                        <select class="form-control" id="status" name="status" style="width: 23rem; margin-bottom:25px;">
                          <option>Pilih Status....</option>
                          <option>Done</option>
                          <option>Issue</option>
                          <option>OnProgress</option>
                        </select>
                      <label for="note">Note</label>
                      <input type="text" class="form-control" id="note" name="note" style="width: 23rem; margin-bottom:25px;">
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary mr-1" type="submit">Save</button>
                </div>
              </div>
            </div>
        </div>
      </div>
      <!-- Akhir Table Report -->
    </form>
@endsection

@section('js')

<script>
   //change to two ? how?

 $('#id').change(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
      method: "POST",
      type: "JSON",
      data: { id : this.value },
      url: "/get_one_pm"
    }).done(function(res) {
      $("#nama_institusi").val(res.nama_institusi)
      $("#nama_project").val(res.nama_project)
      $("#listp_id").val(res.id)
    })
 });
</script>
    
@endsection