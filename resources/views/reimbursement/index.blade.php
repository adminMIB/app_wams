@extends('layouts.app')

@section('title', 'Reimbursement')

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
@endsection

@section('page-script')
    <script>
        var canViewseimbursement = @json($canViewseimbursement);
        var canCreateReimbursement = @json($canCreateReimbursement);
        var canEditReimbursement = @json($canEditReimbursement);
        var canDeleteReimbursement = @json($canDeleteReimbursement);
        var canApprovelReimbursement = @json($canApprovelReimbursement);
    </script>
    <script src="{{ asset('js/pages/reimbursement.js') }}"></script>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Reimbursement</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Reimbursement</a>
                        </li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-reimbursement table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th></th>
                        <th>Id Reimbursements</th>
                        <th>Nama Project</th>
                        <th>Pic Bussines Channel</th>
                        <th>Customer</th>
                        <th>Keterangan</th>
                        <th>Created Date</th>
                            <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- D:\app\mib-2024\acdc\wams-acdc\resources\views\reimbursement\modal\add-edit.blade.php -->
    <!-- set up design modal -->
    @include('reimbursement.modal.add-edit')
    @include('dashboard.master-data.personelTeams.modal.detail')
@endsection
