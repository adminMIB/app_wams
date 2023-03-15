@extends('layouts.main')

@section('title', 'Detail Karyawan - ' . $data->name)

@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">
            <div class="alert">
                <h2 class="text-capitalize">
                    <a href="{{ route('hrd.index') }}"><i class="fa fa-arrow-left"></i></a>
                    Detail Data Karyawan - {{ $data->name }}
                </h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Personal information</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <td>Nama</td>
                                <td>{{ $data->name }}</td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>{{ $data->nik }}</td>
                            </tr>
                            <tr>
                                <td>NPWP</td>
                                <td>{{ $data->npwp }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ ucfirst($data->status) }}</td>
                            </tr>
                            <tr>
                                <td>Status TK/K</td>
                                <td>{{ ucfirst($data->status) }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>{{ $data->gender == 'L' ? "Laki-Laki" : "Perempuan"; }}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>{{ $data->religion }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>{{ $data->date_birth }}</td>
                            </tr>
                            <tr>
                                <td>Asal institute</td>
                                <td>{{ $data->from_institute }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $data->phone }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $data->email }}</td>
                            </tr>
                            <tr>
                                <td>No Darurat (Keluarga)</td>
                                <td>{{ $data->no_emergency }}</td>
                            </tr>
                            <tr>
                                <td>Skills</td>
                                <td>
                                    <p>{{ $data->skills }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>{{ $data->address }}</td>
                            </tr>
                        </table>
                    </div>

                    <hr>
                    <h5>Join Company</h5>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <td>No Induk Karyawan</td>
                                <td>{{ $data->employee_number }}</td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>{{ $data->position }}</td>
                            </tr>
                            <tr>
                                <td>Departemen</td>
                                <td>{{ $data->department }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Masuk</td>
                                <td>{{ $data->joined }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Mulai Kontrak</td>
                                <td>{{ $data->start_contract }}</td>
                            </tr>
                             <tr>
                                <td>Tanggal Berakhir Kontrak</td>
                                <td>{{ $data->end_contract }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>File</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <td>File Izasah</td>
                                <td>
                                    <a href="{{ public_path("hrd_file/file/$data->file_izasah") }}" download>Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td>File KTP</td>
                                <td>
                                    <a href="{{ public_path("hrd_file/file/$data->ktp") }}" download>Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td>File Certificate</td>
                                <td>
                                    <ul>
                                        @foreach ($certificate as $item)
                                            <li><a href="{{ public_path("hrd_file/$item->name") }}" download>Download</a></li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
