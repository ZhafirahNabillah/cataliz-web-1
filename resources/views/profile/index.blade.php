@extends('layouts.layoutVerticalMenu')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-profile.css') }}">
@endpush

@section('title','Profil')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')

<!-- BEGIN: Content-->
<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper">
		<div class="content-header row">
			<div class="content-header-left col-md-9 col-12 mb-2">
				<div class="row breadcrumbs-top">
					<div class="col-12">
						<h2 class="content-header-title float-left mb-0">Profile
							<img class="align-text  width=" 15" height="15"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Pada halaman ini, ditampilkan detail profile dari pemilik akun. Pada halaman ini pula, pengguna dapat mengubah kata sandi dan detail informasi akunnya." />
						</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/">Home</a>
								</li>
								<li class="breadcrumb-item"><a href="">Profile</a>
								</li>
								<li class="breadcrumb-item active">{{$user->name}}
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
		@role('coach')
		<div class="content-body">
			<div id="user-profile">
				<!-- profile header -->
				@if ($message = Session::get('success2'))
				<div class="alert alert-success alert-dissmisable">
					<h4 class="alert-heading">Success</h4>
					<div class="alert-body">{{ $message }}</div>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				@endif
				<div class="row">
					<div class="col-sm-12 ">
						<div class="card profile-header mb-2 position-relative ">
							<!-- profile cover photo -->
							<img class="card-img-top" style="height: 569px;" src="{{ asset('storage/background/'.$user->background_picture) }}" alt="User Profile Image" />
							<!--/ profile cover photo -->

							<div class="position-relative">
								<!-- profile picture -->
								<div class="profile-img-container d-flex align-items-center">
									<div class="profile-img">
										<img src="{{ asset('storage/profil/'.$user->profil_picture) }}" class="rounded img-fluid" alt="Card image" id="profil" />
									</div>
									<!-- profile title -->
									<div class="profile-title ml-3">
										<h2 class="text-white">{{$user->name}}</h2>
									</div>
								</div>
							</div>

							<!-- tabs pill -->
							<div class="profile-header-nav position-relative">
								<!-- navbar -->
								<nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100 position-relative">
									<button class="btn btn-icon navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
										<i data-feather="align-justify" class="font-medium-5"></i>
									</button>

									<!-- collapse  -->
									<div class="collapse navbar-collapse" id="navbarSupportedContent">
										<div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
											<ul class="nav nav-tabs" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">Home</a>
												</li>
											</ul>
										</div>

										<!-- edit button -->
										<div class="btn-group dropleft " style="z-index:99">
											<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Edit
											</button>
											<div class="dropdown-menu " style="z-index:99">
												<a class="dropdown-item" style="z-index:99" data-toggle="modal" data-target="#exampleModal">Profile Picture
												</a>
												<a class="dropdown-item position-relative" style="z-index:99" data-toggle="modal" data-target="#exampleModal2">Cover Picture
												</a>
											</div>
										</div>

										<!-- /edit button -->

										<!-- Modal Profil-->
										<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Update Foto Profil</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>

													<div class="modal-body">
														<form action="{{route('update_profil', Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
															@csrf
															<input type="file" name="profil_picture" id="profil_picture">
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary">Simpan</button>
														</form>
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
													</div>
												</div>
											</div>
										</div>
										<!--/ Modal Profil -->

										<!-- Modal Background-->
										<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Update Background</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form action="{{route('update_background', Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
															@csrf
															<input type="file" name="background_picture" id="background_picture">
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary">Simpan</button>
														</form>
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
													</div>
												</div>
											</div>
										</div>
										<!--/ Modal Background -->

									</div>
							</div>
							<!--/ collapse  -->
							</nav>
							<!--/ navbar -->
						</div>
					</div>
				</div>
			</div>
			<!--/ profile header -->

			<div class="tab-content">
				<div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
					<!-- profile info section -->
					<section id="profile-info">
						<div class="row">
							<!-- left profile info section -->
							<div class="col-lg-4 col-12 order-2 order-lg-1">
								<!-- about -->
								<div class="card">
									<div class="card-body">
										<h5 class="mb-75">Joined:</h5>
										<p class="card-text">{{\Carbon\Carbon::parse($user->created_at)->format('F d, Y')}}</p>

										<div class="mt-2">
											<h5 class="mb-75">Phone:</h5>
											<p class="card-text">+62{{$user->phone}}</p>
										</div>
										<div class="mt-2">
											<h5 class="mb-75">Email:</h5>
											<p class="card-text">{{$user->email}}</p>
										</div>
									</div>
								</div>
								<!--/ about -->
							</div>
							<!--/ left profile info section -->

							<!-- center profile info section -->

							<div class="col-lg-8 col-`4` order-1 order-lg-2">
								<form action="{{route('simpan_password', Auth::user()->id)}}" method="post">
									@csrf
									<div class="row match-height">
										<div class="col-sm-12 col-md-12">
											<div class="card">
												<div class="card-header">
													<h4 class="card-title">Change Password
														<img class="text-align width=" 15" height="15"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Pada bagian ini, Anda dapat melakukan perubahan kata sandi akun Anda. Kata sandi baru sebaiknya berbeda dari kata sandi sebelumnya." />
													</h4>
												</div>
												<div class="container">
													@if ($message = Session::get('success'))
													<div class="alert alert-success alert-dissmisable">
														<h4 class="alert-heading">Success</h4>
														<div class="alert-body">{{ $message }}</div>
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
													</div>
													@endif
												</div>

												<div class="col-md-12 form-group">
													<label for="fp-default">Old password</label>
													<input class="form-control @error('old_password') is-invalid @enderror" type="password" name="old_password" placeholder="Type old password here...">
													@error('old_password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>

												<div class="col-md-12 form-group">
													<label for="fp-default">New Password</label>
													<input class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password" placeholder="Type new password here...">
													@error('new_password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>

												<div class="col-md-12 form-group">
													<label for="fp-default">Confirm New Password</label>
													<input class="form-control @error('new_confirm_password') is-invalid @enderror" type="password" name="new_confirm_password" placeholder="New password confirmation">
													@error('new_confirm_password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>

												<div class="col-md-12 form-group">
													<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">Save
														Change</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
				</div>
				<!--/ center profile info section -->
			</div>

			</section>
			<!--/ profile info section -->
		</div>
		@endrole

		@role('coachee')
		<div class="content-body">
			<div id="user-profile">
				<!-- profile header -->
				<div class="row">
					<div class="col-12">
						<div class="card profile-header mb-2 position-relative ">
							<!-- profile cover photo -->
							<img class="card-img-top" style="height: 569px;" src="{{ asset('storage/background/'.$user->background_picture) }}" alt="User Profile Image" />
							<!--/ profile cover photo -->

							<div class="position-relative">
								<!-- profile picture -->
								<div class="profile-img-container d-flex align-items-center">
									<div class="profile-img">
										<img src="{{ asset('storage/profil/'.$user->profil_picture) }}" class="rounded img-fluid" alt="Card image" id="profil" />
									</div>
									<!-- profile title -->
									<div class="profile-title ml-3">
										<h2 class="text-white">{{$user->name}}</h2>
									</div>
								</div>
							</div>

							<!-- tabs pill -->
							<div class="profile-header-nav">
								<!-- navbar -->
								<nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
									<button class="btn btn-icon navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
										<i data-feather="align-justify" class="font-medium-5"></i>
									</button>

									<!-- collapse  -->
									<div class="collapse navbar-collapse" id="navbarSupportedContent">
										<div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
											<ul class="nav nav-tabs" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">Home</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab" data-toggle="tab" href="#session" aria-controls="profile" role="tab" aria-selected="false">Sessions</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachingPlan" aria-controls="profile" role="tab" aria-selected="false">Coaching Plans</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachingNotes" aria-controls="profile" role="tab" aria-selected="false">Coaching Notes</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab" data-toggle="tab" href="#feedback" aria-controls="profile" role="tab" aria-selected="false">Feedbacks</a>
												</li>

											</ul>

											<!-- edit button -->

											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modals_profil" aria-expanded="false" id="edit_profil">
												Edit
											</button>

											<!-- modal edit-->
											<div class="modal fade" id="modals_profil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<div class="container">
																<div class="col-3">
																	<button type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		Foto Profile
																	</button>
																</div>
																<div class="col-3">
																	<button type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		Cover Backgound
																	</button>
																</div>
																<div class="col-3">
																	<button type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		Profile
																	</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- /modal edit-->

										</div>
									</div>
									<!--/ collapse  -->
								</nav>
								<!--/ navbar -->
							</div>
						</div>
					</div>
				</div>
				<!--/ profile header -->

				<div class="tab-content">
					<div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
						<!-- profile info section -->
						<section id="profile-info">
							<div class="row">
								<!-- left profile info section -->
								<div class="col-lg-4 col-12 order-2 order-lg-1">
									<!-- about -->
									<div class="card" style="border-radius: 11px">
										<div class="card-body">
											<h5 class="mb-75">Joined:</h5>
											<p class="card-text">{{\Carbon\Carbon::parse($user->created_at)->format('F d, Y')}}</p>

											<div class="mt-2">
												<h5 class="mb-75">Phone:</h5>
												<p class="card-text">+62{{$user->phone}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-75">Email:</h5>
												<p class="card-text">{{$user->email}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-75">Organization:</h5>
												<p class="card-text">{{$user->organization}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-75">Company:</h5>
												<p class="card-text">{{$user->company}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-50">Occupation:</h5>
												<p class="card-text mb-0">{{$user->occupation}}</p>
											</div>
										</div>
									</div>
									<!--/ about -->
								</div>
								<!--/ left profile info section -->

								<!-- center profile info section -->

								<div class="col-lg-8 col-12 order-1 order-lg-2">
									<div class="row match-height">
										<!-- Number of Coaching -->
										<div class="col-lg-4 col-sm-4 col-6">
											<div class="card style=" width: 18rem;" style="border-radius: 11px"">

											<div class=" card-title">
												<div class="card-body flex-column align-items-start pb-0">
													<img class="rounded float-left width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Bagian ini menampilkan banyaknya sesi yang dimiliki oleh client yang dipilih." />
												</div>
												<div class="card-body flex-column align-items-start pb-0">
													<img class="rounded float-right width=" 60" height="60"" src=" {{asset('assets\images\icons\Group 149.png') }}" alt="Card image cap" />
												</div>
											</div>

											<div class="card-body">
												<h1 class="display-1 text-primary card text-center">0</h1>
												<h3 class="font-weight-bolder text-center">Number of Coaching</h3>
											</div>
										</div>
									</div>
									<!-- Number of Coaching ends -->

									<!-- Number of Agenda -->
									<div class="col-lg-4 col-sm-4 col-6">
										<div class="card style=" width: 18rem;" style="border-radius: 11px"">

										<div class=" card-title">
											<div class="card-body flex-column align-items-start pb-0">
												<img class="rounded float-left width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Bagian ini menampilkan banyaknya agenda yang dimiliki oleh client yang dipilih." />
											</div>
											<div class="card-body flex-column align-items-start pb-0">
												<img class="rounded float-right width=" 55" height="55"" src=" {{asset('assets\images\icons\Group 141.jpg') }}" alt="Card image cap" />
											</div>
										</div>

										<div class="card-body">
											<h1 class="display-1 text-primary card text-center">0</h1>
											<h3 class="font-weight-bolder text-center">Agenda</h3>
										</div>
									</div>
								</div>
								<!-- Number of Agenda End -->


								<!-- Number of Event -->
								<div class="col-lg-4 col-sm-4 col-6">
									<div class="card style=" width: 18rem;" style="border-radius: 11px"">

									<div class=" card-title">
										<div class="card-body flex-column align-items-start pb-0">
											<img class="rounded float-left width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Bagian ini menampilkan banyaknya sesi dengan status scheduled yang dimiliki oleh client yang dipilih." />
										</div>
										<div class="card-body flex-column align-items-start pb-0">
											<img class="rounded float-right width=" 60" height="60"" src=" {{asset('assets\images\icons\Group 142.jpg') }}" alt="Card image cap" />
										</div>
									</div>

									<div class="card-body">
										<h1 class="display-1 text-primary card text-center">0</h1>
										<h3 class="font-weight-bolder text-center">Event</h3>
									</div>
								</div>
							</div>
							<!-- Number of Event End -->


					</div>

					<div class="row">
						<div class="col-lg-12 col-12 order-1 order-lg-2">
							<!-- Upcoming event -->
							<div class="card" style="border-radius: 11px">
								<div class="card-body">
									<h5 class="card-title mb-1">Upcoming Event
										<img class="rounded width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Bagian ini menampilkan daftar seluruh sesi yang dimiliki oleh client yang dipilih." />
									</h5>

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
							<!--/Upcoming Event -->

							<!-- List Agenda-->
							<div class="card" style="border-radius: 11px">
								<div class="card-body">
									<h5 class="card-title mb-1">List Agenda
										<img class="rounded width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Bagian ini menampilkan sesi dengan status scheduled yang dijadwalkan terlaksana dalam waktu dekat." />
									</h5>
									<table class="datatables-basic table yajra-datatable1">
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
							<!--/List Agenda-->
						</div>
					</div>
				</div>
				<!--/ center profile info section -->
			</div>

			</section>
			<!--/ profile info section -->
		</div>
		<!-- tab Session -->

		<div class="tab-pane" id="session" aria-labelledby="about-tab" role="tabpanel">
			<div class="content-header row">
				<div class="content-header-left col-md-9 col-12 mb-2">
					<div class="row breadcrumbs-top">
						<div class="col-12">
							<h4 class="breadcrumb-item active">Sessions
								<img class="rounded width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="BPada bagian ini ditampilkan daftar seluruh sesi yang dimiliki oleh client yang dipilih." />
							</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="card" style="border-radius: 11px">

				<section id="basic-datatable">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<table class="datatables-basic table yajra-datatable-1">
									<thead>
										<tr>
											<th>NO</th>
											<th>TOPIC</th>
											<th>SESSION</th>
											<th>Date</th>
											<th>TIME</th>
											<th>DURATION</th>
											<th>ACTION</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- /tab Session -->
		<!-- Tab coaching plans -->

		<div class="tab-pane" id="coachingPlan" aria-labelledby="about-tab" role="tabpanel">
			<div class="content-header row">
				<div class="content-header-left col-md-9 col-12 mb-2">
					<div class="row breadcrumbs-top">
						<div class="col-12">
							<h4 class="breadcrumb-item active">Coaching Plans
								<img class="align-text width=" 15" height="15"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar coaching plans yang dimiliki oleh client yang dipilih." />
							</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="card" style="border-radius: 11px">

				<section id="basic-datatable">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<table class="datatables-basic table yajra-datatable-2">
									<thead>
										<tr>
											<th>NO</th>
											<th>OBJEKTIF</th>
											<th>Tanggal Pelaksanaan</th>
											<th>ACTION</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- /tab coaching plans -->
			</div>
		</div>

		<!-- Tab coaching Notes -->
		<div class="tab-pane" id="coachingNotes" aria-labelledby="about-tab" role="tabpanel">
			<div class="content-header row">
				<div class="content-header-left col-md-9 col-12 mb-2">
					<div class="row breadcrumbs-top">
						<div class="col-12">
							<h4 class="breadcrumb-item active">Coaching Notes
								<img class="rounded float-right width=" 15" height="15"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar coaching notes berdasarkan session  yang dimiliki oleh client yang dipilih." />
							</h4>
						</div>
					</div>
				</div>
			</div>
			<!-- coaching note card -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<table class="datatables-basic table yajra-datatable-notes">
							<thead>
								<tr>
									<th>NO</th>
									<th>Coach Name</th>
									<th>Session</th>
									<th>Topic</th>
									<th>Subject</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!-- coaching note detail modal -->
			<div class="modal fade" id="show_note" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Detail Note</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="container">
								<div class="row">
									<div class="card-body" style="border-radius: 11px">
										<dl class="row">
											<dt class="col-sm-3">Topic</dt>
											<dd class="col-sm-9 topic_note"></dd>
										</dl>
										<dl class="row">
											<dt class="col-sm-3">Coach Name</dt>
											<dd class="col-sm-9 coach_name_note"></dd>
										</dl>
										<dl class="row">
											<dt class="col-sm-3">Session</dt>
											<dd class="col-sm-9 session_note"></dd>
										</dl>
										<dl class="row">
											<dt class="col-sm-3">Subject</dt>
											<dd class="col-sm-9 subject_note"></dd>
										</dl>
										<dl class="row">
											<dt class="col-sm-3">Note</dt>
											<span class="d-block my-1"></span>
											<dd class="col-sm-9 text-justify note"></dd>
										</dl>
										<dl class="row">
											<dt class="col-md-12">
												<small class="d-block text-muted">Note Attachment</small>
												<span class="d-block my-1"></span>
												<a href="#" class="btn btn-primary download_button_note">Download</a>

												<span class="d-block font-italic span_none_note">Tidak ada file</span>

											</dt>
										</dl>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /tab coaching Notes-->


		<!-- Tab Feedback -->
		<div class="tab-pane" id="feedback" aria-labelledby="about-tab" role="tabpanel">
			<div class="content-header row">
				<div class="content-header-left col-md-9 col-12 mb-2">
					<div class="row breadcrumbs-top">
						<div class="col-12">
							<h4 class="breadcrumb-item active tes">Feedback
								<img class="rounded float-right width=" 15" height="15"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar feedbacks dari session yang telah diikuti oleh client yang dipilih." />
							</h4>
						</div>
					</div>
				</div>
			</div>
			<!-- Feedback card -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<table class="datatables-basic table yajra-datatable-feedback">
							<thead>
								<tr>
									<th>NO</th>
									<th>Coach Name</th>
									<th>Session</th>
									<th>Topic</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- /Feedback note -->

			<!-- Feedback detail modal -->
			<div class="modal fade" id="show_feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalHeading"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="container">
								<div class="row">
									<div class="card-body">
										<dl class="row">
											<dt class="col-sm-3">Topic</dt>
											<dd class="col-sm-9 topic_feedback"></dd>
										</dl>
										<dl class="row">
											<dt class="col-sm-3">Coach Name</dt>
											<dd class="col-sm-9 coach_name_feedback"></dd>
										</dl>
										<dl class="row">
											<dt class="col-sm-3">Session</dt>
											<dd class="col-sm-9 session_feedback"></dd>
										</dl>
										<dl class="row">
											<dt class="col-sm-3">Feedback</dt>
											<span class="d-block my-1"></span>
											<dd class="col-sm-9 text-justify feedback"></dd>
										</dl>
										<dl class="row">
											<dt class="col-md-12">
												<small class="d-block text-muted">Feedback Attachment</small>

												<span class="d-block my-1"></span>
												<a class="btn btn-primary download_button_feedback">Download</a>

												<span class="d-block font-italic span_none_feedback">Tidak ada file</span>

											</dt>
										</dl>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /modal Feedback-->


		<!--End profile-->
		@endrole

	</div>
	<!---End Content Body -->
</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')

<script type="text/javascript">
	// popover
	$(function() {
		$('[data-toggle="popover"]').popover()
	});
	$(function() {

				// // modal edit
				// $('body').on('click', '#edit_profil', function() {
				// 	// $('#saveBtn').val("edit-profil");
				// 	$('#modals_profil').modal('show');
				// 	// save data
				// 	// $('#saveBtn').click(function(e) {
				// 	// 	// e.preventDefault();
				// 	// 	$(this).html('Sending..');
				// 	// 	$('#modals_profil').modal('hide');
				// 	// })
				// });
</script>
@endpush
