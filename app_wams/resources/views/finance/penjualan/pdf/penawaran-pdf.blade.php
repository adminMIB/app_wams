<html>
    <head>
        <title>PDF</title>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="">
            <table>
                <tr>
                    <td style="width: 160px;">
                        <img style="height: 100px; width: 143px; font-weight:bold;" src="https://mitraintibersama.com/assets/img/logo-mib.png">
                    </td>
                    <div style="margin-right: 40px;"></div>
                    <td style="width: 400px;">
                        <h3>PT. MITRA INTI BERSAMA</h3>
                        <p style="font-size: 13px">Jl. Raya Kota Wisata Ruko Oregon Blok TCR No.33 Kel. Ciangsana Kec. Gn. Putri Kab. Bogor Jawa Barat 16968 Indonesia</p>
                    </td>
                </tr>
            </table>
            <div style="float: right;">
                <div style="text-align: center;">
                    <label for="" style="font-size: 20px;">Pesanan Penjualan</label>
                </div>
                <table style="border: 1px solid black; border-collapse: collapse;width: 360px; margin-right: 120px;">
                    <tr>
                        <td style="border-right: 1px solid black;font-size: 13px">Tanggal</td>
                        <td style="font-size: 13px">Nomor</td>
                    </tr>
                    <tr>
                        <th style="border-bottom: 1px solid black;font-size: 13px">{{ date('d/m/Y') }}</th>
                        <th style="border-bottom: 1px solid black;border-left: 1px solid black;font-size: 13px">{{ $shorder->no_pesanan }}</th>
                    </tr>
                    <tr>
                        <td style="border-right: 1px solid black;font-size: 13px">Syarat Pembayaran</td>
                        <td style="font-size: 13px">FOB</td>
                    </tr>
                    <tr>
                        <th style="border-bottom: 1px solid black;font-size: 13px">{{ $shorder->syarat_pembayaran }}</th>
                        <th style="border-bottom: 1px solid black;border-left: 1px solid black;font-size: 13px">{{ $shorder->FOB }}</th>
                    </tr>
                    <tr>
                        <td style="border-right: 1px solid black;font-size: 13px">Ekspedisi</td>
                        <td style="font-size: 13px">Tanggal Pengiriman</td>
                    </tr>
                    <tr>
                        <th style="border-bottom: 1px solid black;font-size: 13px"></th>
                        <th style="border-bottom: 1px solid black;border-left: 1px solid black;font-size: 13px">{{ date('d M Y', strtotime($shorder->tgl_pengiriman)) }}</th>
                    </tr>
                    <tr>
                        <td style="border-right: 1px solid black;font-size: 13px">PO No</td>
                        <td style="font-size: 13px">Penjual</td>
                    </tr>
                    <tr>
                        <th style="font-size: 13px">{{ $shorder->nopo }}</th>
                        <th style="border-left: 1px solid black;font-size: 13px"></th>
                    </tr>
                </table>
            </div>
            <div style="width: 320px;height: 200px;">
                <div style="border-top: 1px solid black; border-bottom: 1px solid black; padding-bottom: 5px;">
                    <label for="" style="font-size: 13px">Kepada</label>
                </div>
                <p style="font-size: 12px"><b>{{ $shorder->nama_client }}</b></p>
                <p style="font-size: 12px">{{ $shorder->alamat }}
                </p>
            </div>
            <div>
                <table style="border: 1px solid; border-collapse:collapse; width: 100%;">
                    <tr>
                        <th style="border: 1px solid;font-size: 13px">No</th>
                        <th style="border: 1px solid;font-size: 13px">Nama Barang</th>
                        <th style="border: 1px solid;font-size: 13px;">Kts.</th>
                        <th style="border: 1px solid;font-size: 13px;">@Harga</th>
                        <th style="border: 1px solid;font-size: 13px;">Diskon</th>
                        <th style="border: 1px solid;font-size: 13px;">Total Harga</th>
                    </tr>
                    {{-- @foreach ($shorder->barang as $item)
                    <tr>
                        <td style="border: 1px solid;font-size: 13px">{{ $loop->iteration }}</td>
                        <td style="border: 1px solid;font-size: 13px">{{ $item->nama_barang }}</td>
                        <td style="border: 1px solid;font-size: 13px;text-align:right;">{{ $item->kuantitas }}</td>
                        <td style="border: 1px solid;font-size: 13px;text-align:right;">{{ $item->hargakuan }}</td>
                        <td style="border: 1px solid;font-size: 13px;text-align:right;">{{ $item->diskon }}</td>
                        <td style="border: 1px solid;font-size: 13px;text-align:right;">{{ $item->total_harga }}</td>
                    </tr>
                    @endforeach --}}
                    <?php
                        $totalppn = 0;
                        $totalharga = 0;
                        $totaldiskon = 0;
                        $total = 0;
                        $no = 1;

                        foreach ($shorder->barang as $items) {
                            ?>
                            <tr>
                                <td style="border: 1px solid;">{{ $no++ }}</td>
                                <td style="border: 1px solid;">{{ $items->nama_barang }}</td>
                                <td style="border: 1px solid;">{{ $items->kuantitas }}</td>
                                <td style="border: 1px solid;">{{ number_format($items->harga) }}</td>
                                <td style="border: 1px solid;">{{ $items->diskon }}</td>
                                <td style="border: 1px solid;">{{ number_format($items->total_harga) }}</td>
                            </tr>
                        <?php

                            $totalharga += $items->total_harga;
                            $totalppn += $items->total_ppn;
                            $totaldiskon += $items->total_diskon;
                            $total = $totalharga + $totalppn;
                        }
                        ?>
                </table>
            </div>
            <table style="margin-top: 20px">
                <tr>
                    <td>Terbilang</td>
                    <td style="width: 20px;">:</td>
                    <td style="border: 1px solid black; width: 600px;">{{ Terbilang::angka($totalharga) }}</td>
                </tr>
            </table>

            <table style="width: 300px;float: right;margin-top: 5px;">
                <tr>
                    <td style="border: 1px solid black; width: 150px;">Sub Total</td>
                    <td style="border: 1px solid black;">{{ number_format($totalharga) }}</td>
                </tr>
                {{-- <tr>
                    <td style="border: 1px solid black; width: 150px;">Diskon</td>
                    <td style="border: 1px solid black;">{{ number_format($totaldiskon) }}</td>
                </tr> --}}
                <tr>
                    <td style="border: 1px solid black; width: 150px;">PPN (11%)</td>
                    <td style="border: 1px solid black;">{{ number_format($totalppn) }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; width: 150px;">Biaya Lain-lain</td>
                    <td style="border: 1px solid black;">0</td>
                </tr>
                <tr>
                    <th style="border: 2px solid black; width: 150px;">Total After Tax</th>
                    <th style="border: 2px solid black;">{{ number_format($total) }}</th>
                </tr>
            </table>

            <div style="">
                <div style="width: 350px;">
                    <fieldset style="border: 1px solid #000;height: 70px;">
                        <legend>Keterangan</legend>
                        <textarea style="border: none;height:auto;font-size: 12px;">{{ $shorder->keterangan }}</textarea>
                    </fieldset>
                </div>

                <div style="width: 200px; margin-top: 5px;">
                    <div style="text-align:center;"><label for="">Disetujui,</label></div>
                    <div style="border-bottom: 1px solid;height: 80px;"></div>
                    <label for="">Tgl.</label>
                </div>
            </div>
        </div>
    </body>
</html>