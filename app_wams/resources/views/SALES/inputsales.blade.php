@extends('layouts.main')
@section('content')
    <section class="section">
    <div class="title">
        <h1 style="color: black; margin-left: 9px; margin-top:20px">Input Sales</h1>
     </div> 
       <div class="card">
        <div class="card-body">
        <form action="{{route('Ysimpan-data')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
        
                <div class="mb-3 row">
                    <label for="inputNamaClient" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Client</label>
                    <div class="col-sm-10">
                    <input type="text" class="@error('NamaClient') is-invalid @enderror form-control" name="NamaClient" placeholder="Nama Client" id="inputNamaClient">
                    @error('NamaClient')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputNamaProject" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Project</label>
                    <div class="col-sm-10">
                    <input type="text" class=" @error('NamaProject') is-invalid @enderror form-control" name="NamaProject" placeholder="Nama Project" id="inputNamaProject">
                    @error('NamaProject')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Produk / Solusi</label>
                    <div class="col-sm-10">
                        <select name="elearning_id" class="@error('elearning_id') is-invalid @enderror form-control">
                            <option value="">-- Produk / Solusi --</option>
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
                    <select name="Timeline" class="@error('Timeline') is-invalid @enderror form-control">
                        <option value="">-- Timeline Dropdown Q1, Q2, Q3, Q4 --</option>
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
                    <input type="date" class="@error('Date') is-invalid @enderror form-control date" name="Date">
                    @error('Date')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputAngka" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Angka</label>
                    <div class="col-sm-10">
                    <input type="number" class="@error('Angka') is-invalid @enderror form-control" name="Angka" placeholder="Angka" id="inputAngka">
                    @error('Angka')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Status</label>
                    <div class="col-sm-10">
                    <select class="@error('Status') is-invalid @enderror form-control" name="Status">

                        <option value="">-- Tender, Menang, Kalah --</option>
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
                    <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Note</label>
                    <div class="col-sm-10">
                    <textarea class="@error('Note') is-invalid @enderror form-control" name="Note" id="exampleFormControlTextarea1" ></textarea>
                    @error('Note')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>
                <div style="text-align:right;">
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
        </form>
       
        <a href="{{url ('index-sales')}}"><button type="submit" class="btn btn-danger btn-sm">Back</button></a> 
       
        </div>
       </div>

      
    
    </section>
@endsection