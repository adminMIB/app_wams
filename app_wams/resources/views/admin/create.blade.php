@extends('layouts.main')
@section('content')
    <section class="section">
    <div class="title">
        <h1 style="color: black; margin-left: 9px; margin-top:20px">Input Project</h1>
     </div> 
       <div class="card">
        <div class="card-body">
        <form action="{{route('/adminproject/store')}}" method="POST" enctype="multipart/form-data">
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
                    <label for="inputNamaProject" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Upload Dokumen</label>
                    <div class="col-sm-10">
                    <input type="file" class=" @error('NamaProject') is-invalid @enderror form-control" name="UploadDocument[]" multiple placeholder="Nama Project" id="inputNamaProject">
                    @error('NamaProject')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label class="col-sm-2 co
                    l-form-label" style="color:black;font-weight:bold">Date</label>
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
                {{-- pm lead --}}
                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Sign Pm Lead</label>
                    <div class="col-sm-10">
                    <select class="@error('signPm_lead') is-invalid @enderror form-control" name="signPm_lead">

                    <option value=""></option>
                        @foreach ($pmLead as $item)
                            @foreach ($item->users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        @endforeach

                </select>
                    @error('signPm_lead')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>

            {{-- pm lead --}}
            <div class="mb-2 row">
                <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Technikal Lead</label>
                <div class="col-sm-10">
                <select class="@error('Technikal_lead') is-invalid @enderror form-control" name="signTechnikel_lead">

                    <option value=""></option>
                        @foreach ($TechnikelLead as $item)
                            @foreach ($item->users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        @endforeach
                    
                </select>
                @error('Technikal_lead')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>

            {{-- sales --}}
            <div class="mb-2 row">
                <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Sales</label>
                <div class="col-sm-10">
                <select class="@error('signAmSales_id') is-invalid @enderror form-control" name="signAmSales_id">

                <option value=""></option>
                    @foreach ($sales as $item)
                        @foreach ($item->users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    @endforeach

            </select>
                @error('signAmSales_id')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

            <div style="text-align:right;">
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
        </form>
            <a href="/adminproject"><button type="submit" class="btn btn-danger btn-sm">Back</button></a> 
            </div>
        </div>
    </section>
@endsection