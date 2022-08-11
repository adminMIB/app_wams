@extends('layouts.main')
@section('content')
    <section class="section">
    <div class="title">
        <h1 style="color: black; margin-left: 9px; margin-top:20px">Detail Sales</h1>
     </div>
     <form action="{{route('/adminShowSalesUpdate', $detail->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        {{csrf_field()}}
         <div class="card">
          <div class="card-body">
                  <div class="mb-3 row">
                      <label for="inputNamaClient" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Client</label>
                      <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$detail->NamaClient}}" readonly>
                      </div>
                  </div>
     
                  <div class="mb-2 row">
                      <label for="inputNamaProject" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Project</label>
                      <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$detail->NamaProject}}" readonly>
                      </div>
                  </div>
          
     <div class="mb-2 row">
                      <label for="inputProduk/Solusi" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Produk/Solusi</label>
                      <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$detail->elearning_id}}" readonly>
                      </div>
                  </div>
     
                  <div class="mb-2 row">
                      <label for="inputTimeline" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Timeline</label>
                      <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$detail->Timeline}}" readonly>
                      </div>
                  </div>
     
                 
     
                  <div class="mb-2 row">
                      <label class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Date</label>
                      <div class="col-sm-10">
                      <input type="date" class="form-control" value="{{$detail->Date}}" readonly>
                      </div>
                  </div>
     
                  <div class="mb-2 row">
                      <label for="inputAngka" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Angka</label>
                      <div class="col-sm-10">
                      <input type="number" class="form-control" value="{{$detail->Angka}}" readonly >
                      </div>
                  </div>
     
                  <div class="mb-2 row">
                      <label for="inputAngka" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Status</label>
                      <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$detail->Status}}" readonly >
                      </div>
                  </div>
     
                  <div class="mb-3 row">
                      <label for="" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Note</label>
                      <div class="col-sm-10">
                      <textarea class="form-control" name="Note"  readonly>{{$detail->Note}} </textarea>
                      </div>
                  </div>
     
                  <div class="mb-3 row">
                      <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Sign Pm Lead </label>
                      <div class="col-sm-10">
                          @if ($detail->pmLead_id)
                          <input type="text" class="form-control" value="{{$detail->pmLead->name}}" readonly >
                        </div>
                              @else
                              <select class="@error('pmLead_id') is-invalid @enderror form-control" name="pmLead_id">
             
                              <option value=""></option>
                                  @foreach ($pmLead as $item)
                                      @foreach ($item->users as $user)
                                          <option value="{{$user->id}}">{{$user->name}}</option>
                                      @endforeach
                                  @endforeach
                                  {{-- <option value=""></option> --}}
             
             
                          </select>
                          @endif
                      @error('pmLead_id')
                      <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                  </div>
              </div>
     
              <div class="mb-3 row p-4">
                  <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Sign Technikal Lead </label>
                  <div class="col-sm-10">
                      @if ($detail->TechnikalLead_id)
                      <input type="text" class="form-control" value="{{$detail->technikelLead->name}}" readonly >
                      @else
                          
                      <select class="@error('TechnikalLead_id') is-invalid @enderror form-control" name="TechnikalLead_id">
         
                      <option value=""></option>
                          @foreach ($technikalLead as $item)
                              @foreach ($item->users as $user)
                                  <option value="{{$user->id}}">{{$user->name}}</option>
                              @endforeach
                          @endforeach
                          {{-- <option value=""></option> --}}
         
         
                  </select>
                      @endif
                  @error('TechnikalLead_id')
                  <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
          </div>

          <div style="text-align:right;">
            <button type="submit" class="btn btn-danger btn-md">Send</button>
        </div>
        <div style="text-align:left;">
            <a href="/adminproject/sales" class="btn btn-primary m-2">Back</a>
        </div>
     
     
          </div>
         </div>
    </form> 
    

      
    
    </section>
@endsection