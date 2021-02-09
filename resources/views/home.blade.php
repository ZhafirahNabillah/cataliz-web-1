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

                <!--card -->
                <section id="card-demo-example">
                  <div class="row match-height">
                    <div class="container">
                        <div class="row justify-content-left">
                            <div class="col-md-3">
                                <div class="card">
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
                    <div class="col-md-4 col-lg-3">
                      <div class="card">
                        <div class="card-body">
                            <img class="rounded mx-auto d-block center" src="assets\images\icons\Group 88.jpg" alt="Card image cap" />
                            <small class="card text-center text-muted mb-1">Total Coaching Hour</small>
                            <h2 class="font-weight-bolder text-center">38 Hours</h2>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                      <div class="card">
                        <div class="card-body">
                            <img class="rounded mx-auto d-block center" src="assets\images\icons\Group 84.jpg" alt="Card image cap" />
                            <small class="card text-center text-muted mb-1">Total Coachee</small>
                            <h2 class="font-weight-bolder text-center">30 clients</h2>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-3">
                      <div class="card">
                        <div class="card-body">
                            <img class="rounded mx-auto d-block center" src="assets\images\icons\Group 82.jpg" alt="Card image cap" />
                            <small class="card text-center text-muted mb-1">Total Rating</small>
                            <h2 class="font-weight-bolder text-center">21 Rating</h2>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 col-lg-3">
                      <div class="card">
                        <div class="card-body">
                            <img class="rounded mx-auto d-block center" src="assets\images\icons\Group 90.jpg" alt="Card image cap" />
                            <small class="card text-center text-muted mb-1">Total Session</small>
                            <h2 class="font-weight-bolder text-center">50 Sessions</h2>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title mb-1">Upcoming Event</h5>
                          <table class="datatables-basic table yajra-datatable">
            								<thead>
            									<tr>
            										<th>No</th>
            										<th>Name</th>
            										<th>Date</th>
            										<th>Time</th>
            										<th>Session</th>
            									</tr>
            								</thead>
            								<tbody>
            								</tbody>
            							</table>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title mb-1">List Agenda</h5>
                          <table class="datatables-basic table yajra-datatable">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Duration</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!-- /card -->

			</div>
		</div>
</div>



<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@endsection
