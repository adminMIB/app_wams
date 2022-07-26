@extends('layouts.main')
@section('content')
    <section class="section">
    <div class="title">
        <h1 style="color: black; margin-left: 9px; margin-top:20px">Edit Sales</h1>
     </div> 
       <div class="card">
        <div class="card-body">
          <form action="{{route('Ysimpan',$edit->id)}}" method="POST" enctype="multipart/form-data">
         {{csrf_field()}}
                <div class="mb-3 row">
                    <label for="inputNamaClient" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Client</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="NamaClient" value="{{$edit->NamaClient}}">
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputNamaProject" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Project</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="NamaProject" value="{{$edit->NamaProject}}">
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Produk / Solusi</label>
                    <div class="col-sm-10">

                    <select name="elearning_id" class="@error('elearning_id') is-invalid @enderror form-control">
                        <option value="{{$edit->elearning_id}}">{{$edit->elearning_id}}</option>
                        @foreach($ele as $item)
                        <option value="{{$item->principle}}">{{$item->principle}}</option>
                        @endforeach     
                    </select>
                  
                    @error('elearning_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                   
                    </div>
                </div>
        
                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Timeline</label>
                    <div class="col-sm-10">
                    <select name="Timeline" class="@error('Timeline') is-invalid @enderror form-control" >
                        <option value="{{$edit->Timeline}}">{{$edit->Timeline}}</option>
                        <option value="Q1"> Q1</option>
                        <option value="Q2"> Q2</option>
                        <option value="Q3"> Q3</option>
                        <option value="Q4"> Q4</option>
                       
                    </select>
                    @error('Timeline')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>


                <div class="mb-2 row">
                    <label class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Date</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control" name="Date" value="{{$edit->Date}}" >
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputAngka" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Angka</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" name="Angka" value="{{$edit->Angka}}">
                    </div>
                </div>

                
                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Status</label>
                    <div class="col-sm-10">
                    <select class="@error('Status') is-invalid @enderror form-control" name="Status">

                        <option value="{{$edit->Status}}">{{$edit->Status}}</option>
                        <option value="Tender"> Tender</option>
                        <option value="Menang"> Menang</option>
                        <option value="Kalah"> Kalah</option>
                        
                    </select>
                    @error('Status')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Note</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="Note">{{$edit->Note}} </textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                </form>
        </div>
       </div>

      
    
    </section>
@endsection