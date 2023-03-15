@extends('layouts.main')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div style="float: right">
                    <button class="btn btn-success ml-2" onclick="tableToExcel('RevCost')">Export</button>
                </div>
                <h2>Report Transaction Maker</h2>
            </div>
            <div class="card-body" id="RevCost">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Project ID</th>
                            <th scope="col">Information</th>
                            <th scope="col">Debit</th>
                            <th scope="col">Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_penerimaan = 0;
                        $total_pengeluaran = 0;
                        $total = 0;
                        $hasil = 0;
                            foreach ($sawal->detailtmrevcost as $item){
                                ?>
                        <tr>
                            @if (!$item->tanggal_penerimaan)
                            <td>{{ $item->tanggal_pengeluaran }}</td>
                            @else
                            <td>{{ $item->tanggal_penerimaan }}</td>
                            @endif
                            <td>{{ $item->project_id }}</td>
                            <td>{{ $item->keterangan }}</td>
                            @if ($item->penerimaan_project)
                            <td>{{ $item->penerimaan_project }}</td>
                            @else
                            <td></td>
                            @endif
                            @if ($item->pengeluaran_project)
                            <td>{{ $item->pengeluaran_project }}</td>
                            @else
                            <td></td>
                            @endif
                        </tr>
                        <?php
                                $total_penerimaan +=$item->penerimaan_project;
                                $total_pengeluaran += $item->pengeluaran_project;
                                $total = $total_penerimaan - $total_pengeluaran;
                                $hasil = $sawal->jumlah_saldo - $total;
                            }
                        ?>
                        <tr>
                            <td colspan="2"></td>
                            <th>Total</th>
                            <th>{{ $total_penerimaan }}</th>
                            <th>{{ $total_pengeluaran }}</th>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered w-50" style="float: right">
                    <tr>
                        <td>Saldo Awal</td>
                        <th class="text-end">
                            {{ $sawal->jumlah_saldo }}
                        </th>
                    </tr>
                    <tr>
                        <td>Status Saldo</td>
                        <th class="text-end">{{ $total }}</th>
                    </tr>
                    <tr>
                        <td>Saldo Saat Ini</td>
                        <th class="text-end">{{ $hasil }}</th>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                {{-- <a href="{{ route('delete-TMRevCost') }}" class="btn btn-danger">Clear</a> --}}
                <a href="{{ route('index-saldo') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </section>

    
@endsection
@section('js')
<script src="{{ asset('assets/js/export_exel.js') }}"></script>
@endsection

