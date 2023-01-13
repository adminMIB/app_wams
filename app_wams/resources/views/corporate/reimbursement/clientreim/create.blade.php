@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">
            <div class="text-center mt-2">
                <h2 class="text-capitalize">Create Client</h2>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-body">
            <form action="{{ route('clientstore') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="idCustomer" value="{{ $ResultsnoCustomer }}">
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Name Client</label>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <select class="form-select" name="namaCustomer" required>
                                <option value="asd">asd</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Alamat Client</label>
                    <div class="col-sm-10">
                        <textarea name="alamat" id="" class="form-control" required></textarea>
                    </div>
                </div> 
                
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nama PIC</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_pic" required>
                    </div>
                </div> 
                
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Jabatan PIC</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="jabatan_pic" required>
                    </div>
                </div> 
                
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Email PIC</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" required>
                    </div>
                </div> 
                
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nomor HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_hp" required>
                    </div>
                </div> 
                
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nomor Telephone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="noTelephone" required>
                    </div>
                </div> 

                <div class="text-end">
                    <a href="{{ route('clientindex') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection