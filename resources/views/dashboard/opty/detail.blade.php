@extends('layouts.app')

@section('title', 'Detail Opty ' . $opty['project'])

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
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
                        <tr>
                            <td>{{ strtoupper(str_replace('_', ' ', $key)) }}</td>
                            <td>:</td>
                            @if ($key == 'file')
                                <td><a href="/uploads/opty/{{ $value }}" download>Lihat File</a></td>
                            @else
                                <td>{{ $value }}</td>
                            @endif
                        </tr>
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
                <button class="btn btn-primary btn-md" id="addData">
                    Add Maker <i class="ti ti-plus me-md-1"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Tanggal Transaksi</th>
                        <th>Jenis Transaksi</th>
                        <th>Nama Penerima</th>
                        <th>Nominal Transaksi</th>
                        <th>Keterangan</th>
                        <th>File</th>
                        <th>Dibuat Pada</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('dashboard.opty.modal.addEdit-maker')
@endsection
