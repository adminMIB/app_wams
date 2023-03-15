@extends('layouts.main')
@section('css')
  <link rel="stylesheet" href="{{ asset('newassets/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/fontawesome.css') }}">
  <link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/datatables.css') }}">
@endsection
@section('content')
<div class="modal-dialog myModal modal-dialog-centered">
</div>
    <section class="section mt-3">
      <p style="font-size: 20px; color:rgb(100, 98, 98)">Workflow Management System</p>
        <div class="alert" style="background-color: #C7D2FE">
          <h2 style="color: rgb(13, 13, 13)" class="text-capitalize"> Welcome, {{ Auth::user()->name}} 👋</h2>
          <h6 class="text-muted text-sm mt-2"><b class="text-danger">Last Login: </b>{{auth()->user()->last_sign_in_at->diffForHumans()}}</h6>
        </div>
          <div class="row">
            <a href="{{ route('ProjectsAll') }}" class="col-6 col-lg-3 col-md-6">
              <div class="card" style="cursor: pointer">
                <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon red mb-2">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor" width="20" height="20" class=" text-white text-lg">
                                    <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                  </svg>
                                    {{-- <i class="iconly-boldProfile"></i> --}}
                                    {{-- <i class="fa-sharp fa-solid fa-file-check"></i> --}}
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Sales Pipeline</h6>
                                <h6 class="font-extrabold mb-0">{{ count($dataProjects) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('ProjectKalah') }}" class="col-6 col-lg-3 col-md-6">
                <div class="card" style="cursor: pointer">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon red mb-2">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" width="20" height="20" class=" text-white text-lg">
                                    <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm79 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/>
                                  </svg>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Project Lost</h6>
                                <h6 class="font-extrabold mb-0">{{ count($dataProjectKalah) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('ProjectsAll') }}" class="col-6 col-lg-3 col-md-6">
              <div class="card" style="cursor: pointer">
                <div class="card-body px-4 py-4-5">
                      <div class="row">
                          <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                              <div class="stats-icon red mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor" width="20" height="20" class=" text-white text-lg">
                                  <path d="M128 192C110.3 192 96 177.7 96 160C96 142.3 110.3 128 128 128C145.7 128 160 142.3 160 160C160 177.7 145.7 192 128 192zM200 160C200 146.7 210.7 136 224 136H448C461.3 136 472 146.7 472 160C472 173.3 461.3 184 448 184H224C210.7 184 200 173.3 200 160zM200 256C200 242.7 210.7 232 224 232H448C461.3 232 472 242.7 472 256C472 269.3 461.3 280 448 280H224C210.7 280 200 269.3 200 256zM200 352C200 338.7 210.7 328 224 328H448C461.3 328 472 338.7 472 352C472 365.3 461.3 376 448 376H224C210.7 376 200 365.3 200 352zM128 224C145.7 224 160 238.3 160 256C160 273.7 145.7 288 128 288C110.3 288 96 273.7 96 256C96 238.3 110.3 224 128 224zM128 384C110.3 384 96 369.7 96 352C96 334.3 110.3 320 128 320C145.7 320 160 334.3 160 352C160 369.7 145.7 384 128 384zM0 96C0 60.65 28.65 32 64 32H512C547.3 32 576 60.65 576 96V416C576 451.3 547.3 480 512 480H64C28.65 480 0 451.3 0 416V96zM48 96V416C48 424.8 55.16 432 64 432H512C520.8 432 528 424.8 528 416V96C528 87.16 520.8 80 512 80H64C55.16 80 48 87.16 48 96z"/>
                                </svg>
                              </div>
                          </div>
                          <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                              <h6 class="text-muted font-semibold">Running Projects</h6>
                              <h6 class="font-extrabold mb-0">{{ count($dataProjects) }}</h6>
                          </div>
                      </div>
                  </div>
              </div>
          </a>
            <a href="{{ route('ProjectMenang') }}" style="cursor: pointer" class="col-6 col-lg-3 col-md-6">
              <div class="card" id="btn">
                  <div class="card-body px-4 py-4-5">
                      <div class="row">
                          <div class="stats-icon red mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor" width="20" height="20" class=" text-white text-lg">
                              <path d="M320 128V49.1L186.6 .3c-11.4-4.2-24 .9-29.5 11.7L71.8 181.1c-30.8 61-8 133.8 48.1 167.4l-28 77.4L32.1 403.9C19.7 399.4 6 405.8 1.4 418.3s1.9 26.3 14.3 30.8l164.6 60.3c12.4 4.5 26.1-1.9 30.6-14.4s-1.9-26.3-14.3-30.8l-59.9-21.9 28-77.3c68.1 11.6 135.7-32.8 150.1-103.6l5.1-24.8 5.1 24.8c14.5 70.8 82 115.2 150.1 103.6l28 77.3-59.9 21.9c-12.4 4.5-18.8 18.3-14.3 30.8s18.2 18.9 30.6 14.4l164.6-60.3c12.4-4.5 18.8-18.3 14.3-30.8s-18.2-18.9-30.6-14.4l-59.9 21.9-28-77.4c56.1-33.6 78.8-106.4 48.1-167.4L482.9 12C477.4 1.1 464.7-3.9 453.4 .3L320 49.1V128h0zm-35.7 44.4L153.9 124.6l36.3-71.9L300.6 93.1l-16.2 79.3zm71.3 0L339.4 93.1 449.8 52.7l36.3 71.9L355.7 172.4z"/>
                            </svg>
                          </div>
                          <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                              <h6 class="text-muted font-semibold">Project Win</h6>
                              <h6 class="font-extrabold mb-0">{{count($dataProjectMenang)}}</h6>
                          </div>
                      </div>
                  </div>
              </div>
          </a>
          <a href="{{ route('ProjectBastOven') }}" style="cursor: pointer" class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon red mb-2">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor" width="20" height="20" class=" text-white text-lg">
                                <path d="M320 32c0-9.9-4.5-19.2-12.3-25.2S289.8-1.4 280.2 1l-179.9 45C79 51.3 64 70.5 64 92.5V448H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H96 288h32V480 32zM256 256c0 17.7-10.7 32-24 32s-24-14.3-24-32s10.7-32 24-32s24 14.3 24 32zm96-128h96V480v32h32 64c17.7 0 32-14.3 32-32s-14.3-32-32-32H512V128c0-35.3-28.7-64-64-64H352v64z"/>
                              </svg>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Project Open</h6>
                            <h6 class="font-extrabold mb-0">{{ count($dataBastOven) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('projectBastHold') }}" style="cursor: pointer" class="col-6 col-lg-3 col-md-6">
          <div class="card">
              <div class="card-body px-4 py-4-5">
                  <div class="row">
                      <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                          <div class="stats-icon red mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" width="20" height="20" class=" text-white text-lg">
                              <path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/>
                            </svg>
                          </div>
                      </div>
                      <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                          <h6 class="text-muted font-semibold">Project Hold</h6>
                          <h6 class="font-extrabold mb-0">{{ count($dataBastHold) }}</h6>
                      </div>
                  </div>
              </div>
          </div>
      </a>
      <a href="{{ route('projectBastCompleted') }}" style="cursor: pointer" class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon red mb-2">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class=" text-white text-lg" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"></path>
                          </svg>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Project Completed</h6>
                        <h6 class="font-extrabold mb-0">{{ count($dataBastComplete) }}</h6>
                    </div>
                </div>
            </div>
        </div>
      </a>
    </div>

        <div class="row">
          <div class="col-lg-4 mb-3">
            <h4 class="text-center mb-3" style="text-decoration: underline;">AM Contribution by Contract</h4>
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
          </div>
          <div class="col-lg-4">
            <h4 class="text-center mb-3" style="text-decoration: underline;">Contribution by Projects</h4>
              <canvas id="myChart2"></canvas>
          </div>
          <div class="col-lg-4 mb-3">
            <h4 class="text-center mb-3" style="text-decoration: underline;">AM Contribution by Amount Contract</h4>
              <canvas id="myChart3"></canvas>
          </div>

        </div>

        {{-- <figure class="highcharts-figure">
          <div id="container"></div>
      </figure> --}}

      {{--  --}}
      <figure class="highcharts-figure">
        <div id="container2"></div>
      </figure>
      
      <figure class="highcharts-figure">
        <div id="container4"></div>
      </figure>
    </section>

    {{-- <script src="../assets/js/highcharts.js"></script> --}}
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>


{{-- @section('js') --}}
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
{{-- @endsection --}}


<script>

//! JUMLAH TOTAL DATA PO 
const cekNama = <?php echo json_encode($nama) ?>;
const jumlahCekNama = <?php echo json_encode($jumlahNama) ?>;

// AM Contribution by Contract
  var xValues = cekNama;
  var yValues = jumlahCekNama;
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
        text: "AM's Contribution"
      }
    }
  });


  // 2
  let nama = <?php echo json_encode($namaByProjects) ?>;
  console.log(nama);
  let jumlahNama = <?php echo json_encode($jumlahNamaByProjects) ?>;

  const data = {
        labels: nama,
        datasets: [{
          // label: 'Statistik Project 2022',
          data: jumlahNama,
          backgroundColor: [
            'rgb(103,119,239)',
            'rgb(75, 192, 192)',
            'rgb(252,84,75)',
            'rgb(255,164,38)'
          ]
        }]
      };

    const config = {
      type: 'polarArea',
      data: data,
      options: {}
    };

    const myChart2 = new Chart(
        document.getElementById('myChart2'),
        config
      );


// 
var namacontract = <?php echo json_encode($namacontract) ?>;
var jumlahcontract = <?php echo json_encode($jumlahContract) ?>;
var jumlahlost = <?php echo json_encode($jumlahlost) ?>;
var jumlahesti = <?php echo json_encode($jumlahesti) ?>;

// Highcharts.chart('container', {
//     chart: {
//         type: 'bar'
//     },
//     title: {
//         text: "AM Contribution"
//     },
//     subtitle: {
//         text: 'PT. Mitra Inti Bersama'
//     },
//     xAxis: {
//         categories: namacontract,
//         title: {
//             text: null
//         }
//     },
//     yAxis: {
//         min: 0,
//         title: {
//             text: 'Amount',
//             align: 'high'
//         },
//         labels: {
//             overflow: 'justify'
//         }
//     },
//     tooltip: {
//         valueSuffix: ' Rupiah'
//     },
//     plotOptions: {
//         bar: {
//             dataLabels: {
//                 enabled: true
//             }
//         }
//     },
//     legend: {
//         layout: 'vertical',
//         align: 'right',
//         verticalAlign: 'top',
//         x: -50,
//         y: 90,
//         floating: true,
//         borderWidth: 1,
//         backgroundColor:
//             Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
//         shadow: true
//     },
//     credits: {
//         enabled: false
//     },
//     series: [{
//         name: 'Estimated Oppty',
//         data: jumlahesti
//     }, {
//         name: 'Lost',
//         data: jumlahlost
//     }, {
//         name: 'Contract',
//         data: jumlahcontract
//     },]
// });


// 
var totalcontract = <?php echo json_encode($totalpipecont) ?>;
var totallost = <?php echo json_encode($totalpipelost) ?>;
var totalestimated = <?php echo json_encode($totalpipeesti) ?>;

// Data retrieved from https://www.ssb.no/energi-og-industri/olje-og-gass/statistikk/sal-av-petroleumsprodukt/artikler/auka-sal-av-petroleumsprodukt-til-vegtrafikk
Highcharts.chart('container2', {
  title: {
    text: 'AM Contribution',
    align: 'left'
  },
  xAxis: {
    categories: namacontract
  },
  yAxis: {
    title: {
      text: 'Amount'
    }
  },
  labels: {
    items: [{
      html: 'Total Projects',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'black'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Estimated Pipeline',
    data: jumlahesti
  }, {
    type: 'column',
    name: 'Lost',
    data: jumlahlost
  }, {
    type: 'column',
    name: 'PO/Contract',
    data: jumlahcontract
  }, {
    type: 'pie',
    name: 'Total',
    data: [{
      name: 'BIDDING',
      y: totalestimated,
      color: Highcharts.getOptions().colors[0] // 2020 color
    }, {
      name: 'LOST!',
      y: totallost,
      color: Highcharts.getOptions().colors[1] // 2021 color
    }, {
      name: 'PO/Contract',
      y: totalcontract,
      color: Highcharts.getOptions().colors[2] // 2022 color
    }],
    center: [80, 70],
    size: 100,
    showInLegend: false,
    dataLabels: {
      enabled: false
    }
  }]
});

  var xValues = namacontract;
  var yValues = jumlahcontract;
  var barColors = [
    "#4285f4",
    "#ea4335",
    "#fbbc04",
    "#34a853",
    "#ff6d01",
    "#46bdc6",
  ];

  new Chart("myChart3", {
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
        text: "AM's Contribution"
      }
    }
  });

  // Highcharts.chart('myChart3', {
  //     chart: {
  //         plotBackgroundColor: null,
  //         plotBorderWidth: null,
  //         plotShadow: false,
  //         type: 'pie'
  //     },
  //     title: {
  //         text: 'Browser market shares in March, 2022',
  //         align: 'left'
  //     },
  //     tooltip: {
  //         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  //     },
  //     accessibility: {
  //         point: {
  //             valueSuffix: '%'
  //         }
  //     },
  //     plotOptions: {
  //         pie: {
  //             allowPointSelect: true,
  //             cursor: 'pointer',
  //             dataLabels: {
  //                 enabled: false
  //             },
  //             showInLegend: true
  //         }
  //     },
  //     series: [{
  //         name: 'Contract',
  //         colorByPoint: true,
  //         data: [{
  //             name: 'Chrome',
  //             y: 74.77,
  //             sliced: true,
  //             selected: true
  //         },  {
  //             name: 'Edge',
  //             y: 12.82
  //         },  {
  //             name: 'Firefox',
  //             y: 4.63
  //         }, {
  //             name: 'Safari',
  //             y: 2.44
  //         }, {
  //             name: 'Internet Explorer',
  //             y: 2.02
  //         }, {
  //             name: 'Other',
  //             y: 3.28
  //         }]
  //     }]
  // });


  Highcharts.chart('container4', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'AM Contribution'
    },
    subtitle: {
        text: 'PT MITRA INTI BERSAMA'
    },
    xAxis: {
        categories: namacontract
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
        name: 'Estimated Oppty',
        data: jumlahesti
    }, {
        name: 'Lost',
        data: jumlahlost
    }, {
        name: 'Contract',
        data: jumlahcontract
    }]
  });
 
</script>

@endsection




