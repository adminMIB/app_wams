@extends('layouts.main')

@section('title', "Detail Project $data->project_name")


@section('content')
    <section class="section">
        <div class="section-header" style="padding-bottom: 30px">
            <div class="card">
                <div class="alert">
                    <h2 class="text-capitalize pl-3 text-center">
                        Detail Project {{ $data->project_name }} ({{ $data->code_opty }})
                    </h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td>ID Opty</td>
                            <td>:</td>
                            <td>{{ $data->code_opty }}</td>
                        </tr>
                        <tr>
                            <td>Nama Projek</td>
                            <td>:</td>
                            <td>{{ $data->project_name }}</td>
                        </tr>
                        <tr>
                            <td>Nama Account Manager</td>
                            <td>:</td>
                            <td>{{ $data->account_manager }}</td>
                        </tr>
                        <tr>
                            <td>Nama Perusahaan</td>
                            <td>:</td>
                            <td>{{ $data->company_name }}</td>
                        </tr>
                        <tr>
                            <td>NPWP Perusahaan</td>
                            <td>:</td>
                            <td>{{ $data->no_npwp }}</td>
                        </tr>
                        <tr>
                            <td>Alamat Perusahaan</td>
                            <td>:</td>
                            <td>{{ $data->address }}</td>
                        </tr>
                        <tr>
                            <td>Nama PIC</td>
                            <td>:</td>
                            <td>{{ $data->pic_name }}</td>
                        </tr>
                        <tr>
                            <td>No Telp PIC</td>
                            <td>:</td>
                            <td>{{ $data->phone_pic }}</td>
                        </tr>
                        <tr>
                            <td>Email PIC</td>
                            <td>:</td>
                            <td>{{ $data->email_pic }}</td>
                        </tr>
                        <tr>
                            <td>Nominal Penawaran</td>
                            <td>:</td>
                            <td>{{ $data->nominal }}</td>
                        </tr>
                        <tr>
                            <td>No Penawaran</td>
                            <td>:</td>
                            <td>{{ $data->no_penawaran }}</td>
                        </tr>
                        <tr>
                            <td>File</td>
                            <td>:</td>
                            @if (!empty($data->file))
                                <td><a href="/file_hitungan/{{ $data->file }}" download>Download</a></td>
                            @else
                                <td>Tidak ada file</td>
                            @endif
                        </tr>
                    </table>

                    <hr style="margin-top: 20px">

                    <h3 style="margin-top: 20px">Transaction Maker</h3>
                    <div class="container" style="text-align: right">
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-id="{{ $data->id }}" id="addMaker">
                            Tambah Data
                        </a>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <th>No</th>
                            <th>Nama Penerima</th>
                            <th>Jenis Transaksi</th>
                            <th>Nominal Transaksi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @inject('carbon', 'Carbon\Carbon')
                            @forelse($opty_trx as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->nama_penerima }}</td>
                                    <td>{{ $row->jenis_trx }}</td>
                                    <td>Rp. {{ number_format($row->nominal_trx) }}</td>
                                    <td>{{ $carbon->parse($row->date_trx)->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah Data"
                                            class="edit_data" data-id="{{ $row->id }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <a href="/project-opty-acdc" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ubahOrAdd" tabindex="-1" aria-labelledby="title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title">Edit Data</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="updateOrCreateForm" method="POST">
                            @csrf
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal
                                    Transaksi</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="date" class="form-control" name="date_trx" id="date_trx"
                                        placeholder="Tanggal Transaksi" autocomplete="Off" required>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Transaksi</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="jenis_trx" id="jenis_trx"
                                        placeholder="Jenis Transaksi" autocomplete="Off" required>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Penerima</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="nama_penerima" id="nama_penerima"
                                        placeholder="Nama Penerima" autocomplete="Off" required>
                                    <p class="text-danger">{{ $errors->first('nama_penerima') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nominal
                                    Transaksi</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control uang" id="nominal_trx" name="nominal_trx"
                                            min=1 required autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan Kode Akun</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control select2" name="keterangan" id="keterangan" required style="width: 100%">
                                        <option value="">----PILIH----</option>
                                        <option value="1">HPP</option>
                                        <option value="2">Biaya BMT</option>
                                        <option value="3">Fotocopy/Jilid</option>
                                        <option value="4">Materai</option>
                                        <option value="5">Biaya Pengiriman Dokumen</option>
                                        <option value="6">Biaya Jaminan Asuransi</option>
                                        <option value="7">Biaya Sertifikat Tenaga Ahli</option>
                                        <option value="8">Biaya Training</option>
                                        <option value="9">Entertain</option>
                                        <option value="10">Tiket</option>
                                        <option value="11">Hotel</option>
                                        <option value="12">Sewa Mobil</option>
                                        <option value="13">Uang Dinas</option>
                                        <option value="14">Denda/Pinalty</option>
                                        <option value="15">Biaya Lain-Lain</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('keterangan') }}</p>
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="close">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.min.js"
        integrity="sha512-hAJgR+pK6+s492clbGlnrRnt2J1CJK6kZ82FZy08tm6XG2Xl/ex9oVZLE6Krz+W+Iv4Gsr8U2mGMdh0ckRH61Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('.uang').mask('000.000.000.000.000', {
                reverse: true
            });

            $("#addMaker").on("click", function () {
                var id = $(this).attr("data-id");
                $('#updateOrCreateForm').attr('action', `/opty-maker/${id}`);

                $("#title").text("Tambah Data")

                $("#ubahOrAdd").modal("show")
            })

            $("#close").on("click", function() {
                $('#updateOrCreateForm').trigger("reset");
                $("#keterangan").select2("val", "")
                $("#ubahOrAdd").modal("hide")

            })

            $(document).on("click", ".edit_data", function() {
                var id = $(this).attr("data-id");
                $('#updateOrCreateForm').attr('action', `/project-opty-acdc/maker/update/${id}`);

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.get(`/opty-maker/${id}`, function(data, status) {
                    $("#title").text("Edit Data")
                    $("#date_trx").val(data.date_trx)
                    $("#jenis_trx").val(data.jenis_trx)
                    $("#nama_penerima").val(data.nama_penerima)
                    $("#nominal_trx").val(data.nominal_trx)
                    $("#keterangan").select2("val", data.keterangan)
                    $("#ubahOrAdd").modal("show")
                })
            });
        });
    </script>
@endsection
