@if (Auth::user()->hasRole('Super Admin'))

<ul class="sidebar-menu">
  <li class="menu-header">Super Admin Tools</li>
  <li class="nav-item mt-4">
    <a class="nav-link {{request()->is('dashboardSuperAdmin') ? 'text-primary bg-white' : ''}}" href="/dashboardSuperAdmin""><i class="fas fa-th-large"></i> <span class=" list-admin {{request()->is('dashboardSuperAdmin') ? 'text-primary font-weight-normal' : ''}}">Dashboard</span></a>
  </li>
  
  <li class="nav-item ">
    <a class="nav-link {{request()->is('superAdminAllMenu') ? 'text-primary bg-white' : ''}}" href="/superAdminAllMenu"><i class="fas fa-th-large"></i> <span class=" list-admin {{request()->is('superAdminAllMenu') ? 'text-primary font-weight-normal' : ''}}">All Menu</span></a>
  </li>

  <li class="nav-item ">
    <a class="nav-link collapsed {{request()->is('dashboard/role') || request()->is('dashboardPermision') || request()->is('dashboard/user') ? 'text-primary bg-white' : ''}} " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <i class="far fa-user"></i>
      <span style="" class="menu-title {{request()->is('dashboard/role') || request()->is('dashboardPermision') || request()->is('dashboard/user') ? 'text-primary font-weight-normal' : ''}}">User Managements</span>
    </a>
    <div class="collapse" id="ui-basic" style="">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link  {{ request()->is('dashboard/role') ? 'text-primary font-weight-normal' : '' }}" href="{{route('/dashboard/role')}}">Role</a></li>
        <li class="nav-item"> <a class="nav-link {{ request()->is('dashboardPermision') ? 'text-primary font-weight-normal' : '' }}" href="{{route('/dashboardPermision')}}" href="{{route('/dashboardPermision')}}">permision</a></li>
        <li class="nav-item"> <a class="nav-link {{ request()->is('dashboard/user') ? 'text-primary font-weight-normal' : '' }}" href="{{route('/dashboard/user')}}">User setting</a></li>
      </ul>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed  {{request()->is('adminproject/sales') || request()->is('dashboard/salesOrder') || request()->is('slsorder') ? 'text-primary bg-white' : ''}}" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
      <i class="fab fa-readme"></i>
      <span style="" class="menu-title {{request()->is('adminproject/sales') || request()->is('dashboard/salesOrder') || request()->is('slsorder') ? 'text-primary font-weight-normal' : ''}}">Sales Monitoring</span>
    </a>

    <div class="collapse" id="ui-basic2" style="">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link list-admim  {{ request()->is('adminproject/sales') ? 'text-primary font-weight-normal' : '' }}" href="/adminproject/sales">Sales Pipelane</a></li>
        <li class="nav-item"><a class="nav-link  {{ request()->is('slsorder') ? 'text-primary font-weight-normal' : '' }}" href="/slsorder">Sales Order</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed {{request()->is('umViewPiplane') || request()->is('reportp') || request()->is('umViewPm') || request()->is('umViewAdmin')  ? 'text-primary bg-white' : ''}}" data-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic5">
      <i class="fas fa-file-alt"></i>
      <span style="" class="menu-title {{request()->is('umViewPiplane') || request()->is('reportp')  || request()->is('umViewPm') || request()->is('umViewAdmin') ? 'text-primary font-weight-normal' : ''}}">Report </span>
      {{-- <svg width="23" height="23" viewBox="0 0 24 24"  fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.57133 8.74277C3.7134 8.50598 4.02053 8.42919 4.25732 8.57127L12.0001 14.4169L19.7428 8.57127C19.9796 8.42919 20.2867 8.50598 20.4288 8.74277C20.5709 8.97956 20.4941 9.28669 20.2573 9.42876L12.2573 15.4288C12.099 15.5238 11.9012 15.5238 11.7428 15.4288L3.74283 9.42876C3.50604 9.28669 3.42926 8.97956 3.57133 8.74277Z" fill="#FFFFFF"></path></svg> --}}
    </a>
    <div class="collapse" id="ui-basic5" style="">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link {{ request()->is('umViewPiplane') ? 'text-primary font-weight-normal' : '' }} " href="/umViewPiplane">Report Pipelane</a></li>
        <li class="nav-item">
          <a href="/reportp" class="nav-link {{request()->is('reportp') ? 'text-primary font-weight-normal' : '' }} " >
            Report Technikal
          </a>
        </li>
        <li class="nav-item"><a class="nav-link  {{request()->is('umViewPm') ? 'text-primary font-weight-normal' : '' }}" href="/umViewPm">Report Timeline PM</a></li>
        <li class="nav-item"><a class="nav-link  {{request()->is('umViewAdmin') ? 'text-primary font-weight-normal' : '' }}"" href="/umViewAdmin">List Project Admin</a></li>
      </ul>
    </div>
    {{-- <div class="collapse" id="ui-basic5" style="">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="umViewPiplane">Report Pipelane</a></li>
        <li class="nav-item">
          <a class="nav-link {{request()->is('') ? 'text-primary bg-white' : ''}}" href="/reportp">
            <span class="{{request()->is('') ? 'text-primary font-weight-normal' : ''}}">Report Project Technikal</span>
          </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="/umViewPm">Report Timeline PM</a></li>
        <li class="nav-item"><a class="nav-link" href="/adminproject">List Project Admin</a></li>
      </ul>
    </div> --}}
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic2">
      <i class="fas fa-chart-pie"></i>
      <span style="" class="menu-title">Project Management</span>
    </a>
    <div class="collapse" id="ui-basic3" style="">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="/timeline">Project Timeline</a></li>
      </ul>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link {{request()->is('telearning') ? 'text-primary bg-white' : ''}}" href="/telearning"><i class="fas fa-clipboard-check"></i> <span class=" list-admin {{request()->is('telearning') ? 'text-primary font-weight-normal' : ''}}">Create Elerning</span></a>
  </li>

  <li class="nav-item d-block">
    <form action="/logout" method="POST" style="">
      @csrf
      <button class="btn text-white btn-lg " style="margin-top: 60px; width:200px; background-color: #FF7C57">Logout</button>
    </form>
  </li>
</ul>
@endif


{{-- !Project Admin --}}
@if (Auth::user()->hasRole('Project Admins'))
<ul class="sidebar-menu">
  <li class="menu-header">admin Tools</li>
  <li class="nav-item mt-4">
  <a href="/dashboardAdmin" class="nav-link {{request()->is('dashboardAdmin')  ? 'text-primary bg-white' : ''}} "><i class="fas fa-chart-pie"></i><span class="{{request()->is('dashboardAdmin')  ? 'text-primary font-weight-normal' : ''}} ">Dashboard</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link  {{request()->is('adminproject') || request()->is('adminproject/create') ? 'text-primary bg-white' : ''}}" href="/adminproject">
      <i class="fas fa-clipboard-check"></i> <span class="list-admin {{request()->is('adminproject') || request()->is('adminproject/create') ? 'text-primary font-weight-normal' : ''}}">list Project admin</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{request()->is('adminproject/sales') ? 'text-primary bg-white' : ''}}" href="/adminproject/sales">
      <i class="fas fa-file-alt"></i>
      <span class="list-sales-admin  {{request()->is('adminproject/sales') ? 'text-primary font-weight-normal' : ''}} ">List Sales Pipelane </span>
    </a>
  </li>
  <li class="nav-item mt-4 d-block">
    <form action="/logout" method="POST" style="">
      @csrf
      <button class="btn text-white btn-lg " style="margin-top: 230px; width:200px; background-color: #FF7C57">Logout</button>
    </form>
  </li>
</ul>
@endif

{{-- ! AM/Sales --}}
@if (Auth::user()->hasRole('AM/Sales'))

<ul class="sidebar-menu">
  <li class="menu-header">Management Tools</li>
  <li class="nav-item ">
    <a href="/dashboardAmSales" class="nav-link {{request()->is('dashboardAmSales') ? 'text-primary bg-white' : ''}} "><i class="fas fa-chart-pie"></i><span class=" {{request()->is('dashboardAmSales') ? 'text-primary font-weight-normal' : ''}} ">Dashboard</span></a>
  </li>
  <li class="nav-item"><a class="nav-link nav-link {{request()->is('slsorder') || request()->is('createodr') ? 'text-primary bg-white' : ''}}" href="/slsorder"><i class="fas fa-keyboard"></i> <span class="{{request()->is('slsorder') || request()->is('createodr')? 'text-primary font-weight-normal' : ''}}">LTO</span></a></li>
  <li class="nav-item"><a class="nav-link {{request()->is('index-sales') || request()->is('inputsales') ? 'text-primary bg-white' : ''}}" href="/index-sales"><i class="fas fa-file-invoice-dollar"></i> <span class="{{request()->is('index-sales') || request()->is('inputsales') ? 'text-primary font-weight-normal' : ''}}">Sales Pipeline</span></a></li>
  {{-- <li class="nav-item"><a class="nav-link" href="/produksolusi"><i class="fas fa-file-invoice-dollar"></i> <span>Product / Solution</span></a></li> --}}
  <li class="nav-item"><a class="nav-link {{request()->is('reportPTech') ? 'text-primary bg-white' : ''}}" href="/reportPTech"><i class="fab fa-readme"></i> <span class="{{request()->is('reportPTech') ? 'text-primary  font-weight-normal' : ''}}">Report Task Progress</span></a></li>
  <li class="nav-item"><a class="nav-link {{request()->is('selearning') ? 'text-primary bg-white' : ''}}" href="/selearning"><i class="fab fa-readme"></i> <span class="{{request()->is('selearning') ? 'text-primary  font-weight-normal' : ''}}">Elearning</span></a></li>
  <li class="nav-item"><a class="nav-link {{request()->is('slistpa') ? 'text-primary bg-white' : ''}}" href="/slistpa"><i class="fas fa-file-upload"></i> <span class="{{request()->is('slistpa') ? 'text-primary  font-weight-normal' : ''}}">List Project Admin</span></a></li>
  {{-- <li class="nav-item"><a class="nav-link" href="/upload"><i class="fas fa-file-upload"></i> <span>Upload Document</span></a></li> --}}
  <li class="nav-item d-block">
    <form action="/logout" method="POST" style="">
      @csrf
      <button class="btn text-white btn-lg " style="margin-top: 150px; width:200px; background-color: #FF7C57">Logout</button>
    </form>
  </li>
</ul>
@endif

{{-- ! Management --}}
@if (Auth::user()->hasRole('Management'))
<ul class="sidebar-menu " style="">
  <li class="menu-header">Management Tools</li>
  <li class="nav-item ">
    <a href="{{route('umdashboard')}}" class="nav-link {{request()->is('umdashboard') ? 'text-primary bg-white' : ''}}">
      <i class="fas fa-chart-pie"></i>
      <span class="{{request()->is('umdashboard') ? 'text-primary font-weight-normal' : ''}}">Dashboard</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{request()->is('approval') ? 'text-primary bg-white' : ''}}" href="/approval">
      <i class="fas fa-clipboard-check"></i>
      <span class="{{request()->is('approval') ? 'text-primary font-weight-normal' : ''}}">Approval SO</span>
    </a>
  </li>
  {{-- <li class="nav-item">
    <a class="nav-link {{request()->is('reportp') ? 'text-primary bg-white' : ''}}" href="/reportp">
      <i class="fas fa-file-alt"></i>
      <span class="{{request()->is('reportp') ? 'text-primary font-weight-normal' : ''}}">Report Project</span>
    </a>
  </li> --}}
  <li class="nav-item">
    <a class="nav-link {{request()->is('inputTwo') ? 'text-primary bg-white' : ''}}" href="/inputTwo">
      <i class="fas fa-edit"></i>
      <span class="{{request()->is('inputTwo') ? 'text-primary font-weight-normal' : ''}}">List view aprove</span>
    </a>
</li>
  <li class="nav-item">
    <a class="nav-link  {{request()->is('listd') ? 'text-primary bg-white' : ''}}" href="/listd">
      <i class="fas fa-file-alt"></i>
      <span class="{{request()->is('listd') ? 'text-primary font-weight-normal' : ''}}">List Document</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed {{request()->is('umViewPiplane') || request()->is('reportp') || request()->is('umViewPm') || request()->is('umViewAdmin')  ? 'text-primary bg-white' : ''}}" data-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic5">
      <i class="fas fa-file-alt"></i>
      <span style="" class="menu-title {{request()->is('umViewPiplane') || request()->is('reportp')  || request()->is('umViewPm') || request()->is('umViewAdmin') ? 'text-primary font-weight-normal' : ''}}">Report </span>
    </a>
    <div class="collapse" id="ui-basic5" style="">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link {{ request()->is('umViewPiplane') ? 'text-primary font-weight-normal' : '' }} " href="{{route('umViewPiplane')}}">Report Pipelane</a></li>
        <li class="nav-item">
          <a href="/reportp" class="nav-link {{request()->is('reportp') ? 'text-primary font-weight-normal' : '' }} " >
            Report Technikal
          </a>
        </li>
        <li class="nav-item"><a class="nav-link  {{request()->is('umViewPm') ? 'text-primary font-weight-normal' : '' }}" href="/umViewPm">Report Timeline PM</a></li>
        <li class="nav-item"><a class="nav-link  {{request()->is('umViewAdmin') ? 'text-primary font-weight-normal' : '' }}"" href="/umViewAdmin">Report Project Admin</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item d-block" style="margin-top: -15px;">
    <form action="/logout" method="POST" style="">
      @csrf
      <button class="btn text-white btn-lg " style="margin-top: 200px; width:200px; background-color: #FF7C57">Logout</button>
    </form>
  </li>
</ul>
@endif

{{-- ! PM --}}
@if (Auth::user()->hasRole('PM'))
<ul class="sidebar-menu">
  <li class="menu-header">Dashboard</li>
  <li class="nav-item ">
    <a style="font-size:12px" href="{{url ('dashboardpm')}}" class="nav-link {{request()->is('dashboardpm') ? 'text-primary bg-white' : ''}} ">
      <i class="fas fa-gauge"></i>
      <span class="{{request()->is('dashboardpm') ? 'text-primary font-weight-normal' : ''}}">Dashboard</span>
    </a>
  </li>
  <li class="nav-item ">
    <a class="nav-link collapsed   " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <i class="fas fa-eye"></i>
      <span style="font-size:12px" class="menu-title  'text-primary font-weight-normal' : ''}}">List View Project</span>
    </a>
    <div class="collapse" id="ui-basic" style="">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link {{request()->is('list_project') ? 'text-primary bg-white' : ''}}"  href="{{url ('list_project')}}" style="font-size:12px">View Project Admin</a></li>
        <li class="nav-item"> <a class="nav-link {{request()->is('list_so') ? 'text-primary bg-white' : ''}}"  href="{{url ('list_so')}}" style="font-size:12px">View Project SO</a></li>
        <li class="nav-item"> <a class="nav-link {{request()->is('list_sp') ? 'text-primary bg-white' : ''}}"  href="{{url('list_sp  ')}}" style="font-size:12px">View Sales Pipelane</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item ">
    <a class="nav-link {{request()->is('timeline') ? 'text-primary bg-white' : ''}} " href="{{url ('timeline')}}"> 
      <i class="fas fa-briefcase"></i>
    <span style="font-size: 12px" class="{{request()->is('timeline') ? 'text-primary font-weight-normal' : ''}}" >Create Project Timeline</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{request()->is('report-timeline') ? 'text-primary bg-white' : ''}} " href="{{url('report-timeline')}}">
      <i class="fas fa-file"></i>
      <span style="font-size: 12px" class="{{request()->is('report-timeline') ? 'text-primary font-weight-normal' : ''}}"  >Report Timeline</span>
    </a>
  </li>
  <li class="nav-item  ">
    <a class="nav-link {{request()->is('task') ? 'text-primary bg-white' : ''}} " href="{{url ('task')}}">
      <i class="fas fa-spinner"></i>
      <span style="font-size: 12px" class="{{request()->is('task') ? 'text-primary font-weight-normal' : ''}}" >Task Progress Report</span>
    </a>
  </li>

  <li class="nav-item d-block">
    <form action="/logout" method="POST" style="">
      @csrf
      <button class="btn text-white btn-lg " style="margin-top: 200px; width:200px; background-color: #FF7C57">Logout</button>
    </form>
  </li>
</ul>
@endif


{{-- ! Technikal --}}
@if (Auth::user()->hasRole('Technikal'))
<ul class="sidebar-menu">
  <li class="menu-header">Management Tools</li>
  <li class="nav-item ">
    <a href="/dashboardTeknikal" class="nav-link {{request()->is('dashboardTeknikal') ? 'text-primary bg-white' : ''}}"><i class="fa-solid fa-gauge-high"></i><span class="{{request()->is('dashboardTeknikal') ? 'text-primary font-weight-normal' : ''}}">Dashboard</span></a>
  </li>
  {{-- <li class="nav-item"><a class="nav-link {{request()->is('viewproject') ? 'text-primary bg-white' : ''}}" href="/viewproject"><i class="fa-solid fa-clipboard-list"></i><span class="{{request()->is('viewproject') ? 'text-primary font-weight-normal' : ''}}">List View Project</span></a></li> --}}
  <li class="nav-item ">
    <a class="nav-link collapsed  'text-primary bg-white' : ''}} " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <i class="far fa-user"></i>
      <span style="" class="menu-title  'text-primary font-weight-normal' : ''}}">List View Project</span>
    </a>
    <div class="collapse" id="ui-basic" style="">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link {{request()->is('viewproject') ? 'text-primary bg-white' : ''}}" href="/viewproject"><i class="fa-solid fa-clipboard-list"></i><span class="{{request()->is('viewproject') ? 'text-primary font-weight-normal' : ''}}">View Project Admin</span></a></li>
        <li class="nav-item"><a class="nav-link {{request()->is('sales_pipeline') ? 'text-primary bg-white' : ''}}" href="/sales_pipeline"><i class="fa-solid fa-clipboard-list"></i><span class="{{request()->is('sales_pipeline') ? 'text-primary font-weight-normal' : ''}}">View Sales Pipelane</span></a></li>
        <li class="nav-item"><a class="nav-link {{request()->is('sales_order') ? 'text-primary bg-white' : ''}}" href="/sales_order"><i class="fa-solid fa-clipboard-list"></i><span class="{{request()->is('sales_order') ? 'text-primary font-weight-normal' : ''}}">View Sales Order</span></a></li>
        <li class="nav-item"><a class="nav-link {{request()->is('viewtime') ? 'text-primary bg-white' : ''}}" href="/viewtime"><i class="fa-solid fa-clipboard-list"></i><span class="{{request()->is('viewtime') ? 'text-primary font-weight-normal' : ''}}">View Project Timeline</span></a></li>
      </ul>
    </div>
  </li>

  <li class="nav-item"><a class="nav-link {{request()->is('report') ? 'text-primary bg-white' : ''}}" href="/report"><i class="fa-solid fa-clipboard-check"></i><span class="{{request()->is('report') ? 'text-primary font-weight-normal' : ''}}">Report Progress</span></a></li>
  <li class="nav-item"><a class="nav-link {{request()->is('telearning') ? 'text-primary bg-white' : ''}}" href="/telearning"><i class="fa-solid fa-book"></i><span class="{{request()->is('telearning') ? 'text-primary font-weight-normal' : ''}}">Form Elearning</span></a></li>
  <li class="nav-item"><a class="nav-link {{request()->is('sales_pipeline') ? 'text-primary bg-white' : ''}}" href="/sales_pipeline"><i class="fa-solid fa-clipboard-list"></i><span class="{{request()->is('sales_pipeline') ? 'text-primary font-weight-normal' : ''}}">Sales Pipelane</span></a></li>
  <li class="nav-item d-block">
    <form action="/logout" method="POST" style="">
      @csrf
      <button class="btn text-white btn-lg " style="margin-top: 200px; width:200px; background-color: #FF7C57">Logout</button>
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