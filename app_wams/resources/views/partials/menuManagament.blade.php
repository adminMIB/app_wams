<ul class="sidebar-menu">
  <li class="menu-header">Management</li>
  <li class="nav-item ">
    <a href="/dashboard" class="nav-link "><i class="fas fa-chart-pie"></i><span>Dashboard</span></a>
  {{-- </li>
  <li class="dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>User Management</span></a>
    <ul class="dropdown-menu" style="display: none;">
      <li><a class="nav-link" href="{{route('/dashboard/role')}}">Role</a></li>
      <li><a class="nav-link" href="{{route('/dashboardPermision')}}">permision</a></li>
      <li><a class="nav-link" href="{{route('/dashboard/user')}}">User setting</a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Sales Monitoring</span></a>
    <ul class="dropdown-menu" style="display: none;">
      <li><a class="nav-link" href="{{route('/dashboard/salesOpty')}}">Sales Opty</a></li>
      <li><a class="nav-link" href="{{route('/dashboard/salesOrder')}}">Sales Order</a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Project Management</span></a>
    <ul class="dropdown-menu" style="display: none;">
      <li><a class="nav-link" href="{{route('/dashboard/projectTimeline')}}">Project Timeline</a></li>
    </ul>
  </li> --}}
  {{-- <li class="nav-item"><a class="nav-link" href="/reportp"><i class="fas fa-file-alt"></i> <span>Report Project</span></a></li>
  <li class="nav-item"><a class="nav-link" href="/inputwo"><i class="fas fa-edit"></i> <span>Input Work Order</span></a></li>
  <li class="nav-item"><a class="nav-link" href="/listd"><i class="fas fa-file-alt"></i> <span>List Document</span></a></li> --}}
  <div class="mt-4 d mb-4 p-4 hide-sidebar-mini">
    {{-- {{auth()->user()->role_id}} --}}
  <form action="/logout" method="POST">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>
   
  </div>
</ul>

