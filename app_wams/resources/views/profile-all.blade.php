@extends('layouts.main') @section('content')
<section class="section">
<div class="card">
        <div class="card-header mt-4">
            <h3>PROFILE </h3>
        </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <form action=""  id="profile" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="card-body box-profile">
                            <div class="text-center">
                                <input type="hidden" id="uid" value="{{ $user->id }}">
                                @php($avatar = auth()->user()->avatar)  
                                <img src="@if($avatar == null){{asset('image/user.png')}} @else {{ asset('storage/users/'.$user->avatar) }}@endif " class="profile-user-img img-fluid img-cricle rounded-cricle border" style="width: 150px; height: 150px; border-radius: 10px;" alt="" id="avatar_preview">
                            </div>
                            <h5 class="profile-username text-center mt-1" id="name">{{$user->name}}</h5>
                            <p class="text-muted text-center" style="font-size:13px" id="email">{{$user->email}}</p>
                            <input type="file" class="d-none" id="avatar" name="avatar">
                            <label for="avatar" class="text-center pt-10 btn btn-primary"
                            style="width: 150px; cursor: pointer;">Pilih
                            Foto Profile</label>
                            </div>
                            
                            </div>
                        </div>

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#change password" data-toggle="tab">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="tab-pane" id="settings">
                                                <div class="form-group row mt-2">
                                                    <label for="password" class="col-sm-2 col-form-label">New Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                                                        @error('password')
                                                        <div class="text-danger mt-2">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                                    </div>
                                                </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-success" style="float: right">Save</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

    @section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">

    $(document).ready(function () {
            $("#avatar").change(function () {
                let reader = new FileReader();

                reader.onload = (e) => {
                    $("#avatar_preview").attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            })
        });

        $('#profile').submit(function (e) {
            e.preventDefault();
            let id = $("#uid").val();
            let formData = new FormData(this);
            formData.append('name', $("#name").val());
            formData.append('email', $("#email").val());
            formData.append('password', $("#password").val());
            formData.append('password_confirmation',$("#password_confirmation").val());

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{url('update-all')}}/" + id,
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'json',
                success: function (response) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 6000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Update successfully'
                    });

                    location.replace("/profile-all");
                    
                }
            });
        });
    </script>
@endsection
