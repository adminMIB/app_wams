@extends('layouts.main')
@section('content')
    <section class="section mt-3">
      <p style="font-size: 20px; color:rgb(100, 98, 98)">Workflow Management System</p>
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
                              <div class="stats-icon purple mb-2">
                                  <i class="iconly-boldShow"></i>
                              </div>
                          </div>
                          <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                              <h6 class="text-muted font-semibold">Project Admin</h6>
                              <h6 class="font-extrabold mb-0">{{ count($projectAdmin) }}</h6>
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
                              <h6 class="text-muted font-semibold">Sales Pipeline</h6>
                              <h6 class="font-extrabold mb-0">{{ count($projectSales) }}</h6>
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
                              <h6 class="text-muted font-semibold">Project PO</h6>
                              <h6 class="font-extrabold mb-0">{{ count($dataProjectMenang ) }}</h6>
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
                              <h6 class="text-muted font-semibold">Project Lost</h6>
                              <h6 class="font-extrabold mb-0">{{ count($dataProjectKalah) }}</h6>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>

      <div class="row align-items-center">
        <div class="col-lg-6">
          <h4 class="text-center">Contribution by Projects
          </h4>
            <canvas id="myChart"></canvas>
        </div>
        <div class="col-lg-6">
          {{-- <h4 class="text-center">sadds</h4> --}}
          <canvas id="myChart2"></canvas>
        </div>
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        let nama = <?php echo json_encode($nama) ?>;
        let jumlahNama = <?php echo json_encode($jumlahNama) ?>;

      // mycart1
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


    // 

    let namaBulan = <?php echo json_encode($namaBulan) ?>;
    let jumlahNamaBulan = <?php echo json_encode($jumlahBulan) ?>;

    const labels2 = namaBulan
      const data2 = {
        labels: labels2,
        datasets: [{
          label: 'Statistik Project 2022',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: jumlahNamaBulan
        }]
      };

    const config2 = {
      type: 'line',
      data: data2,
      options: {}
    };


      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );

      const myChart2 = new Chart(
        document.getElementById('myChart2'),
        config2
      );

      // char 2
      
    </script>
@endsection


