@extends('layouts.main')
@section('content')
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>Welcome</h1>
        </div>
        <section class="section">
          <div class="section-header">
            <h1 class="text-secondary">Menu Dashboard All Page Role</h1>
           
          </div>

          <div class="section-body">

            <div class="row">
              {{-- ! Dashboard Am Sales --}}
              <div class="col-12 col-md-4 col-lg-4">
                <div class="pricing">
                  <div class="pricing-title">
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
                        <a href="/index-sales">Sales Opty <i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="pricing-item">
                        <a href="/selearning">Elearning<i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="pricing-item">
                        <a href="/slistpa">List Project admin<i class="fas fa-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              {{-- ! Dashboard Management --}}
              <div class="col-12 col-md-4 col-lg-4">
                <div class="pricing">
                  <div class="pricing-title bg-danger text-white">
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
              {{-- ! Dashboard project admin --}}
              <div class="col-12 col-md-4 col-lg-4">
                <div class="pricing">
                  <div class="pricing-title bg-secondary text-dark">
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
                        <a href="/adminproject/sales">List Sales Opty <i class="fas fa-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              {{-- ! Dashboard Technikal Lead --}}
              <div class="col-12 col-md-4 col-lg-4">
                <div class="pricing">
                  <div class="pricing-title bg-primary text-white">
                   Menu Dashboard Technikal Lead
                  </div>
                  <div class="pricing-padding">
                    {{-- <div class="pricing-price">
                      <a href="/slsorder">Sales Order</a>
                    </div> --}}
                    <div class="pricing-details">
                      <div class="pricing-item">
                        <a href="/TechnikalLead">List Project Admin<i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="pricing-item">
                        <a href="/tlWeeklyReport">Weekly Report<i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="pricing-item">
                        <a href="/leadListSalesOpty">View Sales Opty<i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="pricing-item">
                        <a href="/inputTwos">View Wo<i class="fas fa-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              {{-- ! Dashboard Technikal --}}
              <div class="col-12 col-md-4 col-lg-4">
                <div class="pricing">
                  <div class="pricing-title bg-dark text-white">
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
              {{-- ! Dashboard PM Lead--}}
              <div class="col-12 col-md-4 col-lg-4">
                <div class="pricing">
                  <div class="pricing-title bg-warning text-white">
                   Menu Dashboard PM Lead
                  </div>
                  <div class="pricing-padding">
                    {{-- <div class="pricing-price">
                      <a href="/slsorder">Sales Order</a>
                    </div> --}}
                    <div class="pricing-details">
                      <div class="pricing-item">
                        <a href="#">List Project Admin<i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="pricing-item">
                        <a href="/list">List View Order<i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="pricing-item">
                        <a href="/listprojectpm">List Project <i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="pricing-item">
                        <a href="/task">Task Progress Report <i class="fas fa-arrow-right"></i></a>
                      </div>

                    </div>
                  </div>
                </div>
                
              </div>
              {{-- ! Dashboard PM --}}
              <div class="col-12 col-md-4 col-lg-4">
                <div class="pricing">
                  <div class="pricing-title bg-success text-white">
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
                        <a href="/listproject">List Project Technikal<i class="fas fa-arrow-right"></i></a>
                      </div>
                      <div class="pricing-item">
                        <a href="/timeline">Create Project Timline<i class="fas fa-arrow-right"></i></a>
                      </div>

                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </section>
      </div>
    </section>
@endsection

