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
  <div class="shadow-bottom"></div><br>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      @foreach ($categories as $category)
      <li class="nav-item @if ($active_category == $category->first()->category) active @endif">
        <a class=" d-flex align-items-center" href="{{route('documentation.view', $category->first()->category)}}">
          <i data-feather="file-text"></i><span class="menu-item" data-i18n="Analytics">{{ $category->first()->category }}</span>
        </a>
      </li>
      @endforeach

      {{-- <li class="nav-item {{ 'clients' == request()->path() ? 'active' : '' }}">
      <a class="d-flex align-items-center" href="#"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Email">Account</span></a>
      </li>

      <li class="nav-item {{ 'plans' == request()->path() ? 'active' : '' }}">
        <a class="d-flex align-items-center" href="#"><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Todo">Features</span></a>
      </li>


      <li class=" nav-item {{ 'agendas' == request()->path() ? 'active' : '' }}">
        <a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Todo">Document</span></a>
      </li> --}}




    </ul>
  </div>
</div>
<!-- END: Main Menu-->