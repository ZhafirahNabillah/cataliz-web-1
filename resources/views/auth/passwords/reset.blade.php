@extends('layouts.layoutFull')

@section('title','Confirm Password')

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
          <!-- Reset Password-->
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
              <h4 class="card-title mb-1">Reset Password</h4>
              <p class="card-text mb-2">Create your new password and make sure you are remember it!</p>
              <div class="card-body">
                <form method="POST" action="{{ route('reset_password') }}">
                  @csrf
                  <input type="hidden" name="reset_code" value="{{ $user->reset_code }}">
                  <div class="form-group row">
                    <label class="form-label" for="register-password">New Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group row">
                    <label for="password-confirm" class="form-label">Confirm New Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>
                  <div class="form-group row mb-0">
                    <button type="submit" class="btn btn-primary btn-block">
                      Submit
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /Reset Password-->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END: Content-->
@endsection
