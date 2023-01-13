@extends('layouts.main')
@section('content')
    <section class="section">
    <div class="section-header">
        <h1>Input Sales Pipeline</h1>
     </div> 
       <div class="card">
        <div class="card-body">
        <form action="{{route('Ysimpan-data')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="text" class="form-control d-none" name="arr" value="{{date('d/m/Y').'/'.$dd}}">

            <input type="text" class="form-control d-none" name="no_opty" value="{{date('d/m/Y').'/'.$dd}}">
                <div class="mb-3 row">
                    <label for="inputNamaClient" class="col-sm-3 col-form-label">Client Name</label>
                    <div class="col-sm-9">
                    <select name="NamaClient" class="form-select" required>
                        <option value=""></option>
                        @foreach($customer as $item)
                        <option value="{{$item->nama}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputNamaProject" class="col-sm-3 col-form-label">Project Name</label>
                    <div class="col-sm-9">
                    <input type="text" class=" form-control" name="NamaProject" placeholder="Project Name" id="inputNamaProject" required>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-3 col-form-label">Principal</label>
                    <div class="col-sm-9">
                        <select name="elearning_id" class="form-control" required>
                            <option value="" disabled selected hidden>Principal</option>
                            @foreach($principal as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                       
                    </select>

                    </div>
                </div>
                
                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-3 col-form-label">Distributor</label>
                    <div class="col-sm-9">
                        <select name="distributor" class="form-control" required>
                            <option disabled selected hidden>Distributor</option>
                            @foreach($distributor as $item)
                            <option value="{{$item->distributor}}">{{$item->distributor}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="mb-2 row">
                    <label class="col-sm-3 col-form-label">Date</label>
                    <div class="col-sm-9">
                    <input type="date" class="form-control date" name="Date" required>
                    </div>
                </div>
        
                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-3 col-form-label">Timeline</label>
                    <div class="col-sm-9">
                    <select name="Timeline" class="form-control" required>
                        <option value="" disabled selected hidden>-- Timeline Dropdown Q1, Q2, Q3, Q4 --</option>
                        <option value="Q1"> Q1</option>
                        <option value="Q2"> Q2</option>
                        <option value="Q3"> Q3</option>
                        <option value="Q4"> Q4</option>
                       
                    </select>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputAngka" class="col-sm-3 col-form-label">Estimated Amount</label>
                    <div class="col-sm-9">
                    <input type="number" class="form-control" name="estimated_amount" placeholder="Estimated Amount" id="inputAngka1" required>
                    </div>
                </div>


                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-3 col-form-label">Progress Status</label>
                    <div class="col-sm-9">
                    <select class="form-control" name="Status" required>

                        <option disabled selected hidden>Progress Status</option>
                        @foreach($prostat as $item)
                        <option value="{{$item->title}}">{{$item->title}}</option>
                        @endforeach
                        
                    </select>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label class="col-sm-3 col-form-label">Confidence Level</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" name="confidence_level" placeholder="Confidence Level" required>
                    </div>
                </div>
                <div class="mb-2 row">
                    <label class="col-sm-3 col-form-label">Contract Amount</label>
                    <div class="col-sm-9">
                    <input type="number" class="form-control" name="contract_amount" id="inputAngka3" placeholder="Contract Amount">
                    </div>
                </div>

                

                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-3 col-form-label">Presales</label>
                    <div class="col-sm-9">
                    <select class="form-control" name="presales" required>

                        <option value="" disabled selected hidden>Presales</option>
                        @foreach ($Technikel as $item)
                            @foreach ($item->users as $user)
                                <option value="{{$user->name}}">{{$user->name}}</option>
                            @endforeach
                        @endforeach
                        
                        
                    </select>
                    </div>
                </div>
                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-3 col-form-label">PMO</label>
                    <div class="col-sm-9">
                    <select class="form-control" name="pmo" required>

                        <option value="" disabled selected hidden>PMO</option>
                        @foreach ($pm as $item)
                            @foreach ($item->users as $user)
                                <option value="{{$user->name}}">{{$user->name}}</option>
                            @endforeach
                        @endforeach
                        
                        
                    </select>
                    </div>
                </div>
                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-3 col-form-label">SBU</label>
                    <div class="col-sm-9">
                    <select class="form-control" name="sbu" required>

                        <option value="" disabled selected hidden>SBU</option>
                        @foreach($sbu as $item)
                        <option value="{{$item->name}}">{{$item->name}}</option>
                        @endforeach
                        
                    </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="exampleFormControlTextarea1" class="col-sm-3 col-form-label">Note</label>
                    <div class="col-sm-9">
                    <textarea class="form-control" name="Note" id="exampleFormControlTextarea1" placeholder="Note"></textarea>
                    </div>
                </div>

                <div style="text-align:right;">
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    <a href="{{url ('index-sales')}}" class="btn btn-danger btn-sm">Back</a> 
                </div>
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