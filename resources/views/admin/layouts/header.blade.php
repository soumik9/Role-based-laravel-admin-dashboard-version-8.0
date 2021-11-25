<!-- Header -->
<div class="header">

    <!-- Logo -->
    <div class="header-left">
        @if($setting->website_logo_dark != null || !empty($setting->website_logo_dark))
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{$setting->website_logo_dark}}" alt="{{$setting->website_title}}">
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="/assets/admin/img/logo-def.png" alt="Logo">
            </a>
        @endif

        @if($setting->website_logo_small != null || !empty($setting->website_logo_small))
            <a href="{{ route('dashboard') }}" class="logo logo-small">
                <img src="{{$setting->website_logo_small}}" alt="{{$setting->website_title}}">
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="logo logo-small">
                <img src="/assets/admin/img/favicon-def.png" alt="Logo" width="30" height="30">
            </a>
        @endif
    </div>
    <!-- /Logo -->
    
    <a href="javascript:void(0);" id="toggle_btn">
        <i class="fe fe-text-align-left"></i>
    </a>
    
    {{-- <div class="top-nav-search">
        <form>
            <input type="text" class="form-control" placeholder="Search here">
            <button class="btn" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div> --}}
    
    <!-- Mobile Menu Toggle -->
    <a class="mobile_btn" id="mobile_btn">
        <i class="fa fa-bars"></i>
    </a>
    <!-- /Mobile Menu Toggle -->
    
    <!-- Header Right Menu -->
    <ul class="nav user-menu">

        <!-- Frontend -->
        <li class="nav-item">
            <a href="{{route('home')}}" target="_blank" class="dropdown-toggle nav-link" title="Front End">
                <i class="fe fe-globe"></i>
            </a>
        </li>
        <!-- /Frontend -->

        <!-- Notifications -->
        {{-- <li class="nav-item dropdown noti-dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <i class="fe fe-bell"></i> <span class="badge badge-pill">3</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="#">
                                <div class="media">
                                    <span class="avatar avatar-sm">
                                        <img class="avatar-img rounded-circle" alt="User Image" src="/assets/admin/img/patients/patient3.jpg">
                                    </span>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">Carl Kelly</span> send a message <span class="noti-title"> to his doctor</span></p>
                                        <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="#">View all Notifications</a>
                </div>
            </div>
        </li> --}}
        <!-- /Notifications -->
        
        <!-- User Menu -->
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img">
                    <img class="rounded-circle" src="{{ Auth::user()->image }}" onerror="this.src='{{ asset('assets/admin/img/default-user.png') }}';" width="31" alt="{{auth()->user()->name}}">
                </span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="user-text">
                        <h6>{{ Auth::user()->name}}</h6>
                        <p class="text-muted mb-0">{{trim( Auth::user()->getRoleNames(), '"[]')}}</p>
                    </div>
                </div>
                <a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>
                <a class="dropdown-item" href="{{ route('website-setting.edit') }}">Setting</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
        </li>
        <!-- /User Menu -->
        
    </ul>
    <!-- /Header Right Menu -->
    
</div>
<!-- /Header -->