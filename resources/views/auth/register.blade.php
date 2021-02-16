@extends('layouts.layoutFull')

@section('title','Signup')

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
          <!-- Register-->
          <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
              <h4 class="card-title mb-1">Adventure starts here 🚀</h4>
              <p class="card-text mb-2">Make your app management easy and fun!</p>
              <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                  <label class="form-label" for="register-username">Fullname</label>
                  <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="John Doe" aria-describedby="name" value="{{ old('name') }}" required autocomplete="name" autofocus tabindex="1" />
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label" for="register-phone">Phone</label>
                  <input class="form-control @error('phone') is-invalid @enderror" id="phone" type="text" name="phone" placeholder="081xxxxx" aria-describedby="phone" value="{{ old('phone') }}" required autocomplete="phone" tabindex="2" />
                  @error('phone')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label" for="register-email">Email</label>
                  <input class="form-control @error('email') is-invalid @enderror" id="email" type="text" name="email" placeholder="john@example.com" aria-describedby="email" value="{{ old('email') }}" required autocomplete="email" tabindex="3" />
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label" for="register-password">Password</label>
                  <div class="input-group input-group-merge form-password-toggle">
                    <input class="form-control form-control-merge @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="new-password" placeholder="············" aria-describedby="password" tabindex="3" />
                    <div class="input-group-append"><span class="input-group-text cursor-pointer "><i data-feather="eye"></i></span></div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="register-password">Confirm Password</label>
                  <div class="input-group input-group-merge form-password-toggle">
                    <input class="form-control form-control-merge" id="password-confirm" type="password" name="password_confirmation" placeholder="············" aria-describedby="password_confirmation" required autocomplete="new-password" tabindex="4" />
                    <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                  </div>
                </div>
                <h5>Register as</h5>
                <div class="form-group">
                  <div class="custom-control custom-radio">
                    <input type="radio" id="role_coach" name="role" class="custom-control-input" value="coach" />
                    <label class="custom-control-label" for="role_coach">Coach</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="role_coachee" name="role" class="custom-control-input" value="coachee" />
                    <label class="custom-control-label" for="role_coachee">Coachee</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" id="register-privacy-policy" type="checkbox" tabindex="4" />
                    <label class="custom-control-label" for="register-privacy-policy">I agree to<a href="javascript:void(0);">&nbsp;privacy policy & terms</a></label>
                  </div>
                </div>
                <button class="btn btn-primary btn-block" tabindex="5">Sign up</button>
              </form>
              <p class="text-center mt-2"><span>Already have an account?</span><a href="{{route('login')}}"><span>&nbsp;Sign in instead</span></a></p>
              <!--
            <div class="divider my-2">
            <div class="divider-text">or</div>
          </div>
          <div class="auth-footer-btn d-flex justify-content-center"><a class="btn btn-facebook" href="javascript:void(0)"><i data-feather="facebook"></i></a><a class="btn btn-twitter white" href="javascript:void(0)"><i data-feather="twitter"></i></a><a class="btn btn-google" href="javascript:void(0)"><i data-feather="mail"></i></a><a class="btn btn-github" href="javascript:void(0)"><i data-feather="github"></i></a></div>
        -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END: Content-->
<!--
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
<div class="card-header">{{ __('Register') }}</div>

<div class="card-body">
<form method="POST" action="{{ route('register') }}">
@csrf

<div class="form-group row">
<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

<div class="col-md-6">
<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

@error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="form-group row">
<label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

<div class="col-md-6">
<input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

@error('phone')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="form-group row">
<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

<div class="col-md-6">
<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="form-group row">
<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

<div class="col-md-6">
<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

@error('password')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="form-group row">
<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

<div class="col-md-6">
<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
</div>
</div>

<div class="form-group row mb-0">
<div class="col-md-6 offset-md-4">
<button type="submit" class="btn btn-primary">
{{ __('Register') }}
</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
-->
@endsection