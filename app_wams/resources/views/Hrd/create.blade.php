@extends('layouts.main')

@section('title', 'Create Karyawan')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="card">
                <div class="alert">
                    <h2 class="text-capitalize text-center">Create Data Karyawan</h2>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('hrd.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">NIK</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="number" name="nik" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Nama</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Phone</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Email</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Status</label>
                        </div>
                        <div class="col-sm-9">
                            <select name="status" class="form-control" required>
                                <option value="">---------PILIH--------</option>
                                <option value="menikah">Menikah</option>
                                <option value="lajang">Lajang</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Jenis Kelamin</label>
                        </div>
                        <div class="col-sm-9">
                            <select name="gender" class="form-control" required>
                                <option value="">---------PILIH--------</option>
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Agama</label>
                        </div>
                        <div class="col-sm-9">
                            <select name="religion" class="form-control" required>
                                <option value="">---------PILIH--------</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Kong Hu Chu">Kong Hu Chu</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Tanggal Lahir</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="date_birth" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Alamat</label>
                        </div>
                        <div class="col-sm-9">
                            <textarea name="address" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Asal Istansi</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="from_institute" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Keahlian</label>
                        </div>
                        <div class="col-sm-9">
                            <textarea name="skills" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Tanggal Masuk</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="joined" required>
                        </div>
                    </div>

                    <div class="form-group" style="padding-top: 40px">
                        <a href="{{ route('hrd.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <button class="btn btn-primary">Simpan <i class="fa fa-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection