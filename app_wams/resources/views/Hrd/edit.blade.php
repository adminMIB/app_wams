@extends('layouts.main')

@section('title', 'Create Karyawan - ' . $data->name)
@section('css')
    <style>

    .nav-pills-custom .nav-link {
        color: #aaa;
        background: #fff;
        position: relative;
    }

    .nav-pills-custom .nav-link.active {
        color: #45b649;
        background: #fff;
    }


    /* Add indicator arrow for the active tab */
    @media (min-width: 992px) {
        .nav-pills-custom .nav-link::before {
            content: '';
            display: block;
            border-top: 8px solid transparent;
            border-left: 10px solid #fff;
            border-bottom: 8px solid transparent;
            position: absolute;
            top: 50%;
            right: -10px;
            transform: translateY(-50%);
            opacity: 0;
        }
    }

    .nav-pills-custom .nav-link.active::before {
        opacity: 1;
    }
    </style>

@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">
            <div class="alert">
                <h2 class="text-capitalize">
                    <a href="{{ route('hrd.index') }}"><i class="fa fa-arrow-left"></i></a>
                    Edit Data Karyawan - {{ $data->name }}
                </h2>
            </div>
        </div>
    </div>
    <div class="row">
                <div class="col-md-3">
                    <!-- Tabs nav -->
                    <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link mb-3 p-3 shadow active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                            <i class="fa fa-user-circle-o mr-2"></i>
                            <span class="font-weight-bold small text-uppercase"><i class="fa fa-user"></i> Personal information <i></i></span></a>

                        <a class="nav-link mb-3 p-3 shadow" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            <i class="fa fa-calendar-minus-o mr-2"></i>
                            <span class="font-weight-bold small text-uppercase"><i class="fa fa-building"></i> Join Companny</span></a>

                        <a class="nav-link mb-3 p-3 shadow" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                            <i class="fa fa-file"></i>
                            <span class="font-weight-bold small text-uppercase">File</span></a>
                    </div>
                </div>


                <div class="col-md-9">
                    <form action="{{ route('hrd.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <!-- Tabs content -->
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <h4 class="font-italic mb-4">Personal information</h4>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">NIK (No Induk Kependudukan)</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" name="nik" class="form-control" value='{{old('nik', $data->nik)}}'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">NPWP</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" name="npwp" class="form-control" value='{{old('npwp', $data->npwp)}}'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Nama</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" value='{{old('name', $data->name)}}'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Phone</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="phone" value='{{old('phone', $data->phone)}}'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Email</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" value='{{old('email', $data->email)}}'>
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
                                    <label for="">Status TK/K</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="status_tk" value='{{old('status_tk', $data->status_tk)}}'>
                                    <span class="text-muted text-small">Jika lajang TK, Menikah K.</span>
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
                                    <input type="date" class="form-control" name="date_birth" value="{{ old('date_birth', $data->date_birth) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Nomor Darurat (keluarga)</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="no_emergency" value="{{ old('no_emergency', $data->no_emergency) }}">
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
                                    <input type="text" class="form-control" name="from_institute" value="{{ old('from_institute', $data->from_institute) }}">
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
                        </div>

                        <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <h4 class="font-italic mb-4">Joined</h4>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Nomor Induk Karyawan</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="employee_number" value="{{ old('employee_number', $data->employee_number) }}" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Jabatan</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="position" value="{{ old('position', $data->position) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Departemen</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="department" value="{{ old('department', $data->department) }}">
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
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Tanggal Mulai Kontrak</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="start_contract" value="{{ old('start_contract', $data->start_contract) }}" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Tanggal Berakhir Kontrak</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="end_contract" value="{{ old('end_contract', $data->end_contract) }}" >
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <h4 class="font-italic mb-4">File</h4>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">File Izasah</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="file_izasah" >
                                    <span class="info">leave blank if not change file</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">File KTP</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="file_ktp" >
                                    <span class="text-warning">leave blank if not change file</span>
                                </div>
                            </div>
                             <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">File Certificate</label>
                                </div>
                                <div class="col-sm-9">
                                       <input type="file"
                                        class="form-control"
                                        name="certificate[]"
                                        max="10"
                                        multiple="multiple"
                                        accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*">
                                    <span class="text-warning">leave blank if not change file</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="padding-top: 40px">
                    <a href="{{ route('hrd.index') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <button class="btn btn-primary" id="btn_upload">Update <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
</section>
@endsection
