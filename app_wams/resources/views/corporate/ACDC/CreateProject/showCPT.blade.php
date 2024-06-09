@extends('layouts.main')

@section('title', "Detail Project $cpt->project_name")

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="card">
                <div class="alert">
                    <h2 class="text-capitalize text-center">Detail Project {{ $cpt->project_name }} ({{ $cpt->id_project }})
                    </h2>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                {{-- <a href="" class="btn btn-secondary btn-sm mb-3">Back</a> --}}
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td>ID Project</td>
                        <td>:</td>
                        <td>{{ $cpt->id_project }}</td>
                    </tr>
                    <tr>
                        <td>Project</td>
                        <td>:</td>
                        <td>{{ $cpt->project_name }}</td>
                    </tr>
                    <tr>
                        <td>BMT Awal</td>
                        <td>:</td>
                        <td>Rp. {{ number_format($cpt->bmt) }}</td>
                    </tr>
                    <tr>
                        <td>WAPU</td>
                        <td>:</td>
                        <td>Rp. {{ number_format($cpt->wapu) }}</td>
                    </tr>
                    <tr>
                        <td>Services</td>
                        <td>:</td>
                        <td>Rp. {{ number_format($cpt->services) }}</td>
                    </tr>
                    <tr>
                        <td>SubTotal</td>
                        <td>:</td>
                        <td>Rp. {{ number_format($cpt->subtotal) }}</td>
                    </tr>
                    <tr>
                        <td>Bunga Admin</td>
                        <td>:</td>
                        <td>{{ number_format($cpt->bunga_admin) }} %</td>
                    </tr>
                    <tr>
                        <td>Biaya Admin</td>
                        <td>:</td>
                        <td>Rp. {{ number_format($cpt->biaya_admin) }}</td>
                    </tr>
                    <tr>
                        <td>Biaya Lain</td>
                        <td>:</td>
                        <td>Rp. {{ number_format($cpt->biaya_pengurangan) }}</td>
                    </tr>
                    <tr>
                        <td>Total Final</td>
                        <td>:</td>
                        <td>Rp. {{ number_format($cpt->total_final) }}</td>
                    </tr>
                    <tr>
                        <td>File</td>
                        <td>:</td>
                        @if (!empty($cpt->file))
                            <td><a href="/file_hitungan/{{ $cpt->file }}" download>Download</a></td>
                        @else
                            <td>Tidak ada file</td>
                        @endif
                    </tr>
                </table>

                <hr>

                <div class="pt-3 pb-3">
                    @if (auth()->user()->name !== 'Bona Napitupulu')
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm maker"
                            onclick="CreateTM({{ $cpt->id }})">
                            Transaction Maker <i class="fa fa-plus"></i>
                        </a>
                    @endif
                </div>
                <table class="table table-hover table-responsive table-bordered ">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis Transaksi</th>
                            <th>Nama Tujuan</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $nominal2 = 0;
                            $total_final2=0;
                            foreach($detail as $tm){
                            ?>
                        {{-- <a href="{{route('penawaran.edit',$i->id)}}">     --}}
                        <tr style="font-size: 13px;">
                            <td>{{ $tm->tanggal }}</td>
                            <td>{{ $tm->jenis_transaksi }} </td>
                            <td>{{ $tm->nama_tujuan }} </td>
                            <td>Rp. {{ number_format($tm->nominal) }}</td>
                            <td>{{ \App\Models\TransactionMakerACDC::getKetLabel($tm->keterangan) }}</td>
                            <td>
                                <ul>
                                    <li>
                                        File Request : <br>
                                        @if (!empty($tm->upload_request))
                                            <a href="/file_request/{{ $tm->upload_request }}" download>Download</a>
                                        @else
                                            Tidak ada file
                                        @endif
                                    </li>
                                    <li>
                                        File Release : <br>
                                        @if (!empty($tm->upload_release))
                                            <a href="/file_realese/{{ $tm->upload_release }}" download>
                                                Download
                                            </a>
                                        @else
                                            Tidak ada file
                                        @endif
                                    </li>
                                </ul>
                            </td>
                            @if (auth()->user()->name !== 'Bona Napitupulu')
                                <td>
                                    <a class="btn btn-warning" onclick="moveTM({{ $tm->id }})">Pindah Data</a>
                                    <a class="btn btn-primary" onclick="editTM({{ $tm->id }})">Edit Data</a>
                                </td>
                            @endif
                        </tr>
                        {{-- </a>     --}}
                        <?php

                            $nominal2 += $tm->nominal;
                            $total_final2 = $cpt->total_final - $nominal2;
                        }
                    ?>
                    </tbody>
                </table>

                <p>Total Advance : Rp. {{ number_format($nominal2) }} </p>
                <p>Sisa : Rp. {{ number_format($total_final2) }}</p>

                <a href="{{ route('indexCPT') }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('export-acdc', ['id' => $cpt->id]) }}" class="btn btn-success">
                    Export <i class="fa fa-print"></i>
                </a>
            </div>
        </div>
        <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="page" class="p-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function moveTM(id) {
            $.get("{{ url('editTM') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Pindah data')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        function editTM(id) {
            $.get("{{ url('editTransactionMaker') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Edit data')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        function CreateTM(id) {
            $.get("{{ url('createTM') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Transaction Maker')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }
    </script>
@endsection
