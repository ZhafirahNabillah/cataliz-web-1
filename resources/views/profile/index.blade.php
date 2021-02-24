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
										<div class="position-relative">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modals_profil" aria-expanded="false" id="edit_profil">
												Edit
											</button>
										</div>
										<!-- Modal Profil-->
										<div class="modal fade" id="modal_edit_profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
										<div class="modal fade" id="modal_edit_background" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
															<div class="col-auto ">
																<div class="card">
																	<img class=" width=" 120px" height="120px"" src=" {{asset('assets\images\icons\profile\profile.png')}}" alt="Card image cap" />
																	<button type="button" class="btn btn-primary" aria-haspopup="true" id="btn_edit_profil" aria-expanded="false" data-toggle="modal" data-target="#modals-slide-in">
																		Edit Profile
																	</button>
																</div>
															</div>
															<div class="col-auto">
																<div class="card">
																	<img class="width=" 120px" height="120px"" src=" {{asset('assets\images\icons\profile\picture.png')}}" alt="Card image cap" />
																	<button type="button" class="btn btn-primary" aria-haspopup="true" id="btn_edit_picture" aria-expanded="false" data-toggle="modal" data-target="#modal_edit_profil">
																		Edit Picture
																	</button>
																</div>
															</div>
															<div class="col-auto">
																<div class="card">
																	<img class="width=" 120px" height="120px"" src=" {{asset('assets\images\icons\profile\cover.png')}}" alt="Card image cap" />
																	<button type="button" class="btn btn-primary" aria-haspopup="true" id="btn_edit_background" aria-expanded="false" data-toggle="modal" data-target="#modal_edit_background">
																		Edit Cover
																	</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- /modal edit-->

										<!-- Modal to Edit Profile -->
										<div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
											<div class="modal-dialog sidebar-sm">
												<form class="add-new-record modal-content pt-0" id="ClientForm" name="ClientForm" method="POST" action="{{route('store_data', Auth::user()->id)}}">
													@csrf
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
													<div class="modal-header mb-1">
														<h5 class="modal-title" id="modalHeading"></h5>
													</div>
													<input type="hidden" name="Client_id" id="Client_id">
													<div class="modal-body flex-grow-1">
														<div class="form-group">
															<label class="form-label" for="basic-icon-default-fullname">Full Name</label>
															<input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->name}}" />
														</div>
														<label class="form-label" for="basic-icon-default-post">Phone</label>
														<div class="input-group input-group-merge mb-2">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon5">+62</span>
															</div>
															<input id="phone" name="phone" type="text" class="form-control" value="{{$user->phone}}">
														</div>
														<div class="form-group">
															<label class="form-label" for="basic-icon-default-email">Email</label>
															<input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email" value="{{$user->email}}" disabled />
															<small class="form-text text-muted"> You can use letters, numbers & periods </small>
														</div>
														<div class="form-group">
															<label class="form-label" for="basic-icon-default-fullname">Organization</label>
															<input id="organization" name="organization" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->organization}}" />
														</div>
														<div class="form-group">
															<label class="form-label" for="basic-icon-default-fullname">Company</label>
															<input id="company" name="company" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->company}}" />
														</div>
														<div class="form-group">
															<label class="form-label" for="basic-icon-default-fullname">Occupation</label>
															<input id="occupation" name="occupation" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->occupation}}" />
														</div>

														<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create" onclick="Swal.fire({
															icon: 'success',
															title: 'Your work has been saved',
															showConfirmButton: false,
															timer: 1500
														})">
															Submit
														</button>
														<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
													</div>
												</form>
												<!-- </form>-->

											</div>
										</div>
										<!-- End Modal -->


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
													<a class="nav-link " id="profile-tab" data-toggle="tab" href="#feedback" aria-controls="feedback" role="tab" aria-selected="true">Feedback</a>
												</li>
											</ul>

											<!-- edit button -->

											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modals_profil" aria-expanded="false" id="edit_profil">
												Edit
											</button>

											<!-- Modal Profil-->
											<div class="modal fade" id="modal_edit_profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
															<button type="submit" class="btn btn-primary" onclick="Swal.fire({
																icon: 'success',
																title: 'Your work has been saved',
																showConfirmButton: false,
															})">Simpan</button>
															</form>
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
														</div>
													</div>
												</div>
											</div>
											<!--/ Modal Profil -->

											<!-- Modal Background-->
											<div class="modal fade" id="modal_edit_background" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
															<button type="submit" class="btn btn-primary" onclick="Swal.fire({
																icon: 'success',
																title: 'Your work has been saved',
																showConfirmButton: false,
															})">Simpan</button>
															</form>
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
														</div>
													</div>
												</div>
											</div>
											<!--/ Modal Background -->

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
																<div class="col-auto ">
																	<div class="card">
																		<img class=" width=" 120px" height="120px"" src=" {{asset('assets\images\icons\profile\profile.png')}}" alt="Card image cap" />
																		<button type="button" class="btn btn-primary" aria-haspopup="true" id="btn_edit_profil" aria-expanded="false" data-toggle="modal" data-target="#modals-slide-in">
																			Edit Profile
																		</button>
																	</div>
																</div>
																<div class="col-auto">
																	<div class="card">
																		<img class="width=" 120px" height="120px"" src=" {{asset('assets\images\icons\profile\picture.png')}}" alt="Card image cap" />
																		<button type="button" class="btn btn-primary" aria-haspopup="true" id="btn_edit_picture" aria-expanded="false" data-toggle="modal" data-target="#modal_edit_profil">
																			Edit Picture
																		</button>
																	</div>
																</div>
																<div class="col-auto">
																	<div class="card">
																		<img class="width=" 120px" height="120px"" src=" {{asset('assets\images\icons\profile\cover.png')}}" alt="Card image cap" />
																		<button type="button" class="btn btn-primary" aria-haspopup="true" id="btn_edit_background" aria-expanded="false" data-toggle="modal" data-target="#modal_edit_background">
																			Edit Cover
																		</button>
																	</div>
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

				<!-- Modal to Edit Profile -->
				<div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
					<div class="modal-dialog sidebar-sm">
						<form class="add-new-record modal-content pt-0" id="ClientForm" name="ClientForm" method="POST" action="{{route('store_data', Auth::user()->id)}}">
							@csrf
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
							<div class="modal-header mb-1">
								<h5 class="modal-title" id="modalHeading"></h5>
							</div>
							<input type="hidden" name="Client_id" id="Client_id">
							<div class="modal-body flex-grow-1">
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-fullname">Full Name</label>
									<input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->name}}" />
								</div>
								<label class="form-label" for="basic-icon-default-post">Phone</label>
								<div class="input-group input-group-merge mb-2">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon5">+62</span>
									</div>
									<input id="phone" name="phone" type="text" class="form-control" value="{{$user->phone}}">
								</div>
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-email">Email</label>
									<input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email" value="{{$user->email}}" disabled />
									<small class="form-text text-muted"> You can use letters, numbers & periods </small>
								</div>
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-fullname">Organization</label>
									<input id="organization" name="organization" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->organization}}" />
								</div>
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-fullname">Company</label>
									<input id="company" name="company" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->company}}" />
								</div>
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-fullname">Occupation</label>
									<input id="occupation" name="occupation" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->occupation}}" />
								</div>

								<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create" onclick="Swal.fire({
                    icon: 'success',
										title: 'Your work has been saved',
										showConfirmButton: false,
                  })">
									Submit
								</button>
								<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
							</div>
						</form>
						<!-- </form>-->

					</div>
				</div>
				<!-- End Modal -->


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
											<div class="mt-2">
												<h5 class="mb-75">Organization:</h5>
												<p class="card-text">{{$user->organization}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-75">Company:</h5>
												<p class="card-text">{{$user->company}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-75">Occupation:</h5>
												<p class="card-text">{{$user->occupation}}</p>
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
				</div>
				<!--End profile-->

			</div>
			<!---End Content Body -->
		</div>
		@endrole


		@role('admin')
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
										<h2 class="">{{$user->name}}</h2>
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
											</ul>

											<!-- edit button -->

											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modals_profil" aria-expanded="false" id="edit_profil">
												Edit
											</button>

											<!-- Modal Profil-->
											<div class="modal fade" id="modal_edit_profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
											<div class="modal fade" id="modal_edit_background" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
																<div class="col-auto ">
																	<div class="card">
																		<img class=" width=" 120px" height="120px"" src=" {{asset('assets\images\icons\profile\profile.png')}}" alt="Card image cap" />
																		<button type="button" class="btn btn-primary" aria-haspopup="true" id="btn_edit_profil" aria-expanded="false" data-toggle="modal" data-target="#modals-slide-in">
																			Edit Profile
																		</button>
																	</div>
																</div>
																<div class="col-auto">
																	<div class="card">
																		<img class="width=" 120px" height="120px"" src=" {{asset('assets\images\icons\profile\picture.png')}}" alt="Card image cap" />
																		<button type="button" class="btn btn-primary" aria-haspopup="true" id="btn_edit_picture" aria-expanded="false" data-toggle="modal" data-target="#modal_edit_profil">
																			Edit Picture
																		</button>
																	</div>
																</div>
																<div class="col-auto">
																	<div class="card">
																		<img class="width=" 120px" height="120px"" src=" {{asset('assets\images\icons\profile\cover.png')}}" alt="Card image cap" />
																		<button type="button" class="btn btn-primary" aria-haspopup="true" id="btn_edit_background" aria-expanded="false" data-toggle="modal" data-target="#modal_edit_background">
																			Edit Cover
																		</button>
																	</div>
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

				<!-- Modal to Edit Profile -->
				<div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
					<div class="modal-dialog sidebar-sm">
						<form class="add-new-record modal-content pt-0" id="ClientForm" name="ClientForm" method="POST" action="{{route('store_data', Auth::user()->id)}}">
							@csrf
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
							<div class="modal-header mb-1">
								<h5 class="modal-title" id="modalHeading"></h5>
							</div>
							<input type="hidden" name="Client_id" id="Client_id">
							<div class="modal-body flex-grow-1">
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-fullname">Full Name</label>
									<input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->name}}" />
								</div>
								<label class="form-label" for="basic-icon-default-post">Phone</label>
								<div class="input-group input-group-merge mb-2">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon5">+62</span>
									</div>
									<input id="phone" name="phone" type="text" class="form-control" value="{{$user->phone}}">
								</div>
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-email">Email</label>
									<input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email" value="{{$user->email}}" disabled />
									<small class="form-text text-muted"> You can use letters, numbers & periods </small>
								</div>

								<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create" onclick="Swal.fire({
                    icon: 'success',
                    title: 'Saved Successfully!',
                  })">
									Submit
								</button>
								<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
							</div>
						</form>
						<!-- </form>-->

					</div>
				</div>
				<!-- End Modal -->


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
				<!--End profile-->

			</div>
			<!---End Content Body -->
		</div>

		@endrole
	</div>
	<!-- END: Content-->
	@endsection

	@push('scripts')
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script type="text/javascript">
		$(function() {
			// popover
			$('[data-toggle="popover"]').popover();

			$(document).on('click', '#btn_edit_profil', function() {
				$('#modals_profil').modal('hide');
			})

			$(document).on('click', '#btn_edit_picture', function() {
				$('#modals_profil').modal('hide');
			})

			$(document).on('click', '#btn_edit_background', function() {
				$('#modals_profil').modal('hide');
			})
		});



		// modal edit
		$('body').on('click', '#edit_profil', function() {
			// $('#saveBtn').val("edit-profil");
			// $('#modals_profil').modal('show');
			// save data
			$('#saveBtn').click(function(e) {
				// e.preventDefault();
				$(this).html('Sending..');
				$('#modals_profil').modal('hide');
			})
		});
	</script>
	@endpush