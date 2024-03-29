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

                {{-- upload Document --}}
                <div class="form-group mt-3">
                  <label>Download Document</label>
                      
                  {{-- <p><a class="btn btn-primary" href="{{ route('zip-download',['download'=>'zip']) }}">Download zip</a></p> --}}

                  <div>
                    {{-- @foreach (explode(",", $detailId->UploadDocument) as $file)
                    <a href="/tmp/uploads/{{$file}}">{{$file}}<br></a>
                    @endforeach --}}
                    @foreach ($detailId->admin_upload as $i)
                    @foreach (explode("," , $i->file_name) as $a) 
                    <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                    @endforeach
                    @endforeach
                  </div>

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