@extends('layouts.main')
@section('content')
    <section class="section">
      <div class="card">
        <div class="card-header">
          <div class="alert w-100" style="background-color: #C7D2FE">
            <h2 style="color: rgb(13, 13, 13)">Welcome, {{ Auth::user()->name}} 👋</h2>
            <h6 class="text-muted text-sm mt-2"><b class="text-danger">Last Login at: </b>{{auth()->user()->last_sign_in_at->diffForHumans()}}</h6>
          </div>
        </div>
      </div>
      <div class="card-body">
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
                              <h6 class="text-muted font-semibold">Sales Piplane</h6>
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
                              <h6 class="font-extrabold mb-0">{{ count($dataProjectMenang) }}</h6>
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
      </div>
    </section>
@endsection

