<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
                        <img style="height: 100px; width: 143px;" src="https://mitraintibersama.com/assets/img/logo-mib.png">
                    </td>
                    <td style="width: 450px;">
                        <h3 class="text-start">PT. MITRA INTI BERSAMA</h3>
                        <p class="text-start text-sm">Jl. Raya Kota Wisata Ruko Oregon Blok TCR No.33 Kel. Ciangsana Kec. Gn. Putri Kab. Bogor Jawa Barat 16968 Indonesia</p>
                    </td>
                    <td>
                        <div class="px-2 py-1" style="background-color: rgb(55 48 163); font-weight:bold; color: white;">INVOICE</div>
                    </td>
                </tr>
            </table>
            <div style="border-bottom: 1px solid black; margin-top: 20px;"></div>

            <table style="float: right; margin-right: 20px;">
                <tr>
                    <td style="width: 100px;">Invoice No.</td>
                    <td style="width: 20px;">:</td>
                    <td>{{ $shorder->no_faktur }}</td>
                </tr>
                <div style="height: 5px;"></div>
                <tr class="mt-2">
                    <td style="width: 100px;">Date</td>
                    <td style="width: 20px;">:</td>
                    <td>{{ date('d M Y', strtotime($shorder->tgl_pesanan)) }}</td>
                </tr>
                <div style="height: 5px;"></div>
                <tr>
                    <td style="width: 100px;">Customer PO</td>
                    <td style="width: 20px;">:</td>
                    <td>{{ $shorder->no_po }}</td>
                </tr>
                <div style="height: 5px;"></div>
                <tr>
                    <td style="width: 100px;">End User</td>
                    <td style="width: 20px;">:</td>
                    <td>{{ $shorder->end_user }}</td>
                </tr>
                <div style="height: 35px;"></div>
                <tr>
                    <td style="width: 100px;">Terms</td>
                    <td style="width: 20px;">:</td>
                    <td>{{ $shorder->syarat_pembayaran }}</td>
                </tr>
                <div style="height: 5px;"></div>
                <tr>
                    <td style="width: 100px;">Due Date</td>
                    <td style="width: 20px;">:</td>
                    <td>19 okt 2022</td>
                </tr>
            </table>

            <div>
                <table style="width: 350px;">
                    <tr>
                        <td>To :</td>
                    </tr>
                    <tr>
                        <td>
                            <b>{{ $shorder->nama_client }}</b><br>
                            {{ $shorder->alamat }}
                        </td>
                    </tr>
                </table>
                <div style="height: 5px;"></div>
                <table class="mt-2">
                    <tr>
                        <td style="width: 100px;">Phone</td>
                        <td style="width: 20px;">:</td>
                        <td>{{ $shorder->phone }}</td>
                    </tr>
                    <div style="height: 5px;"></div>
                    <tr>
                        <td style="width: 100px;">NPWP</td>
                        <td style="width: 20px;">:</td>
                        <td>{{ $shorder->npwp }}</td>
                    </tr>
                    <div style="height: 5px;"></div>
                    <tr>
                        <td style="width: 100px;">Attn.</td>
                        <td style="width: 20px;">:</td>
                        <td>{{ $shorder->attention }}</td>
                    </tr>
                </table>
            </div>

            <div style="margin-top: 20px;">
                <label for="">Keterangan :</label>
                <p>{{ $shorder->keterangan }}</p>
            </div>
            

            <table class="table table-bordered text-center" style="margin-top: 20px;">
                <thead>
                <tr>
                    <th style="border: 1px solid;">No.</th>
                    <th style="border: 1px solid;">Description</th>
                    <th style="border: 1px solid;">Qty</th>
                    <th style="border: 1px solid;">Unit Price</th>
                    <th style="border: 1px solid;">Total Amount</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $totalppn = 0;
                        $totalharga = 0;
                        $totaldiskon = 0;
                        $total = 0;
                        $no = 1;

                        foreach ($shorder->fakturpembelian as $items) {
                            ?>
                            <tr>
                                <td style="border: 1px solid;">{{ $no++ }}</td>
                                <td style="border: 1px solid;">{{ $items->nama_barang }}</td>
                                <td style="border: 1px solid;">{{ $items->kuantitas }}</td>
                                <td style="border: 1px solid;">{{ number_format($items->harga) }}</td>
                                <td style="border: 1px solid;">{{ number_format($items->hargakuan) }}</td>
                            </tr>
                        <?php

                            $totalharga += $items->hargakuan;
                            $totalppn += $items->total_ppn;
                            $totaldiskon += $items->total_diskon;
                            $total = $totalharga - $totaldiskon + $totalppn;
                        }
                        ?>
                </tbody>
            </table>
            <div style="border-bottom: 1px solid black; margin-top: 20px;"></div>

            <table class="mt-3">
                <tr>
                    <td>Terbilang</td>
                    <td style="width: 20px;">:</td>
                    <td style="border: 1px solid black; width: 609px;">{{ Terbilang::angka($totalharga) }}</td>
                </tr>
            </table>

            <table class="text-center mt-4" style="float: left;">
                <tr>
                    <td style="text-decoration: underline; font-weight: bold;font-size: 15px;">PAYMENT INTRUCTION</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; font-size: 13px;">PT. Mitra Inti Bersama</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; font-size: 14px;margin-left: 5px;">{{ $shorder->bank }}</td>
                </tr>
            </table>

            <table style="width: 300px;float: right;margin-top: 20px;">
                <tr>
                    <td class="text-left" style="border: 1px solid black; width: 150px;">Sub Total</td>
                    <td class="text-end" style="border: 1px solid black;">{{ number_format($totalharga) }}</td>
                </tr>
                <tr>
                    <td class="text-left" style="border: 1px solid black; width: 150px;">Diskon</td>
                    <td class="text-end" style="border: 1px solid black;">{{ number_format($totaldiskon) }}</td>
                </tr>
                <tr>
                    <td class="text-left" style="border: 1px solid black; width: 150px;">PPN (11%)</td>
                    <td class="text-end" style="border: 1px solid black;">{{ number_format($totalppn) }}</td>
                </tr>
                <tr>
                    <td class="text-left" style="border: 1px solid black; width: 150px;">Biaya Lain-lain</td>
                    <td class="text-end" style="border: 1px solid black;">0</td>
                </tr>
                {{-- @foreach ($shorder->faktur as $i) --}}
                <tr>
                    <th class="text-left" style="border: 2px solid black; width: 150px;">Total After Tax</th>
                    <th class="text-end" style="border: 2px solid black;">{{ number_format($total) }}</th>
                </tr>
                {{-- @endforeach --}}
            </table>

            <table class="text-end" style="margin-top: 160px; margin-left: 75%;">
                <tr>
                    <td style="font-weight: bold; font-size: 12px;">Jakarta, {{ date('d M Y') }}</td>
                </tr>
                <br>
                <br>
                <tr>
                    <td style="font-weight: bold; font-size: 12px;">ADMINISTRATION</td>
                </tr>
            </table>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</html>
