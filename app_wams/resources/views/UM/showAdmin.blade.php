@extends('layouts.main')
@section('content')
   
    <section class="section">
      <h1 class="text-center mb-5">Detail List Project Admin</h1>
      <div class="card">
        <div class="card-header">
        </div>

        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data"> 
                  @method('put')
                  {{csrf_field()}}
                  <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12 mb-2">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Project ID</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                            placeholder="First Name" name="namaClient" value="{{$detailId->ID_project}}" autofocus readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                  <div class="form-group">
                                                      <label for="first-name-column">No Customer</label>
                                                      <input type="text" id="first-name-column" class="form-control"
                                                          placeholder="First Name" name="namaClient" value="{{$detailId->ID_Customer}}" autofocus readonly>
                                                  </div>
                                              </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Client Name</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                            placeholder="Last Name" name="lname-column" value="{{$detailId->NamaClient}}" autofocus readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="city-column">Project Name</label>
                                                        <input type="text" id="city-column" class="form-control" placeholder="City"
                                                            name="city-column" style="color: #0099ff" value="{{$detailId->NamaProject}}" autofocus readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="country-floating">Date</label>
                                                        <input type="date" id="country-floating" class="form-control"
                                                            name="country-floating" placeholder="Country" value="{{$detailId->Date}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="company-column">Distributor</label>
                                                        <input type="text" id="company-column" class="form-control"
                                                            name="company-column" placeholder="Company" value="{{$detailId->distributor}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="email-id-column">Principal</label>
                                                        <input type="text" id="email-id-column" class="form-control"
                                                            name="email-id-column" value="{{$detailId->principal}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                  <div class="form-group">
                                                      <label for="email-id-column">Status</label>
                                                      <input type="text" id="email-id-column" class="form-control"
                                                          name="email-id-column" value="{{$detailId->Status}}" readonly
                                                          >
                                                  </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                  <div class="form-group">
                                                      <label for="email-id-column">AM</label>
                                                      @foreach ($detailId->userTechnikals as $item)  
                                                        <input type="text" id="email-id-column" class="form-control text-primary"
                                                          name="email-id-column" value="{{$item->AM->name ?? null}}" readonly >
                                                      @endforeach
                                                  </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                  <div class="form-group">
                                                      <label for="email-id-column">Technical</label>
                                                      @foreach ($detailId->userTechnikals as $item)  
                                                        <input type="text" id="email-id-column" class="form-control text-warning"
                                                          name="email-id-column" value="{{$item->userTechnikal->name ?? null}}">
                                                      @endforeach
                                                  </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                  <div class="form-group">
                                                      <label for="email-id-column">Note</label>
                                                      <input type="text" id="email-id-column" class="form-control"
                                                          name="email-id-column" value="{{$detailId->Note}}" readonly
                                                          >
                                                  </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                  <div class="form-group">
                                                      <label for="email-id-column">Document</label>
                                                      <div>
                                                        @foreach ($detailId->UploadDocuments as $i)
                                                          @foreach (explode("," , $i->file_name) as $a) 
                                                            <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                                                          @endforeach
                                                        @endforeach
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="d-flex  justify-content-between mt-5">
                                                  <a href="{{url('/umViewAdmin')}}" class="btn btn-md btn-danger text-white">Back</a>
                                                </div>                                           
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </section>
            </form> 
              </div>
      </div>
    </section>
@endsection