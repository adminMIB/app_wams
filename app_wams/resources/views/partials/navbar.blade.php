



<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars" style="color: rgb(243, 242, 242)"></i></a></li>
      <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul>
    <div class="search-element">
      <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="500" style="border-radius: 1em; border-color:rgba(208, 208, 208, 0.947)">
      <button class="btn" type="submit" style="margin-left: 20px; border-radius:1em; background-color:rgba(208, 208, 208, 0.947); color:white">Search</button>
    </div>
  </form>
  <ul class="navbar-nav navbar-right">
    

    {{-- acount --}}
    @if (!Auth::user())
    <p>none</p>
    @else

    <div class="d-sm-none d-lg-inline-block" style="color: black; margin-right:0.6em">{{ Auth::user()->name}}</div></a>
    @endif

    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-title">Logged in 5 min ago</div>
          <a href="features-profile.html" class="dropdown-item has-icon">
            <i class="far fa-user"></i> Profile
          </a>
          <a href="" class="dropdown-item has-icon">
            <i class="fas fa-bolt"></i> Activities
          </a>
          <a href="{{route('profile-superadmin')}}" class="dropdown-item has-icon">
            <i class="fas fa-cog"></i> Reset Password
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