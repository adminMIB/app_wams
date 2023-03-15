@extends('layouts.main')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1 class="text-secondary">Menu Dashboard All Page Role</h1>
    </div>
    <div class="row">
      {{-- ! Dashboard Am Sales --}}
      <div class="col-12 col-md-4 col-lg-4card">
        <div class="card">
          <div class="card-body">
            <div class="pricing">
              <div class="pricing-title bg-primary text-white rounded text-center">
                Menu Dashboard AM/Sales
              </div>
              <div class="pricing-padding">
                {{-- <div class="pricing-price">
                  <a href="/slsorder">Sales Order</a>
                </div> --}}
                <div class="pricing-details">
                  <div class="pricing-item">
                    <a href="/slsorder">Sales Order <i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/adminproject/sales">Sales Pipelane <i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/selearning">Elearning<i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/adminproject">List Project admin<i class="fas fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      {{-- ! Dashboard Management --}}
      <div class="col-12 col-md-4 col-lg-4">
        <div class="card">
          <div class="card-body">
            <div class="pricing">
              <div class="pricing-title bg-success text-white rounded text-center">
               Menu Dashboard Management
              </div>
              <div class="pricing-padding">
                {{-- <div class="pricing-price">
                  <a href="/slsorder">Sales Order</a>
                </div> --}}
                <div class="pricing-details">
                  <div class="pricing-item">
                    <a href="/approval">Approval SO <i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/reportp">Report Project <i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/inputTwo">List Approve SO
                      <i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/listd">List Document<i class="fas fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      {{-- ! Dashboard project admin --}}
      <div class="col-12 col-md-4 col-lg-4">
        <div class="card">
          <div class="card-body">
            <div class="pricing">
              <div class="pricing-title bg-danger text-white rounded text-center">
               Menu Dashboard Project Admin
              </div>
              <div class="pricing-padding">
                {{-- <div class="pricing-price">
                  <a href="/slsorder">Sales Order</a>
                </div> --}}
                <div class="pricing-details">
                  <div class="pricing-item">
                    <a href="/adminproject">List Project Admin<i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/adminproject/sales">List Sales Piplane <i class="fas fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      {{-- ! Dashboard Technikal --}}
      <div class="col-12 col-md-4 col-lg-4">
        <div class="card">
          <div class="card-body">
            <div class="pricing">
              <div class="pricing-title bg-warning text-white rounded text-center">
               Menu Dashboard Technikal
              </div>
              <div class="pricing-padding">
                {{-- <div class="pricing-price">
                  <a href="/slsorder">Sales Order</a>
                </div> --}}
                <div class="pricing-details">
                  <div class="pricing-item">
                    <a href="/viewproject">List View Project<i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/report">Report Progres<i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/create">Create Weekly Report <i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/telearning">List Elearning<i class="fas fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- ! Dashboard PM --}}
      <div class="col-12 col-md-4 col-lg-4">
        <div class="card">
          <div class="card-body">
            <div class="pricing">
              <div class="pricing-title bg-info text-white rounded text-center">
               Menu Dashboard PM
              </div>
              <div class="pricing-padding">
                {{-- <div class="pricing-price">
                  <a href="/slsorder">Sales Order</a>
                </div> --}}
                <div class="pricing-details">
                  <div class="pricing-item">
                    <a href="/list_project">List View Project<i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/timeline">List Project Timeline <i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/report-timeline">Report Timeline<i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="/task">Task Progress Report <i class="fas fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div class="col-12 col-md-8 col-lg-8">
        <div class="card">
          <div class="card-body">
            <div class="pricing">
              <div class="pricing-title bg-secondary text-white rounded text-center">
               Menu Corporate Controller
              </div>
              <div class="pricing-padding">
                <div class="pricing-details">
                  <div class="pricing-item">
                    <a href="#">Aplikasi Advance-Cash Delivery-Cash (Aplikasi AC/DC)<i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="#">Aplikasi Reimbursement Monitoring (Aplikasi ReMon)<i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="#">Aplikasi Distributor Credit Limit Monitoring (Aplikasi DCLM)<i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="pricing-item">
                    <a href="#">Aplikasi Cash Credit Management Monitoring (Aplikasi Cemen)<i class="fas fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>
@endsection

