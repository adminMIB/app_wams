@extends('layouts.main')
@section('css')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <div class="alert w-100" style="background-color: #C7D2FE">
      <h2 style="color: rgb(13, 13, 13)">Welcome, {{ Auth::user()->name}} 👋</h2>
      <h6 class="text-muted text-sm mt-2"><b class="text-danger">Last Login at: </b>{{auth()->user()->last_sign_in_at->diffForHumans()}}</h6>
    </div>
  </div>
  <div class="row">
    <div class="col-6 col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Sales Pipeline</h6>
                        <h6 class="font-extrabold mb-0">
                          @if (Auth::user()->name == "Dian Octavia")
                            {{ $salespipedian }}
                          @else
                            {{ $salespipe }}
                          @endif  
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Project Win</h6>
                        <h6 class="font-extrabold mb-0">{{ $totalmenang }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Running Projects</h6>
                        <h6 class="font-extrabold mb-0">{{ $totalberjalan }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Project Lost</h6>
                        <h6 class="font-extrabold mb-0">{{ $totalkalah }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Project Done</h6>
                        <h6 class="font-extrabold mb-0">{{ $pselesai }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 mb-3">
      <h4 class="text-center mb-3" style="text-decoration: underline;">AM Contribution by Contract</h4>
      <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
    </div>
    <div class="col-lg-6 mb-3">
      <h4 class="text-center mb-3" style="text-decoration: underline;">AM Contribution by Estimated</h4>
      <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
    </div>
    <div class="col-lg-12">
      {{-- <h4 class="text-center mb-3" style="text-decoration: underline;">AM Contribution by Pipeline</h4> --}}
      {{-- <canvas id="myChart3" style="width:100%;max-width:600px"></canvas> --}}
      <figure class="highcharts-figure">
        <div id="myChart3" class="rounded"></div>
      </figure>
    </div>
    <div class="col-lg-12">
      {{-- <h4 class="text-center mb-3" style="text-decoration: underline;">AM Contribution by Contract</h4>
      <canvas id="myChar4" style="width:100%;max-width:600px"></canvas> --}}
      <figure class="highcharts-figure">
        <div id="myChart4" class="rounded"></div>
      </figure>
    </div>
  </div>
</section>
<script src="../assets/js/highcharts.js"></script>
{{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
  var namapipe = <?php echo json_encode($namacontract) ?>;
  var contract = <?php echo json_encode($jumlahContract) ?>;
  var lost = <?php echo json_encode($jumlahlost) ?>;
  var estimated = <?php echo json_encode($jumlahesti) ?>;

  var xValues = namapipe;
  var yValues = contract;
  var barColors = [
    "#4285f4",
    "#ea4335",
    "#fbbc04",
    "#34a853",
    "#ff6d01",
    "#46bdc6",
  ];

  new Chart("myChart", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      title: {
        display: true,
        text: "World Wide Wine Production 2018"
      }
    }
  });
</script>
<script>
var xValues = namapipe;
var yValues = estimated;
var barColors = [
  "#4285f4",
  "#ea4335",
  "#fbbc04",
  "#34a853",
  "#ff6d01",
  "#46bdc6",
];

new Chart("myChart2", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    }
  }
});
</script>
<script>
  Highcharts.chart('myChart3', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'AM Contribution'
    },
    subtitle: {
      text: 'AM/Sales'
    },
    xAxis: {
      categories: namapipe,
      crosshair: true
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
      footerFormat: '</table>',
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
      name: 'Estimated Amount',
      data: estimated

    }, {
      name: 'Lost',
      data: lost

    }, {
      name: 'Contract Amount',
      data: contract

    }]
  });
</script>
<script>
  Highcharts.chart('myChart4', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'AM Contribution'
  },
  xAxis: {
    categories: namapipe
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Amount'
    }
  },
  legend: {
    reversed: true
  },
  plotOptions: {
    series: {
      stacking: 'normal'
    }
  },
  series: [{
    name: 'Contract Amount',
    data: contract
  }, {
    name: 'Lost',
    data: lost
  }, {
    name: 'Estimated Amount',
    data: estimated
  }]
});
</script>
@endsection
{{-- @section('js')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="../assets/js/stisla.js"></script>

<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/custom.js"></script>
@endsection --}}
