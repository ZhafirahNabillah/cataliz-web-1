@extends('layouts.layoutFull')

@section('title','Signup')

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
          <!-- Register-->
          <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
              @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dissmisable">
                  <h4 class="alert-heading">Success</h4>
                  <div class="alert-body">{{ $message }}</div>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">×</span></button>
                </div>
              @endif
              @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dissmisable">
                  <h4 class="alert-heading">Sorry</h4>
                  <div class="alert-body">{{ $message }}</div>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">×</span></button>
                </div>
              @endif
              <h4 class="card-title mb-1">Adventure starts here 🚀</h4>
              <p class="card-text mb-2">Make your app management easy and fun!</p>
              <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                  <label class="form-label" for="register-username">Fullname</label>
                  <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="John Doe" aria-describedby="name" value="{{ old('name') }}" autocomplete="name" autofocus tabindex="1" />
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label" for="register-phone">Phone</label>
                  <div class="input-group input-group-merge mb-16">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon5">+62</span>
                    </div>
                    <input class="form-control @error('phone') is-invalid @enderror" id="phone" type="text" name="phone" placeholder="081xxxxx" aria-describedby="phone" value="{{ old('phone') }}" autocomplete="phone" tabindex="2" />
                  </div>
                  @error('phone')
                  <strong class="text-danger">{{ $message }}</strong>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label" for="register-email">Email</label>
                  <input class="form-control @error('email') is-invalid @enderror" id="email" type="text" name="email" placeholder="john@example.com" aria-describedby="email" value="{{ old('email') }}" autocomplete="email" tabindex="3" />
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label" for="register-password">Password</label>
                  <div class="input-group input-group-merge form-password-toggle">
                    <input class="form-control form-control-merge @error('password') is-invalid @enderror" id="password" type="password" name="password" autocomplete="new-password" placeholder="············" aria-describedby="password" tabindex="3" />
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
                    <input class="form-control form-control-merge" id="password-confirm" type="password" name="password_confirmation" placeholder="············" aria-describedby="password_confirmation" autocomplete="new-password" tabindex="4" />
                    <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                  </div>
                </div>
                <h5>Register as</h5>
                <div class="form-group demo-inline-spacing">
                  <div class="custom-control custom-radio">
                    <input type="radio" id="role_coach" name="role" class="custom-control-input @error('role') is-invalid @enderror" value="coach" />
                    <label class="custom-control-label" for="role_coach">Coach</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="role_coachee" name="role" class="custom-control-input @error('role') is-invalid @enderror" value="coachee" />
                    <label class="custom-control-label" for="role_coachee">Coachee</label>
                  </div>
                  @error('role')
                    <strong class="text-danger">{{ $message }}</strong>
                  @enderror
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
            </div>
          </div>
          <!-- /Register-->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END: Content-->

@endsection
