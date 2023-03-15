@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">
            <div class="text-center mt-2">
                <h2 class="text-capitalize">Create Oppty/Project</h2>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-body">
            <form action="{{ route('opptyprojectstore') }}" method="POST">
                {{ csrf_field() }}
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Jenis</label>
                    <div class="col-sm-10">
                        <select name="jenis" class="form-select" id="" required>
                            <option value="">------PILIH------</option>
                            <option value="Oppty">Oppty</option>
                            <option value="Project">Project</option>
                        </select>
                    </div>
                </div> 
                
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ID_opptyproject" required>
                    </div>
                </div> 
                
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nama Project</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_project" required>
                    </div>
                </div> 
                
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">PIC Business Channel</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pic_bussiness_channel" required>
                    </div>
                </div> 
                
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Client</label>
                    <div class="col-sm-10">
                        <select name="client" class="form-control select" required>
                            <option value="">------PILIH------</option>
                            @foreach($customer as $row)
                                <option value="{{ $row->nama }}">{{ $row->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 

                <div class="text-end">
                    <a href="{{ route('opptyprojectindex') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection