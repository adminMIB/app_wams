@extends('layouts.main')
@section('content')
    <section class="section">
    <div class="section-header">
        <h1>Edit Pipeline</h1>
     </div> 
       <div class="card">
        <div class="card-body">
          <form action="{{route('Ysimpan',$edit->id)}}" method="POST" enctype="multipart/form-data">
         {{csrf_field()}}
                <div class="mb-3 row">
                    <label for="inputNamaClient" class="col-sm-3 col-form-label">Client Name</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" name="NamaClient" value="{{$edit->NamaClient}}">
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputNamaProject" class="col-sm-3 col-form-label">Project Name</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" name="NamaProject" value="{{$edit->NamaProject}}">
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-3 col-form-label">Principal</label>
                    <div class="col-sm-9">

                    <select name="elearning_id" class="@error('elearning_id') is-invalid @enderror form-control">
                        <option value="{{$edit->elearning_id}}">{{$edit->elearning_id}}</option>
                        @foreach($principal as $item)
                        <option value="{{$item->name}}">{{$item->name}}</option>
                        @endforeach    
                    </select>
                  
                    @error('elearning_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                   
                    </div>
                </div>
                
                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-3 col-form-label">Distributor</label>
                    <div class="col-sm-9">

                    <select name="distributor" class="@error('distributor') is-invalid @enderror form-control">
                        <option value="{{$edit->distributor}}">{{$edit->distributor}}</option>
                        @foreach($distributor as $item)
                        <option value="{{$item->distributor}}">{{$item->distributor}}</option>
                        @endforeach 
                    </select>
                  
                    @error('distributor')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                   
                    </div>
                </div>

                <div class="mb-2 row">
                    <label class="col-sm-3 col-form-label">Date</label>
                    <div class="col-sm-9">
                    <input type="date" class="form-control" name="Date" value="{{$edit->Date}}" >
                    </div>
                </div>
        
                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-3 col-form-label">Timeline</label>
                    <div class="col-sm-9">
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
                    <label class="col-sm-3 col-form-label">Estimated Amount</label>
                    <div class="col-sm-9">
                    <input type="text" class="@error('estimated_amount') is-invalid @enderror form-control" id="inputAngka2" value="{{$edit->estimated_amount}}" name="estimated_amount" id="inputAngka2">
                    @error('estimated_amount')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-3 col-form-label">Progress Status</label>
                    <div class="col-sm-9">
                    <select class="@error('Status') is-invalid @enderror form-control" name="Status">

                        <option value="{{$edit->Status}}">{{$edit->Status}}</option>
                        @foreach($prostat as $item)
                        <option value="{{$item->title}}">{{$item->title}}</option>
                        @endforeach
                        
                    </select>
                    @error('Status')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label class="col-sm-3 col-form-label">Confidence Level</label>
                    <div class="col-sm-9">
                    <input type="text" class="@error('confidence_level') is-invalid @enderror form-control" value="{{$edit->confidence_level}}" name="confidence_level">
                    @error('confidence_level')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>
                <div class="mb-2 row">
                    <label class="col-sm-3 col-form-label">Contract Amount</label>
                    <div class="col-sm-9">
                    <input type="text" class="@error('contract_amount') is-invalid @enderror form-control" id="inputAngka3" value="{{$edit->contract_amount}}" name="contract_amount" id="inputAngka3">
                    @error('contract_amount')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-3 col-form-label">Presales</label>
                    <div class="col-sm-9">
                    <select class="@error('Status') is-invalid @enderror form-control" value="{{$edit->presales}}" name="presales">

                        <option value="{{$edit->presales}}">{{$edit->presales}}</option>
                        @foreach ($Technikel as $item)
                            @foreach ($item->users as $user)
                                <option value="{{$user->name}}">{{$user->name}}</option>
                            @endforeach
                        @endforeach
                        
                        
                    </select>
                    @error('Status')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-3 col-form-label">PMO</label>
                    <div class="col-sm-9">
                    <select class="@error('Status') is-invalid @enderror form-control" name="pmo">

                        <option value="{{$edit->pmo}}">{{$edit->pmo}}</option>
                        @foreach ($pm as $item)
                            @foreach ($item->users as $user)
                                <option value="{{$user->name}}">{{$user->name}}</option>
                            @endforeach
                        @endforeach
                        
                        
                    </select>
                    @error('Status')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-3 col-form-label">SBU</label>
                    <div class="col-sm-9">
                    <select class="@error('Status') is-invalid @enderror form-control" name="sbu">

                        <option value="{{$edit->sbu}}">{{$edit->sbu}}</option>
                        @foreach($sbu as $item)
                        <option value="{{$item->name}}">{{$item->name}}</option>
                        @endforeach
                        
                    </select>
                    @error('Status')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>



                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">Note</label>
                    <div class="col-sm-9">
                    <textarea class="form-control" name="Note">{{$edit->Note}} </textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{url ('index-sales')}}" class="btn btn-secondary btn-sm">Back</a> 
                </form>
        </div>
       </div>

      
    
    </section>
@endsection
@section('js')
{{-- <script>
    var harga1 = document.getElementById('inputAngka1');
    harga1.addEventListener('keyup', function(e)
    {
        harga1.value = formatRupiah(this.value, 'Rp. ');
    });
    
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<script>
    var harga2 = document.getElementById('inputAngka2');
    harga2.addEventListener('keyup', function(e)
    {
        harga2.value = formatRupiah(this.value, 'Rp. ');
    });
    
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<script>
    var harga3 = document.getElementById('inputAngka3');
    harga3.addEventListener('keyup', function(e)
    {
        harga3.value = formatRupiah(this.value, 'Rp. ');
    });
    
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script> --}}
@endsection