<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars" style="color: rgb(243, 242, 242)"></i></a></li>
      <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul>
    <div class="search-element">
      <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="500" style="border-radius: 1em; border-color:rgba(208, 208, 208, 0.947)">
      <button class="btn" type="submit" style="margin-left: 20px; border-radius:1em; background-color:rgba(208, 208, 208, 0.947); color:white">Seasssrch</button>
    </div>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown dropdown-list-toggle" style="margin-right:0.6em">
      <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">

        <i class="fa fa-bell" style="color: rgb(27, 27, 27); ">
          {{-- @if (!$datas)
          <span></span>
          @else
          <span>{{$datas}}</span>
          @endif --}}
        </i>
      <!-- <i class="fa fa-bell" style="color: rgb(27, 27, 27); "></i> -->
      </a>
      <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Notifications
          <div class="float-right">

          </div>
        </div>
        <div class="dropdown-list-content dropdown-list-icons">
          {{-- @foreach ($data as $item)
          <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal{{$item->id}}">
            <div class="dropdown-item-icon bg-danger text-white">
              <i class="fas fa-file"></i>
            </div>
            <div class="dropdown-item-desc">
              <b>{{$item->nama_institusi}}</b> and <b>{{$item->nama_project}}</b>
              <div class="time">{{$item->nama_pmlead}}</div>
            </div>
          </a>
          @endforeach --}}
          <!-- <a href="#" class="dropdown-item">
            <div class="dropdown-item-icon bg-success text-white">
              <i class="fas fa-check"></i>
            </div>
            <div class="dropdown-item-desc">
              <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
              <div class="time">12 Hours Ago</div>
            </div>
          </a>
          <a href="#" class="dropdown-item">
            <div class="dropdown-item-icon bg-danger text-white">
              <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="dropdown-item-desc">
              Low disk space. Let's clean it!
              <div class="time">17 Hours Ago</div>
            </div>
          </a>
          <a href="#" class="dropdown-item">
            <div class="dropdown-item-icon bg-info text-white">
              <i class="fas fa-bell"></i>
            </div>
            <div class="dropdown-item-desc">
              Welcome to Stisla template!
              <div class="time">Yesterday</div>
            </div>
          </a> -->
        </div>
        <div class="dropdown-footer text-center">
          <a href="{{route ('list_project')}}">View All <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>

    </li>

    {{-- acount --}}
    @if (!Auth::user())
    <p>none</p>
    @endif
    <div class="d-sm-none d-lg-inline-block" style="color: black; margin-right:0.6em">{{ Auth::user()->name}}</div></a>

    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-title">
            Last Sign in at
            <br>
            {{auth()->user()->last_sign_in_at->diffForHumans()}}
          </div>
          <a href="{{route('profile-pm')}}" class="dropdown-item has-icon">
            <i class="far fa-user"></i> Profile
          </a>
          
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item has-icon text-danger">
            <form action="/logout" method="POST">
              @csrf
              <button class="btn btn-danger">Logout</button>
            </form>

          </a>

        </div>
    </li>
  </ul>
</nav>

{{-- @include('notificationsPM.detail_notif') --}}