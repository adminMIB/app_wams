@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="section-header">
        <h1>User</h1>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="card-body">
            <div class="text-right">
              <a href="{{route('/dashboard/addUser')}}" class="btn btn-primary">Add user</a>
          </div>
            <div>
              <p>search users by role</p>
              <select class="cari custom-select mb-3" onchange="myFunction()"   name="" id="cari" placeholder="sd">
                <option value="all">All Role</option> 
                <option value="Super Admin">Super Admin</option> 
                <option value="admin">Admin</option> 
                <option value="management">Management</option> 
                <option value="am/sales">AM/Sales</option> 
                <option value="PM">PM</option> 
                <option value="pmLead">PM Lead</option> 
                <option value="technikalLead">Technikal Lead</option> 
                <option value="technikal">Technikal</option> 
              </select>
            </div>
  
            {{-- !all role --}}
            <div class="all-role">
              <a href="/contoh/export_excel" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
              <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped mt-2">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Role</th>
                      <th scope="col">action</th>
                      </tr>
                  </thead>
                  @foreach ($user as $dd)
                  <tbody>
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$dd->name}}</td>
                      <td>{{$dd->email}}</td>
                      
                      @foreach($dd->roles as $d)
                      <td>{{$d->name}}</td>
                      @endforeach
                      <td>
                        <a href={{url('/editUser', $dd->id)}}>Edit</a> |
                        <a  onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" href="{{url('/dashboard/deleteUser',$dd->id)}}">Delete</a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                </table>
              </div>
            </div>

            {{-- !super admin --}}
            <div class="superAdmin d-none">
              <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Name</th>
                      <th class="text-white" scope="col">Email</th>
                      <th class="text-white" scope="col">Role</th>
                      <th class="text-white" scope="col">action</th>
                      </tr>
                  </thead>
                  @foreach ($superAdmin as $dd)
                  @foreach ($dd->users as $d)
                      
                  <tbody>
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$d->name}}</td>
                      <td>{{$d->email}}</td>
                      <td>{{$dd->name}}</td>
                      
                      {{-- @foreach($dd->roles as $d)
                      <td>{{$d->name}}</td>
                      @endforeach --}}
                      <td>
                        <a href={{url('/editUser', $dd->id)}}>Edit</a> |
                        <a href="{{url('/dashboard/deleteUser',$dd->id)}}">Delete</a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                  @endforeach
              </table>
            </div>

            {{-- !admin --}}
            <div class="admin d-none">
              <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Name</th>
                      <th class="text-white" scope="col">Email</th>
                      <th class="text-white" scope="col">Role</th>
                      <th class="text-white" scope="col">action</th>
                      </tr>
                  </thead>
                  @foreach ($admin as $dd)
                  @foreach ($dd->users as $d)
                  <tbody>
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$d->name}}</td>
                      <td>{{$d->email}}</td>
                      <td>{{$dd->name}}</td>
                      
                      {{-- @foreach($dd->roles as $d)
                      <td>{{$d->name}}</td>
                      @endforeach --}}
                      <td>
                        <a href={{url('/editUser', $dd->id)}}>Edit</a> |
                        <a href="{{url('/dashboard/deleteUser',$dd->id)}}">Delete</a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                  @endforeach
              </table>
            </div>

            {{-- !manaement --}}
            <div class="management d-none">
              <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Name</th>
                      <th class="text-white" scope="col">Email</th>
                      <th class="text-white" scope="col">Role</th>
                      <th class="text-white" scope="col">action</th>
                      </tr>
                  </thead>
                  @foreach ($management as $dd)
                  @foreach ($dd->users as $d)
                  <tbody>
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$d->name}}</td>
                      <td>{{$d->email}}</td>
                      <td>{{$dd->name}}</td>
                      
                      {{-- @foreach($dd->roles as $d)
                      <td>{{$d->name}}</td>
                      @endforeach --}}
                      <td>
                        <a href={{url('/editUser', $dd->id)}}>Edit</a> |
                        <a href="{{url('/dashboard/deleteUser',$dd->id)}}">Delete</a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                  @endforeach
              </table>
            </div>

            {{-- !amSales --}}
            <div class="am-sales d-none">
              <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Name</th>
                      <th class="text-white" scope="col">Email</th>
                      <th class="text-white" scope="col">Role</th>
                      <th class="text-white" scope="col">action</th>
                      </tr>
                  </thead>
                  @foreach ($amSales as $dd)
                  @foreach ($dd->users as $d)
                  <tbody>
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$d->name}}</td>
                      <td>{{$d->email}}</td>
                      <td>{{$dd->name}}</td>
                      
                      {{-- @foreach($dd->roles as $d)
                      <td>{{$d->name}}</td>
                      @endforeach --}}
                      <td>
                        <a href={{url('/editUser', $dd->id)}}>Edit</a> |
                        <a href="{{url('/dashboard/deleteUser',$dd->id)}}">Delete</a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                  @endforeach
              </table>
            </div>

            {{-- !pm --}}
            <div class="pm d-none">
              <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Name</th>
                      <th class="text-white" scope="col">Email</th>
                      <th class="text-white" scope="col">Role</th>
                      <th class="text-white" scope="col">action</th>
                      </tr>
                  </thead>
                  @foreach ($pm as $dd)
                  @foreach ($dd->users as $d)
                  <tbody>
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$d->name}}</td>
                      <td>{{$d->email}}</td>
                      <td>{{$dd->name}}</td>
                      
                      {{-- @foreach($dd->roles as $d)
                      <td>{{$d->name}}</td>
                      @endforeach --}}
                      <td>
                        <a href={{url('/editUser', $dd->id)}}>Edit</a> |
                        <a href="{{url('/dashboard/deleteUser',$dd->id)}}">Delete</a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                  @endforeach
              </table>
            </div>

            {{-- !pm lead --}}
            <div class="pmLead d-none">
              <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Name</th>
                      <th class="text-white" scope="col">Email</th>
                      <th class="text-white" scope="col">Role</th>
                      <th class="text-white" scope="col">action</th>
                      </tr>
                  </thead>
                  @foreach ($pmLead as $dd)
                  @foreach ($dd->users as $d)
                  <tbody>
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$d->name}}</td>
                      <td>{{$d->email}}</td>
                      <td>{{$dd->name}}</td>
                      
                      {{-- @foreach($dd->roles as $d)
                      <td>{{$d->name}}</td>
                      @endforeach --}}
                      <td>
                        <a href={{url('/editUser', $dd->id)}}>Edit</a> |
                        <a href="{{url('/dashboard/deleteUser',$dd->id)}}">Delete</a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                  @endforeach
              </table>
            </div>

            {{-- !technikalLead --}}
            <div class="technikalLead d-none">
              <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Name</th>
                      <th class="text-white" scope="col">Email</th>
                      <th class="text-white" scope="col">Role</th>
                      <th class="text-white" scope="col">action</th>
                      </tr>
                  </thead>
                  @foreach ($technikalLead as $dd)
                  @foreach ($dd->users as $d)
                  <tbody>
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$d->name}}</td>
                      <td>{{$d->email}}</td>
                      <td>{{$dd->name}}</td>
                      
                      {{-- @foreach($dd->roles as $d)
                      <td>{{$d->name}}</td>
                      @endforeach --}}
                      <td>
                        <a href={{url('/editUser', $dd->id)}}>Edit</a> |
                        <a href="{{url('/dashboard/deleteUser',$dd->id)}}">Delete</a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                  @endforeach
              </table>
            </div>

            {{-- !technikal --}}
            <div class="technikal d-none">
              <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Name</th>
                      <th class="text-white" scope="col">Email</th>
                      <th class="text-white" scope="col">Role</th>
                      <th class="text-white" scope="col">action</th>
                      </tr>
                  </thead>
                  @foreach ($technikal as $dd)
                  @foreach ($dd->users as $d)
                  <tbody>
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$d->name}}</td>
                      <td>{{$d->email}}</td>
                      <td>{{$dd->name}}</td>
                      
                      {{-- @foreach($dd->roles as $d)
                      <td>{{$d->name}}</td>
                      @endforeach --}}
                      <td>
                        <a href={{url('/editUser', $dd->id)}}>Edit</a> |
                        <a href="{{url('/dashboard/deleteUser',$dd->id)}}">Delete</a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                  @endforeach
              </table>
            </div>
            {{ $user->links() }}
        </div>
        </div>
      </div>
    </section>

    <script>

      function myFunction() {
        let cari  = document.querySelector(".cari").value;
        let allRole = document.querySelector(".all-role");
        let superAdmin = document.querySelector(".superAdmin");
        let admin = document.querySelector(".admin");
        let management = document.querySelector(".management");
        let amSales = document.querySelector(".am-sales");
        let pm = document.querySelector(".pm");
        let pmLead = document.querySelector(".pmLead");
        let technikal = document.querySelector(".technikal");
        let technikalLead = document.querySelector(".technikalLead");

        if (cari === "Super Admin") {
          // hapus tampilan awal
          allRole.classList.add('d-none')
          //lalu munculkan user super admin
          superAdmin.classList.remove(`d-none`);
          admin.classList.add(`d-none`);
          management.classList.add('d-none');
          amSales.classList.add('d-none');
          pm.classList.add('d-none');
          pmLead.classList.add('d-none');
          technikal.classList.add('d-none');
          technikalLead.classList.add('d-none');
        } 
        if (cari === "all") {
          allRole.classList.remove('d-none')
          superAdmin.classList.add(`d-none`);
          admin.classList.add(`d-none`);
          management.classList.add('d-none');
          amSales.classList.add('d-none');
          pm.classList.add('d-none');
          pmLead.classList.add('d-none');
          technikal.classList.add('d-none');
          technikalLead.classList.add('d-none');
        }
        if (cari === 'admin') {
          admin.classList.remove('d-none');
          allRole.classList.add('d-none')
          superAdmin.classList.add('d-none');
          management.classList.add('d-none');
          amSales.classList.add('d-none');
          pm.classList.add('d-none');
          pmLead.classList.add('d-none');
          technikal.classList.add('d-none');
          technikalLead.classList.add('d-none');
        }
        if (cari === 'management') {
          management.classList.remove('d-none')
          allRole.classList.add('d-none')
          superAdmin.classList.add('d-none')
          admin.classList.add('d-none');
          amSales.classList.add('d-none');
          pm.classList.add('d-none');
          pmLead.classList.add('d-none');
          technikal.classList.add('d-none');
          technikalLead.classList.add('d-none');
        }
        if (cari === 'am/sales') {
          amSales.classList.remove('d-none');
          allRole.classList.add('d-none')
          superAdmin.classList.add('d-none')
          admin.classList.add('d-none');
          management.classList.add('d-none');
          pm.classList.add('d-none');
          pmLead.classList.add('d-none');
          technikal.classList.add('d-none');
          technikalLead.classList.add('d-none');
        }
        if (cari === 'PM') {
          pm.classList.remove('d-none');
          allRole.classList.add('d-none')
          superAdmin.classList.add('d-none')
          admin.classList.add('d-none');
          management.classList.add('d-none');
          amSales.classList.add('d-none');
          pmLead.classList.add('d-none');
          technikal.classList.add('d-none');
          technikalLead.classList.add('d-none');
        }
        if (cari === 'pmLead') {
          pmLead.classList.remove('d-none');
          allRole.classList.add('d-none')
          superAdmin.classList.add('d-none')
          admin.classList.add('d-none');
          management.classList.add('d-none');
          amSales.classList.add('d-none');
          pm.classList.add('d-none');
          technikal.classList.add('d-none');
          technikalLead.classList.add('d-none');
        }
        if (cari === 'technikal') {
          technikal.classList.remove('d-none');
          allRole.classList.add('d-none')
          superAdmin.classList.add('d-none')
          admin.classList.add('d-none');
          management.classList.add('d-none');
          amSales.classList.add('d-none');
          pm.classList.add('d-none');
          pmLead.classList.add('d-none');
          technikalLead.classList.add('d-none');
        }
        if (cari === 'technikalLead') {
          technikalLead.classList.remove('d-none');
          allRole.classList.add('d-none')
          superAdmin.classList.add('d-none')
          admin.classList.add('d-none');
          management.classList.add('d-none');
          amSales.classList.add('d-none');
          pm.classList.add('d-none');
          pmLead.classList.add('d-none');
          technikal.classList.add('d-none');

        }
      }

</script>

@endsection
      



