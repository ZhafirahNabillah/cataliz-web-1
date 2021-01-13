@extends('layouts.layoutVerticalMenu')

@section('title','Home')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')

<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
			<div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row match-height">
                        <!-- Medal Card -->
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <h5>Congratulations 🎉 {{Auth::user()->name}}!</h5>
                                    <p class="card-text font-small-3">You have won gold medal</p>
                                    <h3 class="mb-75 mt-2 pt-50">
                                        <a href="javascript:void(0);">$48.9k</a>
                                    </h3>
                                    <button type="button" class="btn btn-primary">View Sales</button>
                                    <img src="{{asset('assets/images/illustration/badge.svg')}}" class="congratulation-medal" alt="Medal Pic" />
                                </div>
                            </div>
                        </div>
                        <!--/ Medal Card -->
					</div>
				</section>
			</div>		
		</div>
</div>		

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@endsection
