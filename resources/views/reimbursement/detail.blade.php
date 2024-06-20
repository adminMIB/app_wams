@extends('layouts.app')

@section('title', 'Detail Reimbursement ' . $reimbursement['nama_project'])

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

@endsection

@section('page-script')
    <script src="{{ asset('js/pages/reimbursement-maker.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.nominal').mask('000.000.000.000.000', {
                reverse: true
            });
        });
    </script>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <a href="/reimbursement" style="display: flex; align-items: center;">
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
                            <a href="javascript:void(0);">Reimbursement</a>
                        </li>
                        
                        <li class="breadcrumb-item active">Detail {{ $reimbursement['nama_project'] }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <h6>Detail Reimbursement {{ $reimbursement['nama_project'] }}</h6>
        </div>
        <div class="card-body">
            <table class="table borderless">
                <tbody>
                    @foreach ($reimbursement as $key => $value)
                        <tr>
                            <td>{{ strtoupper(str_replace('_', ' ', $key)) }}</td>
                            <td>:</td>
                            @if ($key == 'file')
                                <td><a href="/uploads/reimbursements/{{ $value }}" download>Lihat File</a></td>
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
                <h6>List Transaction Maker Reimbursement </h6>
                <input type="hidden" id="rembursement_id_detail" name="rembursement_id_detail" value="{{ $reimbursement['id'] }}">
                <!-- <button class="btn btn-primary btn-md" id="addData">
                    Add Maker <i class="ti ti-plus me-md-1"></i>
                </button> -->
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-reimbursement-maker table border-top">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th></th>
                                <th>Tanggal</th>
                                <th>Nama PIC</th>
                                <th>Nominal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="mt-4">
            <h6 class="total-advance-reimbuersement-maker"></h6>
            </div>
        </div>
    </div>

    @include('reimbursement.modalMaker.add-edit')
    @include('reimbursement.modalMaker.pindah-data')
@endsection
