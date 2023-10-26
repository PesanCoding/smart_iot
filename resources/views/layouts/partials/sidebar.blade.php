  <aside class="main-sidebar sidebar-light-success elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('profile.show')}}" class="brand-link">
      <img src="{{ url('storage',auth()->user()->profile_photo_path ?? '') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{auth()->user()->name}}</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{route('dashboard.index')}}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Device</li>
          <li class="nav-item">
            <a href="{{route('devices.index')}}" class="nav-link {{ request()->is('device*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Device
              </p>
            </a>
          </li>
          <li class="nav-header">Monitoring & Control</li>
          <li class="nav-item">
            <a href="{{route('monitoring.index')}}" class="nav-link {{ request()->is('monitoring*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-desktop"></i>
              <p>
                Monitoring
              </p>
            </a>
          </li>
           @if (auth()->user()->hasRole('user_p'))
          <li class="nav-item">
            <a href="{{route('control.index')}}" class="nav-link {{ request()->is('control*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-plug"></i>
              <p>
                Control
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-charging-station"></i>
              <p>
                Daya Listrik
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('volair.index')}}" class="nav-link {{ request()->is('volair*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-faucet"></i>
              <p>
                Volume Air
              </p>
            </a>
          </li>
           @endif
            @if (auth()->user()->hasRole('admin'))
                <li class="nav-header">Kelola User</li>
                <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    User
                </p>
                </a>
            </li>
            @endif
          <li class="nav-header">Report</li>
          <li class="nav-item">
            <a href="{{route('cetak.index')}}" class="nav-link {{ request()->is('cetak*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Cetak Laporan
              </p>
            </a>
        <li class="nav-header">Options</li>
        @if (auth()->user()->hasRole('user_p'))
            <li class="nav-item">
            <a href="{{route('mode.index')}}" class="nav-link {{ request()->is('mode*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-toggle-on"></i>
                <p>
                Mode Device
                </p>
            </a>
            </li>
        @endif
          <li class="nav-item">
            <a href="#" class="nav-link" onclick="document.querySelector('#form-logout').submit()">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
            <form action="{{route('logout')}}" method="post" id="form-logout">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
