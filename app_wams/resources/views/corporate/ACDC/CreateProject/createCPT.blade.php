@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <section class="section">
        <div class="section-header" style="padding-bottom: 30px">
            <h5>
                <a href="{{ route('indexCPT') }}">
                    <i class="fa fa-arrow-circle-left"></i> Kembali
                </a>
            </h5>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h6>Create New Data</h6>
                    </div>
                </div>
                <form action="{{route('svcpt')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">ID Project</label>
                            <div class="col-sm-12 col-md-7">
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="ID Project" 
                                    id="code"
                                    name="id_project"
                                    value='{{old('id_project','')}}'
                                    autocomplete="Off"
                                    required
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Project Name</label>
                            <div class="col-sm-12 col-md-7">
                                <input 
                                    type="text" 
                                    class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" 
                                    name="project_name" 
                                    placeholder="Project Name" 
                                    autocomplete="Off"
                                    value='{{old('project_name','')}}'
                                    required
                                >
                                <p class="text-danger">{{ $errors->first('project_name') }}</p>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">principal</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="selectric-wrapper selectric-form-control selectric-selectric">
                                    <select class="form-control select2" name="principal_name" required>
                                        <option readOnly value="">----Pilih----</option>
                                        @foreach ($cp as $item)
                                            <option value="{{ $item->principal_name }}">{{ $item->principal_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Client</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="selectric-wrapper selectric-form-control selectric-selectric">
                                    <select class="form-control select2" name="client_name" required>
                                        <option readOnly value="">----Pilih----</option>
                                        @foreach ($cc as $item)
                                            <option value="{{ $item->client_name }}">{{ $item->client_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">File</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="file" accept = "application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">BMT - Awal</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="bmt_awal" 
                                        class="form-control uang" 
                                        value='{{old('bmt','')}}'
                                        name="bmt" 
                                        min=1
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Service</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="service" 
                                        class="form-control uang" 
                                        name="services" 
                                        min=1
                                        value='{{old('services','')}}'
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">lain-lain</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="other" 
                                        class="form-control uang" 
                                        aria-label="Amount" 
                                        name="lain" 
                                        value='{{old('lain','')}}'
                                        min=0
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">SubTotal</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="hidden" name="subtotal" id="subtotal" value="0">
                                    <div id="displaySubtotal" class="form-control"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bunga Admin</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control uang" id="admin_bunga" name="bunga_admin" min="1" max="100"  placeholder="" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Biaya Admin</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="hidden" name="biaya_admin" id="admin_cost">
                                    <div id="displayCost" class="form-control">0</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Biaya Pengurang (BPK)</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" id="decrement_cost" class="form-control uang" aria-label="Amount" name="biaya_pengurangan" min=0 required>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Final Subtotal</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                    </div>
                                    <div id="displayFinal" class="form-control">0</div>
                                    <input type="hidden" id="final_subtotal" class="form-control" name="final_subtotal" min=1>
                                </div>
                                <p class="text-sm text-muted">Subtotal <b>dari</b> Total BMT+Service - Final</p>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.min.js" integrity="sha512-hAJgR+pK6+s492clbGlnrRnt2J1CJK6kZ82FZy08tm6XG2Xl/ex9oVZLE6Krz+W+Iv4Gsr8U2mGMdh0ckRH61Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var subtotal = 0
        var admin_value = Number($("#admin_bunga").val())
        var final_subtotal = 0;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $("#bmt_awal").blur(function(e) {
                e.preventDefault();
                var value_bmt = $(this).val().replace(/\./g, ""),
                    service = $("#service").val().replace(/\./g, ""),
                    other = $("#other").val().replace(/\./g, "");

                subtotal += Number(value_bmt) || 0;
                subtotal += Number(service) || 0;
                subtotal += Number(other) || 0;

                let countSubtotal = subtotal
                const bunga_admin = (Number($("#admin_bunga").val()) / 100) * countSubtotal;
                
                $("#subtotal").val(countSubtotal)
                $("#displaySubtotal").text(numberWithCommas(countSubtotal));

                $("#admin_cost").val(bunga_admin);
                $("#displayCost").text(numberWithCommas(bunga_admin))

                subtotal = 0
            });

            $("#service").blur(function(e) {
                e.preventDefault();
                var service = $(this).val().replace(/\./g, ""),
                    value_bmt = $("#bmt_awal").val().replace(/\./g, ""),
                    other = $("#other").val().replace(/\./g, "");

                subtotal += Number(value_bmt) || 0;
                subtotal += Number(service) || 0;
                subtotal += Number(other) || 0;

                const countSubtotal = subtotal
                const bunga_admin = (Number($("#admin_bunga").val()) / 100) * countSubtotal;

                $("#subtotal").val(countSubtotal)
                $("#displaySubtotal").text(numberWithCommas(countSubtotal))

                subtotal = 0
            });

            $("#other").blur(function(e) {
                e.preventDefault();
                var other = $(this).val().replace(/\./g, ""),
                    value_bmt = $("#bmt_awal").val().replace(/\./g, ""),
                    service = $("#service").val().replace(/\./g, "");

                subtotal += Number(value_bmt) || 0;
                subtotal += Number(service) || 0;
                subtotal += Number(other) || 0;

                const countSubtotal = subtotal
                const bunga_admin = (Number($("#admin_bunga").val()) / 100) * countSubtotal;

                $("#subtotal").val(countSubtotal)
                $("#displaySubtotal").text(numberWithCommas(countSubtotal))

                subtotal = 0
            });

            $("#admin_bunga").blur(function(e) {
                e.preventDefault();
                var other = $("#other").val().replace(/\./g, ""),
                    value_bmt = $("#bmt_awal").val().replace(/\./g, ""),
                    service = $("#service").val().replace(/\./g, "");

                subtotal += Number(value_bmt) || 0;
                subtotal += Number(service) || 0;
                subtotal += Number(other) || 0;

                const countSubtotal = subtotal
                const bunga_admin = ($(this).val() / 100) * countSubtotal;

                $("#subtotal").val(countSubtotal)
                $("#displaySubtotal").text(numberWithCommas(countSubtotal))

                $("#admin_cost").val(bunga_admin);
                $("#displayCost").text(numberWithCommas(bunga_admin))
                // $("#displaySubtotal").text(numberWithCommas(bunga_admin));
            })

            $("#decrement_cost").blur(function(e) {
                e.preventDefault()
                
                const value_bpk = $(this).val().replace(/\./g, "")
                const subtotal = $("#subtotal").val().replace(/\./g, "");
                const admin_cost_value = $("#admin_cost").val().replace(/\./g, "");

                final_subtotal += Number(subtotal) || 0;
                final_subtotal -= Number(admin_cost_value)
                final_subtotal -= Number(value_bpk)

                const finalSubtotal = final_subtotal
                $("#displayFinal").text(numberWithCommas(finalSubtotal))
                $("#final_subtotal").val(finalSubtotal)

                final_subtotal = 0

            });
        });

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        
        $("#code_generate").on("click", function() {
            var generate = Math.floor(new Date().valueOf() * Math.random())
            $("#code").val(generate);
        })

        $( '.uang' ).mask('000.000.000.000.000', {reverse: true});
            
    </script>
@endsection