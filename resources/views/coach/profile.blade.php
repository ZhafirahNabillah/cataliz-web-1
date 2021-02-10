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
						<h2 class="content-header-title float-left mb-0">Profile</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/">Home</a>
								</li>
								<li class="breadcrumb-item"><a href="{{route('clients.index')}}">Profile</a>
								</li>
								<li class="breadcrumb-item active">{{$user->name}}
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>

		</div>
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
							<img class="card-img-top" src="{{ asset('storage/background/'.$user->background_picture) }}"
								alt="User Profile Image" />
							<!--/ profile cover photo -->

							<div class="position-relative">
								<!-- profile picture -->
								<div class="profile-img-container d-flex align-items-center">
									<div class="profile-img">
										<img src="{{ asset('storage/profil/'.$user->profil_picture) }}" class="rounded img-fluid"
											alt="Card image" id="profil" />
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
									<button class="btn btn-icon navbar-toggler" type="button" data-toggle="collapse"
										data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
										aria-label="Toggle navigation">
										<i data-feather="align-justify" class="font-medium-5"></i>
									</button>

									<!-- collapse  -->
									<div class="collapse navbar-collapse" id="navbarSupportedContent">
										<div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
											<ul class="nav nav-tabs" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" aria-controls="home"
														role="tab" aria-selected="true">Home</a>
												</li>
											</ul>
										</div>

										<!-- edit button -->
													<div class="btn-group dropleft position-relative "style="z-index:99" >
							              <button
							                type="button"
							                class="btn btn-primary dropdown-toggle"
							                data-toggle="dropdown"
							                aria-haspopup="true"
							                aria-expanded="false"
							              >
							                Edit Profile
							              </button>
							              <div class="dropdown-menu position-relative" style="z-index:99">
							                <a class="dropdown-item" data-toggle="modal"
																data-target="#exampleModal">Edit Foto
															</a>
							                <a class="dropdown-item" data-toggle="modal"
																data-target="#exampleModal2">Edit Background
															</a>
							              </div>
													</div>

										<!-- /edit button -->

										<!-- Modal Profil-->
										<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
											aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Update Foto Profil</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>

													<div class="modal-body">
														<form action="{{route('coachs.update_profil', Auth::user()->id)}}" method="POST"
															enctype="multipart/form-data">
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
										<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
											aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Update Background</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form action="{{route('coachs.update_background', Auth::user()->id)}}" method="POST"
															enctype="multipart/form-data">
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
								<form action="{{route('coachs.simpan_password', Auth::user()->id)}}" method="post">
									@csrf
									<div class="row match-height">
										<div class="col-sm-12 col-md-12">
											<div class="card">
												<div class="card-header">
													<h4 class="card-title">Change Password</h4>
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
													<input class="form-control @error('old_password') is-invalid @enderror" type="password"
														name="old_password" placeholder="Type old password here...">
													@error('old_password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>

												<div class="col-md-12 form-group">
													<label for="fp-default">New Password</label>
													<input class="form-control @error('new_password') is-invalid @enderror" type="password"
														name="new_password" placeholder="Type new password here...">
													@error('new_password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>

												<div class="col-md-12 form-group">
													<label for="fp-default">Confirm New Password</label>
													<input class="form-control @error('new_confirm_password') is-invalid @enderror"
														type="password" name="new_confirm_password" placeholder="New password confirmation">
													@error('new_confirm_password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>

												<div class="col-md-12 form-group">
													<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn"
														value="create">Save
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

	</div>
	<!---End Content Body -->
</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')

<script type="text/javascript">
	$(function () {


			});
</script>
@endpush
