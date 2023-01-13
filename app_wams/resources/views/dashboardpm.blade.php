@extends('layouts.main')

@section('title', 'DashboardPM')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('content')
<section class="section mt-3">  
  <div class="alert" style="background-color: #C7D2FE">
    <h2 style="color: rgb(13, 13, 13)" class="text-capitalize"> Welcome, {{ Auth::user()->name}} 👋</h2>
    <h6 class="text-muted text-sm mt-2"><b class="text-danger">Last Login at: </b>{{auth()->user()->last_sign_in_at->diffForHumans()}}</h6>  
  </div>
  <div class="row">
    <div class="col-6 col-lg-3 col-md-6">
      <div class="card">
          <div class="card-body px-4 py-4-5">
              <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                      <div class="stats-icon green mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle text-white text-lg" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                        </svg>
                      </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">Project Completed</h6>
                      <h6 class="font-extrabold mb-0"></h6>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-6 col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body px-4 py-4-5">
            <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                    <div class="stats-icon mb-2" style="background-color: #f2a156">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-repeat text-white" viewBox="0 0 16 16">
                        <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                        <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                      </svg>
                    </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Project Open</h6>
                    <h6 class="font-extrabold mb-0"></h6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-6 col-lg-3 col-md-6">
  <div class="card">
      <div class="card-body px-4 py-4-5">
          <div class="row">
              <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                  <div class="stats-icon red mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation text-white" viewBox="0 0 16 16">
                      <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.553.553 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg>
                  </div>
              </div>
              <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Project Hold</h6>
                  <h6 class="font-extrabold mb-0"></h6>
              </div>
          </div>
      </div>
  </div>
</div>
  </div>
  <div class="col-lg-12">
    {{-- <h4 class="text-center mb-3" style="text-decoration: underline;">AM Contribution by Pipeline</h4> --}}
    {{-- <canvas id="myChart3" style="width:100%;max-width:600px"></canvas> --}}
    <figure class="highcharts-figure">
      <div id="myChart3" class="rounded"></div>
    </figure>
  </div>
</div>
</section>

<script src="../assets/js/highcharts.js"></script>
{{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript"> 
var namacontract = <?php echo json_encode($namacontract) ?>;
var jumlahContract = <?php echo json_encode($jumlahContract) ?>;
  Highcharts.chart('myChart3', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monthly Average Rainfall'
    },
    subtitle: {
        text: 'Status Pekerjaan Technikal'
    },
    xAxis: {
        categories: namacontract,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (mm)'
        }
    },
    tooltip: {
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'To Do',
        data: [1,2]

    }]
  });
</script>
@endsection