@extends('layouts.main')
@section('content')
    <section class="section mt-3">
      <p style="font-size: 20px; color:rgb(100, 98, 98)">Workflow Management System</p>
        <div class="alert" style="background-color: #C7D2FE">
          <h2 style="color: rgb(13, 13, 13)" class="text-capitalize"> Welcome, {{ Auth::user()->name}} 👋</h2>
          <h6 class="text-muted text-sm mt-2"><b class="text-danger">Last Login: </b>{{ Auth::user()->last_sign_in_at->format('d-m-Y h:i:s') }}</h6>
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
                              <div class="stats-icon blue mb-2">
                                  <i class="iconly-boldProfile"></i>
                              </div>
                          </div>
                          <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                              <h6 class="text-muted font-semibold">Sales Piplane</h6>
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
                              <div class="stats-icon green mb-2">
                                  <i class="iconly-boldAdd-User"></i>
                              </div>
                          </div>
                          <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                              <h6 class="text-muted font-semibold">Project Po</h6>
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
                                  <i class="iconly-boldBookmark"></i>
                              </div>
                          </div>
                          <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                              <h6 class="text-muted font-semibold">Project Loss</h6>
                              <h6 class="font-extrabold mb-0"></h6>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>

      <div class="row">
        <div class="col-lg-6">
            <canvas id="myChart"></canvas>
        </div>
        <div class="col-lg-6">
          <canvas id="myChart2"></canvas>
        </div>
      </div>
    </section>

@endsection


