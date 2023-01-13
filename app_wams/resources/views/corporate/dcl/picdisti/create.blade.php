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
            <form action="{{ route('picdististore') }}" method="POST">
                {{ csrf_field() }}
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Name Distributor</label>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <select class="form-select" name="nama_disti" required>
                                <option value=""></option>
                                @foreach ($dst as $item)
                                    <option value="{{ $item->distributor }}">{{ $item->distributor }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">PIC Distributor</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pic_disti" required>
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
                        <input type="text" class="form-control" name="email_pic" required>
                    </div>
                </div> 
                
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nomor HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nomor_hp" required>
                    </div>
                </div> 
                
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Pengajuan CL</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pengajuan_cl" required>
                    </div>
                </div> 
                
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Jumlah CL</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="jumlah_cl" required>
                    </div>
                </div> 

                <div class="text-end">
                    <a href="{{ route('picdistiindex') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection