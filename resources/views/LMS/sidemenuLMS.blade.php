<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{route('dashboard')}}">
                    @include('panels.logo')
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @role('adminLMS')
            <li class="nav-item {{ 'dashboard' == request()->path() ? 'active' : '' }}">
                <a class=" d-flex align-items-center" href="{{route('dashboard')}}">
                    <i data-feather="home"></i><span class="menu-item" data-i18n="Analytics">Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ 'clients' == request()->path() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('clients.index') }}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Todo">Users</span></a>
            </li>
            <li class="nav-item {{ 'plans' == request()->path() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('programLms.index') }}"><i data-feather="book"></i><span class="menu-title text-truncate" data-i18n="Todo">Category Program</span></a>
            </li>
            <li class="nav-item {{ 'packages' == request()->path() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('packages.index') }}"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Todo">Package</span></a>
            </li>
            <li class="nav-item {{ 'plans' == request()->path() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href=""><i data-feather="check-square"></i><span class="menu-title text-truncate" data-i18n="Todo">Course</span></a>
            </li>
            @endrole
            @role('coachee')
            <li class="nav-item {{ 'dashboardLMS' == request()->path() ? 'active' : '' }}">
                <a class=" d-flex align-items-center" href="{{route('dashboardLMS')}}">
                    <i data-feather="home"></i><span class="menu-item" data-i18n="Analytics">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ 'plans' == request()->path() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href=""><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Todo">My Program</span></a>
            </li>
            <li class="nav-item {{ 'plans' == request()->path() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href=""><i data-feather="book"></i><span class="menu-title text-truncate" data-i18n="Todo">Our Program</span></a>
            </li>
            <li class="nav-item {{ 'plans' == request()->path() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href=""><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Todo">Help Center</span></a>
            </li>
            @endrole

        </ul>
    </div>
</div>
<!-- END: Main Menu-->