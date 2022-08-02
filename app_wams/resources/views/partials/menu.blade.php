

@if (Auth::user()->hasRole('Super Admin'))
  <ul class="sidebar-menu">
    <li class="menu-header">Management Tools</li>
    <li class="nav-item ">
      <a href="{{route('/dashboardSuperAdmin')}}" class="nav-link "><i class="fas fa-chart-pie"></i><span>Dashboard</span></a>
    </li>
    <li class="dropdown">
      <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>User Managements</span></a>
      <ul class="dropdown-menu bg-white">
        <li><a class="nav-link" href="{{route('/dashboard/role')}}">Role</a></li>
        <li><a class="nav-link" href="{{route('/dashboardPermision')}}">Permission</a></li>
        <li><a class="nav-link" href="{{route('/dashboard/user')}}">User Setting</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Sales Monitoring</span></a>
      <ul class="dropdown-menu bg-white">
        <li><a class="nav-link" href="{{route('/dashboard/salesOpty')}}">Sales Opty</a></li>
        <li><a class="nav-link" href="{{route('/dashboard/salesOrder')}}">Sales Order</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Project Managements</span></a>
      <ul class="dropdown-menu bg-white">
        <li><a class="nav-link" href="{{route('/dashboard/salesOpty')}}">Project Timeline</a></li>
      </ul>
    </li>
    <div class="mt-4 mb-4 p-4 hide-sidebar-mini">
      <form action="/logout" method="POST">
        @csrf
        <button class="btn btn-danger">Logout</button>
      </form>
    </div>
  </ul>
{{-- <ul class="sidebar-menu">
  <li class="menu-header">Management Tools</li>
  <li class="nav-item ">
    <a href="/dashboard" class="nav-link "><i class="fas fa-chart-pie"></i><span>Dashboard</span></a>
  </li>
  <li class="dropdown active">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>User Managements</span></a>
    <ul class="dropdown-menu" style="display: none;">
      <li><a class="nav-link" href="{{route('/dashboard/role')}}">Role</a></li>
      <li><a class="nav-link" href="{{route('/dashboardPermision')}}">permision</a></li>
      <li><a class="nav-link" href="{{route('/dashboard/user')}}">User setting</a></li>
    </ul>
  </li>

  <li class="dropdown ">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Sales Monitoring</span></a>
    <ul class="dropdown-menu" style="display: none;">
      <li><a class="nav-link" href="{{route('/dashboard/salesOpty')}}">Sales Opty</a></li>
      <li><a class="nav-link" href="{{route('/dashboard/salesOrder')}}">Sales Order</a></li>
    </ul>
  </li>

  <li class="dropdown   ">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Project Management</span></a>
    <ul class="dropdown-menu" style="display: none;">
      <li><a class="nav-link" href="">Project Timeline</a></li>
    </ul>
  </li>

  {{-- <li class="dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>User Managements</span></a>
    <ul class="dropdown-menu" style="display: none;">
      <li><a class="nav-link" href="{{route('/dashboard/role')}}">Role</a></li>
      <li><a class="nav-link" href="{{route('/dashboardPermision')}}">permision</a></li>
      <li><a class="nav-link" href="{{route('/dashboard/user')}}">User setting</a></li>
    </ul>
  </li> --}}
  {{-- <li class="dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Sales Monitoring</span></a>
    <ul class="dropdown-menu" style="display: none;">
      <li><a class="nav-link" href="{{route('/dashboard/salesOpty')}}">Sales Opty</a></li>
      <li><a class="nav-link" href="{{route('/dashboard/salesOrder')}}">Sales Order</a></li>
    </ul>
  </li> --}}
  {{-- <li class="dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Project Management</span></a>
    <ul class="dropdown-menu" style="display: none;">
      <li><a class="nav-link" href="">Project Timeline</a></li>
    </ul>
  </li> --}}
  {{-- <li class="nav-item"><a class="nav-link" href="/reportp"><i class="fas fa-file-alt"></i> <span>Report Project</span></a></li>
  <li class="nav-item"><a class="nav-link" href="/inputwo"><i class="fas fa-edit"></i> <span>Input Work Order</span></a></li>
  <li class="nav-item"><a class="nav-link" href="/listd"><i class="fas fa-file-alt"></i> <span>List Document</span></a></li> --}}
  {{-- <div class="mt-4 mb-4 p-4 hide-sidebar-mini"> --}}
    {{-- {{auth()->user()->role_id}} --}}
    {{-- <form action="/logout" method="POST">
      @csrf
      <button class="btn btn-danger">Logout</button>
    </form>
  </div>
</ul> --}}
@endif

{{-- ! AM/Sales --}}
@if (Auth::user()->hasRole('AM/Sales'))

  <ul class="sidebar-menu">
    <li class="menu-header">Management Tools</li>
    <li class="nav-item ">
      <a href="/dashboardAmSales" class="nav-link "><i class="fas fa-chart-pie"></i><span>Dashboard</span></a>
    </li>
    <li class="nav-item"><a class="nav-link" href="/slsorder"><i class="fas fa-keyboard"></i> <span>Sales Order</span></a></li>
    <li class="nav-item"><a class="nav-link" href="/index-sales"><i class="fas fa-file-invoice-dollar"></i> <span>Sales Opty</span></a></li>
    <li class="nav-item"><a class="nav-link" href="/selearning"><i class="fab fa-readme"></i> <span>Elearning</span></a></li>
    {{-- <li class="nav-item"><a class="nav-link" href="/updoc"><i class="fas fa-file-upload"></i> <span>Upload Document</span></a></li> --}}
    {{-- <li class="nav-item"><a class="nav-link" href="/upload"><i class="fas fa-file-upload"></i> <span>Upload Document</span></a></li> --}}
    <div class="mt-4 mb-4 p-4 hide-sidebar-mini">
      <form action="/logout" method="POST">
        @csrf
        <button class="btn btn-danger">Logout</button>
      </form>
    </div>
  </ul>
@endif

{{-- ! Management --}}
@if (Auth::user()->hasRole('Management'))
<ul class="sidebar-menu">
  <li class="menu-header">Management Tools</li>
  <li class="nav-item ">
    <a href="/dashboard" class="nav-link "><i class="fas fa-chart-pie"></i><span>Dashboard</span></a>
  </li>
  <li class="nav-item"><a class="nav-link" href="/approval"><i class="fas fa-clipboard-check"></i> <span class="">Approval SO</span></a></li>
  <li class="nav-item"><a class="nav-link" href="/reportp"><i class="fas fa-file-alt"></i> <span>Report Project</span></a></li>
  <li class="nav-item"><a class="nav-link" href="/inputTwo"><i class="fas fa-edit"></i> <span>Input Work Order</span></a></li>
  <li class="nav-item"><a class="nav-link" href="/listd"><i class="fas fa-file-alt"></i> <span>List Document</span></a></li>
  <li class="nav-item mt-3 d-block  ">
    <form action="/logout" method="POST">
      @csrf
      <button class="btn btn-danger">Logout</button>
    </form>
  </li>
</ul>




@endif

{{-- ! PM --}}
@if (Auth::user()->hasRole('PM'))
<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="nav-item ">
      <a href="{{url ('dashboardpm')}}" class="nav-link "><img src="image/Vector.png" alt=""><span>Dashboard</span></a>
    </li>
    <li class="nav-item"><a class="nav-link" href="{{url ('timeline')}}"><img src="image/Akar.png" alt=""> <span>Time Line</span></a></li>
    <li class="nav-item"><a class="nav-link" href="{{url ('listproject')}}"><img src="image/Line.png" alt=""> <span>List Project Technikal</span></a></li>

  <form action="/logout" method="POST">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>

</ul>
@endif

{{-- ! PMLead --}}
@if (Auth::user()->hasRole('PM Lead'))
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard Monitoring</li>
      <li class="nav-item ">
        <a href="{{url ('/dashboardlead')}}" class="nav-link "><img src="image/Vector.png" alt=""><span>Dashboard</span></a>
      </li>
      <li class="nav-item"><a class="nav-link" href="#"><img src="image/Akar.png" alt=""> <span>List Project Admin</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{url ('list')}}"><img src="image/Line.png" alt=""> <span>List View Order</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{url ('listprojectpm')}}"><img src="image/Line.png" alt=""> <span>List Project</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{url ('task')}}"><img src="image/Line.png" alt=""> <span>Task Progress Report</span></a></li>
    </ul>
    <div class="mt-4 mb-4 p-4 hide-sidebar-mini">
      <form action="/logout" method="POST">
        @csrf
        <button class="btn btn-danger">Logout</button>
      </form>
    </div>
@endif

{{-- ! Technikal --}}
@if (Auth::user()->hasRole('Technikal'))
<ul class="sidebar-menu">
    <li class="menu-header">Management Tools</li>
    <li class="nav-item ">
      <a href="/dashboardTeknikal" class="nav-link "><i class="fa-solid fa-gauge-high" style="color: white;"></i><span>Dashboard</span></a>
    </li>

    <li class="nav-item"><a class="nav-link" href="/report"><i class="fa-solid fa-clipboard-check" style="color: white"></i><span>Report Progress</span></a></li>
    <li class="nav-item"><a class="nav-link" href="/create"><i class="fa-solid fa-clipboard-list" style="color: white"></i><span>Create Weekly Report</span></a></li>
    <li class="nav-item"><a class="nav-link" href="/telearning"><i class="fa-solid fa-book" style="color: white"></i><span>Form Elearning</span></a></li>

   

    <div class="mt-4 mb-4 p-4 hide-sidebar-mini">
  <form action="/logout" method="POST">
    @csrf
   
    </div>
</ul>

    <button class="btn btn-danger" style="margin-top: -10em; margin-left:5em; border-radius:10px; width:12em">Logout</button>

</form>
@endif

{{-- ! Finance --}}
@if (Auth::user()->hasRole('Finance'))
  <form action="/logout" method="POST">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>
@endif

