@if (Auth::user()->hasRole('Super Admin'))
<ul class="sidebar-menu">
  <li class="menu-header">Suoper Admin Tools</li>
  <li class="nav-item ">
    <a href="/dashboardSuperAdmin" class="nav-link "><span>Dashboard</span></a>
  </li>

  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-user"></i>User Managements</a>
      <div class="dropdown-menu" aria-labelledby="dropdown01">
      <a class="nav-link" href="{{route('/dashboard/role')}}">Role</a>
      <a class="nav-link" href="{{route('/dashboardPermision')}}">permision</a>
      <a class="nav-link" href="{{route('/dashboard/user')}}">User setting</a>
  </div>
</li>

<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-th"></i>Sales Monitoring</a>
  
    <div class="dropdown-menu" aria-labelledby="dropdown01">
    <a class="nav-link" href="{{route('/dashboard/salesOpty')}}">Sales Opty</a>
    <a class="nav-link" href="{{route('/dashboard/salesOrder')}}">Sales Order</a>
</div>
</li>

<li class=" nav-item"><a class="nav-link" href="/telearning"><i class="fas fa-clipboard-check"></i> <span class=" list-admin ">Create Elerning</span></a></li>

<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chart-pie"></i>Project Management</a>
  <div class="dropdown-menu" aria-labelledby="dropdown01">
    <a class="nav-link" href="/timeline">Project Timeline</a>
</div>
</li>

  <div class="mt-4 mb-4 p-4 hide-sidebar-mini">
    {{-- {{auth()->user()->role_id}} --}}
  <form action="/logout" method="POST">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>
  </div>
</ul>
@endif


{{-- !Project Admin --}}
@if (Auth::user()->hasRole('Project Admins'))
<ul class="sidebar-menu">
  <li class="menu-header">admin Tools</li>
  <li class="nav-item ">
  <a href="#" class="nav-link "><i class="fas fa-chart-pie"></i><span>Dashboard</span></a>
  </li>
  <li class=" nav-item"><a class="nav-link" href="/adminproject"><i class="fas fa-clipboard-check"></i> <span class=" list-admin ">list Project admin</span></a></li>
  <li class="nav-item"><a class="nav-link" href="/adminproject/sales"><i class="fas fa-file-alt"></i> <span class="list-sales-admin">List Sales Opty</span></a></li>
  <li class="nav-item mt-3 d-block  ">
    <form action="/logout" method="POST">
      @csrf
      <button class="btn btn-danger">Logout</button>
    </form>
  </li>
</ul>
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
  <li class="nav-item"><a class="nav-link" href="/slistpa"><i class="fas fa-file-upload"></i> <span>List Project Admin</span></a></li>
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
  <li class="nav-item"><a class="nav-link" href="/inputTwo"><i class="fas fa-edit"></i> <span>List view aprove</span></a></li>
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
  <li class="nav-item"><a class="nav-link" href="{{url ('list_project')}}"><img src="image/Line.png" alt=""> <span>List View Project</span></a></li>
  <li class="nav-item"><a class="nav-link" href="{{url ('index-list')}}"><img src="image/Line.png" alt=""> <span>List Project Technikal</span></a></li>
  <li class="nav-item"><a class="nav-link" href="{{url ('timeline')}}"><img src="image/Akar.png" alt=""> <span>Create Project Timeline</span></a></li>


  <div class="mt-4 mb-4 p-4 hide-sidebar-mini">
    <form action="/logout" method="POST">
      @csrf

  </div>

  <button class="btn btn-danger" style="margin-top: -10em; margin-left:5em; border-radius:10px; width:12em">Logout</button>

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
  <li class="nav-item"><a class="nav-link" href="{{url ('lpadminpmlead')}}"><img src="image/Akar.png" alt=""> <span>List Project Admin</span></a></li>
  <li class="nav-item"><a class="nav-link" href="{{url ('lpadminpmlead')}}"><img src="image/Akar.png" alt=""> <span>List Project Sales Opty</span></a></li>
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
  <li class="nav-item"><a class="nav-link" href="/viewproject"><i class="fa-solid fa-clipboard-list" style="color: white"></i><span>List View Project</span></a></li>
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


{{-- !Technikal Lead --}}
@if (Auth::user()->hasRole('Technikal Lead'))
<ul class="sidebar-menu">
  <li class="menu-header">Technikal Tools</li>
  <li class="nav-item ">
    <a href="/dashboard" class="nav-link "><i class="fas fa-chart-pie"></i><span>Dashboard</span></a>
  </li>
  <li class="nav-item"><a class="nav-link" href="/TechnikalLead"><i class="fas fa-clipboard-check"></i> <span class="">List Project Admin</span></a></li>
  <li class="nav-item"><a class="nav-link" href="/tlWeeklyReport"><i class="fas fa-file-alt"></i> <span>Weekly Report</span></a></li>
  <li class="nav-item"><a class="nav-link" href="/leadListSalesOpty"><i class="fas fa-edit"></i> <span>View Sales Opty </span></a></li>
  <li class="nav-item"><a class="nav-link" href="/inputTwos"><i class="fas fa-file-alt"></i> <span>View Wo</span></a></li>
  <li class="nav-item mt-3 d-block  ">
    <form action="/logout" method="POST">
      @csrf
      <button class="btn btn-danger">Logout</button>
    </form>
  </li>
</ul>
@endif

{{-- ! Finance --}}
@if (Auth::user()->hasRole('Finance'))
<form action="/logout" method="POST">
  @csrf
  <button class="btn btn-danger">Logout</button>
</form>
@endif

{{-- <script>
  let admin = document.querySelector('.list-admin');
  let salesOpty = document.querySelector('.list-sales-admin');

  salesOpty.addEventListener('click', function () { 
    admin.classList.remove(`text-primary`);    
    salesOpty.classList.add(`text-primary`); 
  })
</script> --}}