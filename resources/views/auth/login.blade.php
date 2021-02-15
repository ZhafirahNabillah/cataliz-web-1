@extends('layouts.layoutFull')

@section('title','Signin')

@section('content')

<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <div class="auth-wrapper auth-v2">
        <div class="auth-inner row m-0">
          <!-- Brand logo--><a class="brand-logo" href="/">

          @include('panels.logo')

        </a>
        <!-- /Brand logo-->
        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
          <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{asset('assets/images/pages/login-v2.svg')}}" alt="Login V2" /></div>
        </div>
        <!-- /Left Text-->
        <!-- Login-->
        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
          <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
            <h4 class="card-title mb-1">Welcome to Cataliz! 👋</h4>
            <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
            <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <label class="form-label" for="login-email">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" placeholder="john@example.com" aria-describedby="email" required autocomplete="email" autofocus="" tabindex="1" />
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group">
                <div class="d-flex justify-content-between">
                  <label for="login-password">Password</label><a href="{{ route('password.request') }}"><small>Forgot Password?</small></a>
                </div>
                <div class="input-group input-group-merge form-password-toggle">
                  <input class="form-control form-control-merge @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="············" required autocomplete="current-password" aria-describedby="password" tabindex="2" />
                  <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}  tabindex="3" />
                  <label class="custom-control-label" for="remember"> Remember Me</label>
                </div>
              </div>
              <button class="btn btn-primary btn-block" tabindex="4">Sign in</button>
            </form>
            <p class="text-center mt-2"><span>New on our platform?</span><a href="{{route('show_register.coachee')}}" id="btn-register-choice"><span>&nbsp;Create an account</span></a></p>
            <!--
            <div class="divider my-2">
            <div class="divider-text">or</div>
          </div>
          <div class="auth-footer-btn d-flex justify-content-center"><a class="btn btn-facebook" href="javascript:void(0)"><i data-feather="facebook"></i></a><a class="btn btn-twitter white" href="javascript:void(0)"><i data-feather="twitter"></i></a><a class="btn btn-google" href="javascript:void(0)"><i data-feather="mail"></i></a><a class="btn btn-github" href="javascript:void(0)"><i data-feather="github"></i></a></div>
        -->
      </div>
    </div>
    <!-- /Login-->
  </div>
</div>
</div>
</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript">

  $(function () {
    $('#btn-register-choice').on('click', function() {
      console.log("ready");
      $("#register_choice").slideToggle(500);
    });
  });
  </script>
@endpush
