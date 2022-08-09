@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>Detail List admin Project</h1>
        </div>

        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data"> 
                  @method('put')
                  {{csrf_field()}}
                  {{-- ID Project --}}
                <div class="form-group">
                  <label>Id Project</label>
                  <input type="text" name="namaClient" class="form-control" value="{{$detailId->ID_project}}" autofocus readonly>
                </div>
                  {{-- nama client --}}
                <div class="form-group">
                  <label>Nama Client</label>
                  <input type="text" name="namaClient" class="form-control" value="{{$detailId->NamaClient}}" autofocus readonly>
                </div>
                  {{-- nama project --}}
                <div class="form-group">
                  <label>Nama Project</label>
                  <input type="text" name="namaProject" class="form-control" value="{{$detailId->NamaProject}}" autofocus readonly>
                </div>
                
                {{-- Date--}}
                <div class="form-group">
                  <label>Date</label>
                  <input type="text" name="Date" class="form-control" value="{{$detailId->Date}}" readonly>
                </div>
                {{-- Angka--}}
                <div class="form-group">
                  <label>Angka </label>
                  <input type="text" name="Angka" class="form-control" value="{{$detailId->Angka}}" readonly>
                </div>
                {{-- Status--}}
                <div class= readonlyform-group">
                  <label>Status</label>
                  <input type="text" name="Status" class="form-control" value="{{$detailId->Status}}" readonly>
                </div>
                {{-- Note --}}
                {{-- <div class="form-group">
                  <label>Note</label>
                  <textarea type="text" name="Note" class="form-control" value="{{$detailId->Note}}" readonly ></textarea>
                </div> --}}
                {{-- sign Pm Lead --}}
                <div class="form-group mt-3">
                  <label>Sign Pm Lead</label>
                  <input type="text" name="SignPm_lead" class="form-control" value="{{$detailId->pmLead->name}}" readonly>
                </div>
                {{-- sign Technikal Lead --}}
                <div class="form-group">
                  <label>Sign Technikal Lead</label>
                  <input type="text" name="signTechnikel_lead" class="form-control" value="{{$detailId->technikelLead->name}}" readonly>
                </div>
                {{-- sign amSales Lead --}}
                <div class="form-group">
                  <label>Sign Am Sales</label>
                  <input type="text" name="signAmSales_id" class="form-control" value="{{$detailId->sales->name}}" readonly>
                </div>
                {{-- upload Document --}}
                <div class="form-group">
                  <label>Upload Document</label>
                
                      
                  <p><a class="btn btn-primary" href="{{ route('zip-download',['download'=>'zip']) }}">Download zip</a></p>
                      
                  <a href="/admin/{{$detailId->UploadDocument}}">{{$detailId->UploadDocument}}</a>
                  {{-- <input type="text" name="UploadDocument" class="form-control" value="{{$detailId->UploadDocument}}" readonly> --}}


                </div>
                {{-- Note --}}
                <div class="form-group">
                  <label>Note</label>
                  <textarea type="text" name="Note" class="form-control" value="{{$detailId->Note}}" readonly>{{$detailId->Note}}</textarea>
                </div>
                
                
                <a href="/adminproject" class="btn btn-primary text-white">Back</a>
            </form> 
              </div>
      </div>
    </section>
@endsection