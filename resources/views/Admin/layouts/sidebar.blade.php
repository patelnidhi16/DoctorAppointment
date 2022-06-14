<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <p style="font-size:2vw">Sunshine</p>
 
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <img src="{{asset('/public/'.Auth::user()->image.'')}}" style="height: 50px; width:50px;">
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">{{Auth::guard('admin')->user()->email}}</h5>

          </div>
        </div>
        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="{{route('admin.profile')}}" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Update Profile</p>
            </div>
          </a>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>


    <li class="nav-item menu-items {{ request()->is('*dashboard*') ? 'active' : '' }}">
      <a class="nav-link" href="{{route('admin.dashboard')}}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item menu-items {{ request()->is('*doctor*') ? 'active' : '' }}">
      <a class="nav-link" href="{{route('admin.doctor.index')}}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Doctors</span>
      </a>
    </li>
    <li class="nav-item menu-items {{ request()->is('*patient*') ? 'active' : '' }}">
      <a class="nav-link" href="{{route('admin.patient.index')}}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Patients</span>
      </a>
    </li>
    <li class="nav-item menu-items {{ request()->is('*schedule*') ? 'active' : '' }}">
      <a class="nav-link" href="{{route('admin.schedule.index')}}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Appointment</span>
      </a>
    </li>
  </ul>
</nav>