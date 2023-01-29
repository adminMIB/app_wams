@extends('layouts.main')

@section('title', 'Create Karyawan - ' . $data->name)

@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">
            <div class="alert">
                <h2 class="text-capitalize text-center">Edit Data Karyawan - {{ $data->name }}</h2>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('hrd.update', $data->id) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">NIK</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" name="nik" class="form-control" value='{{old('nik', $data->nik)}}' required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Nama</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" value='{{old('name', $data->name)}}' required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Phone</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $data->phone) }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Email</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" value="{{ old('email', $data->email) }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Status</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="status" class="form-control" value="{{ old('status', $data->status) }}"  required>
                            <option value="">---------PILIH--------</option>
                            <option value="menikah" {{ $data->status == 'menikah' ? 'selected' : '' }} >Menikah</option>
                            <option value="lajang" {{ $data->status == 'lajang' ? 'selected' : '' }}>Lajang</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Jenis Kelamin</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="gender" class="form-control" value="{{ old('gender', $data->gender) }}" required>
                            <option value="">---------PILIH--------</option>
                            <option value="L" {{ $data->gender == "L" ? 'selected' : '' }} >Laki - Laki</option>
                            <option value="P" {{ $data->gender == "P" ? 'selected' : '' }} >Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Agama</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="religion" class="form-control" value="{{ old('religion', $data->religion) }}" required>
                            <option value="">---------PILIH--------</option>
                            @php $religion = ["Islam", "Kristen", "Buddha", "Katolik", "Kong Hu Chu"] @endphp
                            @foreach($religion as $val)
                                <option value="{{ $val }}" {{ $data->religion == $val ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Tanggal Lahir</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" name="date_birth" value="{{ old('date_birth', $data->date_birth) }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Alamat</label>
                    </div>
                    <div class="col-sm-9">
                        <textarea name="address" rows="10" class="form-control">{{ old('address', $data->address) }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Asal Istansi</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="from_institute" value="{{ old('from_institute', $data->from_institute) }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Keahlian</label>
                    </div>
                    <div class="col-sm-9">
                        <textarea name="skills" rows="10" class="form-control">{{ old('skills', $data->skills) }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="">Tanggal Masuk</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" name="joined" value="{{ old('joined', $data->joined) }}" required>
                    </div>
                </div>

                <div class="form-group" style="padding-top: 40px">
                    <a href="{{ route('hrd.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <button class="btn btn-primary">update <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection