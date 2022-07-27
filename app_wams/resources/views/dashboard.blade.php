@extends('layouts.main')
@section('content')
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>Welcome</h1>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fa-solid fa-bars-progress" style="color: white; font-size:3em;"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>On Progres</h4>
                  </div>
                  <div class="card-body">
                    10
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fa-solid fa-circle-exclamation" style="color: white; font-size:3em;"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Issue</h4>
                  </div>
                  <div class="card-body">
                   5
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fa-solid fa-clipboard-check" style="color: white; font-size:3em;"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Done</h4>
                  </div>
                  <div class="card-body">
                    2
                  </div>
                </div>
              </div>
            </div>
                           
          </div>
        </div>
      </div>
    </section>
@endsection

