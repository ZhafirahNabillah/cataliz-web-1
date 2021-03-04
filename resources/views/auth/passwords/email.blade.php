@extends('layouts.layoutFull')

@section('title','Reset Password')

@section('content')

<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-wrapper">
    <div class="content-body">
      <div class="auth-wrapper auth-v2">
        <div class="auth-inner row m-0">
          <!-- Brand logo-->
          <a class="brand-logo" href="/">
            @include('panels.logo')
          </a>
          <!-- /Brand logo-->
          <!-- Left Text-->
          <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{asset('assets/images/pages/login-v2.svg')}}" alt="Login V2" /></div>
          </div>
          <!-- /Left Text-->
          <!-- Forgot Password-->
          <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
              
              @if ($message = Session::get('success'))
              <div class="alert alert-success alert-dissmisable">
                <h4 class="alert-heading">Success</h4>
                <div class="alert-body">{{ $message }}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <spanaria-hidden="true">×</span>
                </button>
              </div>
              @endif
              @if ($message = Session::get('error'))
              <div class="alert alert-danger alert-dissmisable">
                <h4 class="alert-heading">Sorry</h4>
                <div class="alert-body">{{ $message }}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <spanaria-hidden="true">×</span>
                </button>
              </div>
              @endif
              <h4 class="card-title mb-1">Forgot Password</h4>
              <p class="card-text mb-2">Verify your email address to reset your password!</p>
              <form class="auth-register-form mt-2" method="POST" action="{{ route('password.email') }}">
                  @csrf
                  <div class="form-group">
                      <label class="form-label" for="register-email">Email</label>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  <button class="btn btn-primary btn-block" tabindex="5">Send Password Reset Link</button>
              </form>
              <p class="text-center mt-2"><span>New on our platform?</span><a href="{{route('show_register')}}" id="btn-register-choice"><span>&nbsp;Create an account</span></a></p>
            </div>
          </div>
          <!-- /Forgot Password-->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END: Content-->

@endsection
