@extends('layouts.app')

@section('title', 'Detail Opty ' . $opty['project'])

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.min.js"
        integrity="sha512-hAJgR+pK6+s492clbGlnrRnt2J1CJK6kZ82FZy08tm6XG2Xl/ex9oVZLE6Krz+W+Iv4Gsr8U2mGMdh0ckRH61Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('page-script')
    <script src="{{ asset('js/pages/opty-detail.js') }}"></script>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <a href="/opty" style="display: flex; align-items: center;">
                        <i class="ti ti-arrow-left" style="margin-right: 5px;"></i>
                        <span>Back</span>
                    </a>
                </h6>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Opty</a>
                        </li>
                        <li class="breadcrumb-item active">Detail {{ $opty['project'] }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <h6>Detail Opty {{ $opty['project'] }}</h6>
        </div>
        <div class="card-body">
            <table class="table borderless">
                <tbody>
                    @foreach ($opty as $key => $value)
                        @if ($key !== 'is_moved')
                            <tr>
                                <td>{{ strtoupper(str_replace('_', ' ', $key)) }}</td>
                                <td>:</td>
                                @if ($key == 'file')
                                    <td><a href="/uploads/opty/{{ $value }}" download>Lihat File</a></td>
                                @else
                                    <td>{{ $value }}</td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <hr>

    <div class="card">

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h6>List Transaction Maker Opty</h6>
                @if($opty['is_moved'] === false)
                    <button class="btn btn-primary btn-md" id="addData">
                        Add Maker <i class="ti ti-plus me-md-1"></i>
                    </button>
                @endif
            </div>
        </div>
        <div class="card-body">

            <div class="container mt-3">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <span class="text-center">{!! session('success') !!}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <span class="text-center">{!! session('error') !!}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>No.</th>
                        <th>Nama Penerima</th>
                        <th>Jenis Transaksi</th>
                        <th>Nominal Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Keterangan</th>
                        <th>Komponen</th>
                        <th>File</th>
                        @if ($opty['is_moved'] === false)
                            <th>Action</th>
                        @endif
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @inject('carbon', 'Carbon\Carbon')
                        @forelse ($optyMaker as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ ucfirst($row->nama_penerima) }}</td>
                                <td>{{ ucfirst($row->jenis_trx) }}</td>
                                <td>Rp. {{ number_format($row->nominal_trx) }}</td>
                                <td>{{ $carbon->parse($row->date_trx)->format('Y-m-d') }}</td>
                                <td>{{ \App\Models\OptyMaker::getKetLabel($row->keterangan) }} </td>
                                <td>{{ ucwords(str_replace('_', ' ', $row->category)) }} </td>
                                <td>
                                    @if (!empty($row->file))
                                        <a href="/uploads/opty-maker/{{ $row->file }}" download>Lihat File</a>
                                    @else
                                        Tidak ada file
                                    @endif
                                </td>
                                @if ($opty['is_moved'] === false)
                                <td>
                                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Edit Data" class="edit_data" data-id="{{ $row->id }}">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('dashboard.opty.modal.addEdit-maker')
@endsection
