@extends('layouts.main')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('content')
    <section class="section mt-3">
      <p style="font-size: 20px; color:rgb(100, 98, 98)">Workflow Management System</p>
        <div class="alert" style="background-color: #C7D2FE">
          <h2 style="color: rgb(13, 13, 13)" class="text-capitalize"> Welcome, {{ Auth::user()->name}} 👋</h2>
        </div>
        <div class="row">
          <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                  <div class="card-body px-4 py-4-5">
                      <div class="row">
                          <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                              <div class="stats-icon purple mb-2">
                                  <i class="iconly-boldShow"></i>
                              </div>
                          </div>
                          <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                              <h6 class="text-muted font-semibold">Project Admin</h6>
                              <h6 class="font-extrabold mb-0">{{$dataAdmin}}</h6>
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
                              <div class="stats-icon blue mb-2">
                                  <i class="iconly-boldProfile"></i>
                              </div>
                          </div>
                          <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                              <h6 class="text-muted font-semibold">Sales Piplane</h6>
                              <h6 class="font-extrabold mb-0">{{$dataPiplane}}</h6>
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
                              <div class="stats-icon green mb-2">
                                  <i class="iconly-boldAdd-User"></i>
                              </div>
                          </div>
                          <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                              <h6 class="text-muted font-semibold">Project Po</h6>
                              <h6 class="font-extrabold mb-0">{{$jumlahPoProject}}</h6>
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
                                  <i class="iconly-boldBookmark"></i>
                              </div>
                          </div>
                          <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                              <h6 class="text-muted font-semibold">Project Loss</h6>
                              <h6 class="font-extrabold mb-0">{{$jumlahLostProject}}</h6>
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
            <h4 class="text-center mb-3" style="text-decoration: underline;">AM Contribution by Pipeline</h4>
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
  //! JUMLAH TOTAL DATA PO 
  //  project DIAN LUBIS PO
  let dianLubis = <?php echo json_encode($datDianLubisPO) ?>;
  //  project DIAN OCATAVIA PO
  let dianOctavia = <?php echo json_encode($datDianLOctaviaPO) ?>;
  //  project DIAN OCATAVIA PO
  let Meita = <?php echo json_encode($datMeithaPO) ?>;

  // AM Contribution by Contract
  var xValues = ["Dian Lubis", "Dian Octavia","Meita"];
    var yValues = [dianLubis, dianOctavia, Meita];
    var barColors = [
      "#4285f4",
      "#ea4335",
      "#fbbc04",
      // "#34a853",
      // "#ff6d01",
      // "#46bdc6",
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

    
    // ALL DATA BY PIPLANE
    let dianLubisALL = <?php echo json_encode($datDianLubisALL) ?>;
    //  project DIAN OCATAVIA PO
    let dianOctaviaALL = <?php echo json_encode($datDianLOctaviaALL) ?>;
    //  project DIAN OCATAVIA PO
    let MeitaALL = <?php echo json_encode($datMeithaAll) ?>;

  // </script>
  // <script>
  var xValues = [ "Dian Lubis", "Dian Octavia", "Meita"];
  var yValues = [dianLubisALL, dianOctaviaALL, MeitaALL];
  var barColors = [
    "#4285f4",
    "#ea4335",
    "#fbbc04",
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

  // </script>
  // <script>

    // ! ESTIMATED AMOUT YANG SUDAH PO
    // ESTIMATED AMOUTN PO DIAN OCTAVIA
    // let a ='';
    // let arrayEstimateddAmountDataDianOctavia = <?php echo $estimaedAmoutnDianOctaviaPO ?>;
    // let estimatedAmoutDianOctaviaPo = arrayEstimateddAmountDataDianOctavia.map((item) => {
    //   a += item.estimated_amount;
    // })

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
        categories: [
          "Dian Lubis", 
          "Dian Octavia", 
          "Meita"
        ],
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
        data: [6700000000, 57145000000, 38885795000,]

      }, {
        name: 'Lost',
        data: [107256906850, 21325783168,100]

      }, {
        name: 'Contract Amount',
        data: [1000,11120000,1503867321156]

      }]
    });
  // </script>
  // <script>
    Highcharts.chart('myChart4', {
    chart: {
      type: 'bar'
    },
    title: {
      text: 'AM Contribution'
    },
    xAxis: {
      categories: [ "Meita","Incka Sukmawati", "Fiky Albina", "Dian Octavia",  "Dian Lubis","Agus salim"]
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
      data: [3685093000, 608150014, 388156984, 15038673256, 3960603528, 442633900]
    }, {
      name: 'Estimated Amount',
      data: [14115698000, 17405601351, 12998000000, 38885795000, 57145000000, 6700000000]
    }, {
      name: 'Lost',
      data: [0, 1042000000, 0, 0, 21325783168, 107256906850]
    }]
  });
</script>

@endsection




