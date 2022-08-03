@extends('layouts.main')
@section('content')

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


{{-- <div class="row">
  <div class="">
    <div class="card">
      <div class="card-body">
      <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
      </div>
    </div>
  </div>
  
  <div class="">
    <div class="card">
      <div class="card-body">
        <div class="container">
          <h2>Colored Progress Bars</h2>
          <p>Task:</p>
          <div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
              40% Complete (success)
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
              50% Complete (info)
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
              60% Complete (warning)
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
              70% Complete (danger)
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> --}}

@endsection
@section('js')
<script>
  var xValues = ["Proses", "Info", "Succes", "danger", "Warning"];
  var yValues = [55, 49, 44, 24, 15];
  var barColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
    "#e8c3b9",
    "#1e7145"
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
        text: "Task Progress Report"
      }
    }
  });
  </script>
@endsection