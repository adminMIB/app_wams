@extends('layouts.app')

@section('title', 'Detail Project ' . $project['project'])

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('js/pages/project-detail.js') }}"></script>
@endsection

@section('page-style')
<style>
    .select2-container {
        z-index: 2050 !important;
    }
</style>
@endsection

@push('js')
@if (session('message'))
<script>
    $(document).ready(function() {
        $('#toast-body').text('{{ session('
            message ') }}');
        $('#session-toast').toast('show');
    });
</script>
@endif

@if (session('error'))
<script>
    $(document).ready(function() {
        $('#toast-danger').text('{{ session('
            error ') }}');
        $('#error-toast').toast('show');
    });
</script>
@endif
@endpush

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0">
                <a href="/project" style="display: flex; align-items: center;">
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
                        <a href="javascript:void(0);">Projects</a>
                    </li>
                    <li class="breadcrumb-item active">Detail {{ $project['project'] }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h6>Detail Project {{ $project['project'] }}</h6>
    </div>
    <div class="card-body">
        <table class="table borderless">
            <tbody>
                @foreach ($project as $key => $value)
                @if ($key !== 'id')
                <tr>
                    <td>{{ strtoupper(str_replace('_', ' ', $key)) }}</td>
                    <td>:</td>
                    <td>
                        @if ($key == 'file')
                        @if (!empty($value))
                        <a href="/uploads/projects/{{ $value }}" download>Lihat File</a>
                        @else
                        <h6>Tidak ada file</h6>
                        @endif
                        @elseif ($key == 'component')
                        @if (!empty($value))
                        @foreach ($value as $item)
                        <span class="badge bg-label-primary mr-2">{{ ucwords(str_replace('_', ' ', $item)) }}</span>
                        @endforeach
                        @else
                        <h6>Tidak menggunakan component</h6>
                        @endif
                        @else
                        {{ $value }}
                        @endif
                    </td>
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
            <h6>Transaction Maker</h6>
            @can('create')
            <button class="btn btn-primary btn-md" onclick="add_project_maker({{ $project['id'] }})">
                Tambah Data <i class="ti ti-plus"></i>
            </button>
            @endcan
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-responsive table-bordered">
                <thead>
                    <th>Tanggal Transaksi</th>
                    <th>Jenis Transaksi</th>
                    <th>Nama Tujuan</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Komponen</th>
                    <th>File</th>
                    <th>dibuat pada</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @forelse ($data_tm as $tm)
                    <tr>
                        <td>{{ $tm->tanggal }}</td>
                        <td>{{ strtoupper($tm->jenis_transaksi) }}</td>
                        <td>{{ ucwords($tm->nama_tujuan) }} </td>
                        <td>Rp. {{ number_format($tm->nominal) }}</td>
                        <td>{{ \App\Models\ProjectMaker::getKetLabel($tm->keterangan) }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $tm->category)) }}</td>
                        <td>
                            <ul>
                                <li>
                                    File : <br>
                                    @if (!empty($tm->file))
                                    <a href="/uploads/projects-maker/{{ $tm->file }}" download>Download</a>
                                    @else
                                    Tidak ada file
                                    @endif
                                </li>
                            </ul>
                        </td>
                        <td>
                            {{ empty($tm->created_at) ? '-' : \Carbon\Carbon::parse($tm->created_at)->format('Y-m-d') }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @can('update')
                                <button type="button" class="btn btn-md btn-icon me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-dark" data-bs-original-title="Edit Data" onclick="edit_project_maker({{ $tm->id }})">
                                    <i class="ti ti-edit"></i>
                                </button>

                                <button type="button" class="btn btn-md btn-icon me-2 move" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-dark" data-project="{{ $project['id'] }}" data-id="{{ $tm->id }}" data-bs-original-title="Pindah Data">
                                    <i class="ti ti-replace"></i>
                                </button>
                                @endcan

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <p><strong>Total Advance : Rp. {{ number_format($sum_tm) }}</strong> </p>
            <p><strong>Sisa : Rp. {{ number_format($total_usage) }}</strong></p>
        </div>
    </div>
</div>

{{-- toast --}}
<div class="bs-toast toast toast-ex animate__animated my-2" id="session-toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
    <div class="toast-header">
        <i class="ti ti-bell ti-xs me-2 text-success"></i>
        <div class="me-auto fw-medium" id="toast-title">Success</div>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toast-body"></div>
</div>

{{-- error toast --}}
<div class="bs-toast toast toast-ex animate__animated my-2" id="error-toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
    <div class="toast-header">
        <i class="ti ti-bell ti-xs me-2 text-danger"></i>
        <div class="me-auto fw-medium" id="toast-title">Error</div>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toast-danger"></div>
</div>


{{-- modal add edit --}}
<div class="modal fade" id="modalMaker" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-3 p-md-2">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-4" id="title-detail">title</h3>
                </div>

                <div id="content"></div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.projects.modal.move')

@endsection