<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
        font-size: 16px;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        }

        table tr td {
        padding: 0;
        }

        table tr td:last-child {
        text-align: right;
        }

        .bold {
        font-weight: bold;
        }

        .right {
        text-align: right;
        }

        .large {
        font-size: 1.75em;
        }

        .total {
        font-weight: bold;
        color: #000000;
        }

        .logo-container {
        margin: 20px 0 70px 0;
        }

        .invoice-info-container {
        font-size: 0.875em;
        }
        .invoice-info-container td {
        padding: 4px 0;
        }

        .client-name {
        font-size: 1.5em;
        vertical-align: top;
        }

        .line-items-container {
        margin: 70px 0;
        font-size: 0.875em;
        }

        .line-items-container th {
        text-align: left;
        color: #999;
        border-bottom: 2px solid #ddd;
        padding: 10px 0 15px 0;
        font-size: 0.75em;
        text-transform: uppercase;
        }

        .line-items-container th:last-child {
        text-align: right;
        }

        .line-items-container td {
        padding: 15px 0;
        }

        .line-items-container tbody tr:first-child td {
        padding-top: 25px;
        }

        .line-items-container.has-bottom-border tbody tr:last-child td {
        padding-bottom: 25px;
        border-bottom: 2px solid #ddd;
        }

        .line-items-container.has-bottom-border {
        margin-bottom: 0;
        }

        .line-items-container th.heading-quantity {
        width: 50px;
        }
        .line-items-container th.heading-price {
        text-align: right;
        width: 100px;
        }
        .line-items-container th.heading-subtotal {
        width: 100px;
        }

        .payment-info {
        width: 38%;
        font-size: 0.75em;
        line-height: 1.5;
        }

        .footer {
        margin-top: 100px;
        }

        .footer-thanks {
        font-size: 1.125em;
        }

        .footer-thanks img {
        display: inline-block;
        position: relative;
        top: 1px;
        width: 16px;
        margin-right: 4px;
        }

        .footer-info {
        float: right;
        margin-top: 5px;
        font-size: 0.75em;
        color: #ccc;
        }

        .footer-info span {
        padding: 0 5px;
        color: black;
        }

        .footer-info span:last-child {
        padding-right: 0;
        }

        .page-container {
        display: none;
        }
    </style>
</head>
<body>
      <div class="page-container">
        Page
        <span class="page"></span>
        of
        <span class="pages"></span>
      </div>
      
      <img style="height: 100px; width: 143px;" src="https://mitraintibersama.com/assets/img/logo-mib.png">
      <div class="float-right">
        <div class="text-right">
          <h3 class="text-primary">LTO</h3>
          <table class="w-25">
            <thead>
              <tr>
                <th>Referensi</th>
                <td>{{ $shorder->no_so }}</td>
              </tr>
              <tr>
                <th>Tanggal</th>
                <td>{{ $shorder->tgl_so }}</td>
              </tr>
              <tr>
                <th>Status</th>
                <td><b>{{ $shorder->status }}</b></td>
              </tr>
            </thead>
          </table>
        </div>
      </div>

        <table class="mt-5">
          <thead>
            <tr>
              <th class="text-center">Info Perusahaan <hr></th>
              <th></th>
              <th></th>
              <th></th>
              <th class="text-center">Order Dari <hr></th>
            </tr>
            <tr>
              <th class="text-center">PT. Mitra Inti Bersama</th>
              <th></th>
              <th></th>
              <th></th>
              <th class="text-center">{{ $shorder->distributor }}</th>
            </tr>
            <tr>
              <td class="text-center">
                Rukan Mangga Dua Squere Blok F 7-11, 
                Jl. Gunung Sahari Raya No. 1, Jakarta Utara, 
                DKI Jakarta, 14430 
                Indonesia
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-center">
                {{ $shorder->alamat_disti }}
              </td>
            </tr>
          </thead>
        </table>
      
      {{-- <div class="d-flex">
        <div class="w-25" style="margin-right: 125px;">
          <h6>Info Perusahaan</h6><hr>
          <h5>PT. Mitra Inti Bersama</h5>
          <p>
            Gd Palma One Lt 5 Suite 500 , 
            Jl HR Rasuna Said Blok X2 Kav 4 Kuningan Timur 
            Setiabudi, Jakarta Selatan, 
            DKI Jakarta, 12950
            Indonesia
          </p>
          <p>Telp</p>
          <p>Email</p>
        </div>
        <div class="w-25">
          <h6>Order Dari</h6><hr>
          <h5>{{ $shorder->distributor }}</h5>
          <p>
            Rukan Mangga Dua Squere Blok F 7-11, 
            Jl. Gunung Sahari Raya No. 1, Jakarta Utara, 
            DKI Jakarta, 14430 
            Indonesia
          </p>
          <p>Telp</p>
          <p>Email</p>
        </div>
      </div> --}}
      
      <table class="table" style="margin-top: 50px;">
        <thead class="table-dark">
          <tr>
            <th>Produk</th>
            <th>Kuantitas</th>
            <th>Harga</th>
            <th class="text-right">Total</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($shorder->pddetail as $item)
            @php
              $ab = $item->total + $item->total;
            @endphp
            <tr>
              <td>{{ $item->product_name }}</td>
              <td>{{ $item->product_quantity }}</td>
              <td>{{ $item->harga_product }}</td>
              <td>{{ $item->total }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
      
      <table class="line-items-container has-bottom-border">
        <thead>
          <tr>
            <th>Syarat dan Ketentuan</th>
            <th>di Buat Tanggal</th>
            <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="payment-info">
              <div>
                TOP :
              </div>
              <div>
                Back to Back
              </div>
            </td>
            <td class="large">{{ date('D, M Y') }}</td>
            <td class="large total">Rp. {{ $shorder->grandtotal }}</td>
          </tr>
        </tbody>
      </table>
      
      {{-- <div class="footer">
        <div class="footer-info">
          <span>hello@useanvil.com</span> |
          <span>555 444 6666</span> |
          <span>useanvil.com</span>
        </div>
        <div class="footer-thanks">
          <img src="https://github.com/anvilco/html-pdf-invoice-template/raw/main/img/heart.png" alt="heart">
          <span>Thank you!</span>
        </div>
      </div> --}}
</body>
</html>