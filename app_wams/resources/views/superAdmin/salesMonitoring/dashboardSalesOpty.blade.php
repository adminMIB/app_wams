@extends('layouts.main')
@section('content')
   
<section class="section">
  <div class="title">
      <h1 style="color: black; margin-left: 9px; margin-top:20px">List Sales Opty</h1>
   </div> 
     <div class="card">
      <div class="card-body ">
      <table class="table table-striped table-hover">
       
          <a href="{{{route('/dashboard/salesOptyadd')}}}" class="btn btn-icon icon-left btn-primary "><i class="far fa-edit"></i> Add Sales Orderss</a>
        <hr>
          <thead>
          <tr>
              <th>No</th>
              <th>Nama Client</th>
              <th>Project</th>
              <th>Produk / Solusi</th>
              <th colspan="4" class="text-center">Timeline</th>
              <th>Action</th>
          </tr>
          <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th>Q1</th>
              <th>Q2</th>
              <th>Q3</th>
              <th>Q4</th>
              <th></th>
             
          </tr>
       </thead>
       
       <tbody>
          @foreach ($sales as $opty)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $opty->NamaClient }}</td>
                  <td>{{ $opty->NamaProject }}</td>
                  <td>{{ $opty->elearning_id}}</td>
                  <td>
                      @if ($opty->Timeline == 'Q1')
                          {{ number_format($opty->Angka,0,',','.') }}
                      @endif
                  </td>
                  <td>
                      @if ($opty->Timeline == 'Q2')
                          {{ number_format($opty->Angka,0,',','.') }}
                      @endif
                  </td>
                  <td>
                      @if ($opty->Timeline == 'Q3')
                          {{ number_format($opty->Angka,0,',','.') }}
                      @endif
                  </td>
                  <td>
                      @if ($opty->Timeline == 'Q4')
                          {{ number_format($opty->Angka,0,',','.') }}
                      @endif
                  </td>
                  <td>
                           <a href="{{url ('detail', $opty->id)}}">  <button type="submit" class="btn btn-warning btn-sm mb-1">edit</button></a>
                    <a href="{{url ('delete', $opty->id)}}">  <button type="submit" class="btn btn-danger btn-sm mb-1">Delete</button></a>
                  </td>
              </tr>
          @endforeach
       </tbody>
      </table>
      </div>
     </div>
  
  </section>
@endsection
      



