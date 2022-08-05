@extends('layouts.main')
@section('content')
    <section class="section">
    <div class="title">
        <h1 style="color: black; margin-left: 9px; margin-top:20px">Edit Sales</h1>
     </div> 
       <div class="card">
        <div class="card-body">
         
         {{csrf_field()}}
                <div class="mb-3 row">
                    <label for="inputinstitusi" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Client</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="institusi" value="{{$data->lists->institusi}}">
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputproject" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Project</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="project" value="{{$data->lists->project}}">
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputstart_date" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Start Date</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control" name="start_date" value="{{$data->start_date}}">
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputfinish_date" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Finish Date</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control" name="finish_date" value="{{$data->finish_date}}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputnama_technical" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Technikal</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_technical" value="{{$data->nama_technical}}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputjenis_pekerjaan" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Jenis Pekerjaan</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="jenis_pekerjaan" value="{{$data->jenis_pekerjaan}}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                </form>
        </div>
       </div>

      
    
    </section>
@endsection