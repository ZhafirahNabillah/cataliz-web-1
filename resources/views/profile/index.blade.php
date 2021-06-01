@extends('layouts.layoutVerticalMenu')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('title','Profil')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')

<!-- BEGIN: Content-->
<div class="app-content content ">
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
								<li class="breadcrumb-item"><a href="{{route('profil', $user->id)}}">Profile</a>
								</li>
								<li class="breadcrumb-item">{{$user->name}}
								</li>
								<li class="breadcrumb-item active">Detail
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
				<div class="row">
					<div class="col-sm-12 ">
						<div class="card profile-header mb-2 position-relative ">

							<!-- profile cover photo -->
							@if ($user->background_picture == 'background_default.jpg')
							<img class="card-img-top" style="height: 569px;" src="{{ asset('assets/images/avatars/'.$user->background_picture) }}" alt="User Profile Image" />
							@else
							<img class="card-img-top" style="height: 569px;" src="{{ $contents_bg }}" alt="User Profile Image" />
							@endif
							<!--/ profile cover photo -->

							<div class="position-relative">
								<!-- profile picture -->
								<div class="profile-img-container d-flex align-items-center">
									<div class="profile-img">
										@if ($user->profil_picture == 'cataliz.jpg')
										<img src="{{ asset('assets/images/avatars/'.$user->profil_picture) }}" class="rounded img-fluid" alt="Card image" id="profil" />
										@else
										<img src="{{ $contents }}" class="rounded img-fluid" alt="Card image" id="profil" style="width: 115px; height: 115px; background-position: center;" />
										@endif
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
												@role('mentor')
												<li class="nav-item">
													<a class="nav-link " id="detailProfile-tab" data-toggle="tab" href="#detailProfile" aria-controls="detailProfile" role="tab" aria-selected="true">Detail Profile</a>
												</li>
												@endrole
												@role('coachee')
												<li class="nav-item">
													<a class="nav-link " id="profile-tab" data-toggle="tab" href="#feedback" aria-controls="feedback" role="tab" aria-selected="true">Feedback</a>
												</li>
												@endrole
											</ul>
										</div>

										<!-- edit button -->
										<div>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modals_profil" aria-expanded="false" id="edit_profil">
												Edit
											</button>
										</div>

										<!-- Modal Profil Picture-->
										<div class="modal fade" id="modal_edit_profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Update Foto
															Profil</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form action="{{route('update_profil', Auth::user()->id)}}" method="POST" enctype="multipart/form-data" id="formProfilePicture">
														<div class="modal-body">
															@csrf
															<input type="file" name="profil_picture" id="profil_picture" class="profil_picture">
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="saveProfilePictureBtn">Simpan</button>
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										<!--/ Modal Profil Picture-->

										<!-- Modal Background picture -->
										<div class="modal fade" id="modal_edit_background" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Update Background
														</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form action="{{route('update_background', Auth::user()->id)}}" method="POST" enctype="multipart/form-data" id="formBackgroundPicture">
															@csrf
															<input type="file" name="background_picture" id="background_picture">
															<div id="background_picture-error"></div>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary" id="saveBackgroundPictureBtn">Simpan</button>
														</form>
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
													</div>
												</div>
											</div>
										</div>
										<!--/ Modal Background picture -->

										<!-- modal edit profile-->
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
										<!--/ modal edit profile-->

										<!-- Modal edit personal information-->
										@role('coachee')
										<div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
											<div class="modal-dialog sidebar-sm">
												<form class="add-new-record modal-content pt-0" id="formEditProfileCoachee" name="formEditProfileCoachee" method="POST" action="{{route('store_data', Auth::user()->id)}}">
													@csrf
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
													<div class="modal-header mb-1">
														<h5 class="modal-title" id="modalHeading"></h5>
													</div>
													<input type="hidden" name="Client_id" id="Client_id">
													<div class="modal-body flex-grow-1">
														<div class="form-group">
															<label class="form-label" for="basic-icon-default-fullname">Full
																Name</label>
															<input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->name}}" />
															<div id="name-error"></div>
														</div>
														<label class="form-label" for="basic-icon-default-post">Phone</label>
														<div class="form-group">
															<div class="input-group input-group-merge">
																<div class="input-group-prepend">
																	<span class="input-group-text" id="basic-addon5">+62</span>
																</div>
																<input id="phone" name="phone" type="text" class="form-control" value="{{$user->phone}}">
															</div>
															<div id="phone-error"></div>
														</div>
														<div class="form-group">
															<label class="form-label" for="basic-icon-default-email">Email</label>
															<input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email" value="{{$user->email}}" readonly />
															<small class="form-text text-muted"> You can use letters,
																numbers & periods </small>
														</div>
														<div class="form-group">
															<label class="form-label" for="basic-icon-default-fullname">Organization</label>
															<input id="organization" name="organization" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->organization}}" readonly />
														</div>
														<div class="form-group">
															<label class="form-label" for="basic-icon-default-fullname">Company</label>
															<input id="company" name="company" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->company}}" readonly />
														</div>
														<div class="form-group">
															<label class="form-label" for="basic-icon-default-fullname">Occupation</label>
															<input id="occupation" name="occupation" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->occupation}}" readonly />
														</div>
														<button type="submit" class="btn btn-primary data-submit mr-1" id="saveProfileCoacheeBtn">Submit</button>
														<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
													</div>
												</form>
											</div>
										</div>
										@else
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
															<label class="form-label" for="basic-icon-default-fullname">Full
																Name</label>
															<input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$user->name}}" />
															<div id="name-error"></div>
														</div>
														<div class="form-group">
															<label class="form-label" for="basic-icon-default-post">Phone</label>
															<div class="input-group input-group-merge">
																<div class="input-group-prepend">
																	<span class="input-group-text" id="basic-addon5">+62</span>
																</div>
																<input id="phone" name="phone" type="text" class="form-control" value="{{$user->phone}}">
															</div>
															<div id="phone-error"></div>
														</div>
														<div class="form-group">
															<label class="form-label" for="basic-icon-default-email">Email</label>
															<input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email" value="{{$user->email}}" readonly />
															<small class="form-text text-muted"> You can use letters,
																numbers & periods </small>
														</div>
														<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn1" value="create">Submit</button>
														<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
													</div>
												</form>
											</div>
										</div>
										@endrole
									</div>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="tab-content">

				{{-- home tab --}}
				<div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
					<section id="profile-info">
						<div class="row">
							@if ($message = Session::get('success'))
							<div class="col-sm-12">
								<div class="alert alert-success alert-dissmisable">
									<h4 class="alert-heading">Success</h4>
									<div class="alert-body">{{ $message }}</div>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
							</div>
							@endif

							{{-- summary profile --}}
							<div class="col-lg-4 col-12 order-2 order-lg-1">
								<div class="card">
									<div class="card-body">
										<h5 class="mb-75">Joined:</h5>
										<p class="card-text">
											{{\Carbon\Carbon::parse($user->created_at)->format('F d, Y')}}
										</p>
										<div class="mt-2">
											<h5 class="mb-75">Phone:</h5>
											<p class="card-text">+62{{$user->phone}}</p>
										</div>
										<div class="mt-2">
											<h5 class="mb-75">Email:</h5>
											<p class="card-text">{{$user->email}}</p>
										</div>
										@role('coachee')
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
										@endrole
									</div>
								</div>
							</div>

							{{-- change password  --}}
							<div class="col-lg-8 col-4 order-1 order-lg-2">
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
													<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">Save Change</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</section>
				</div>

				@role('coachee')
				{{-- feedback tab --}}
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

														<span class="d-block font-italic span_none_feedback">Tidak ada
															file</span>

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
				@endrole


				@role('mentor')
				{{-- detailProfile tab --}}
				<div class="tab-pane" id="detailProfile" aria-labelledby="about-tab" role="tabpanel">

					<div class="card-body">
						<div class="nav-vertical">
							<ul class="nav nav-tabs nav-left flex-column" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="baseVerticalLeft-tab1" data-toggle="tab" aria-controls="tabVerticalLeft1" href="#tabVerticalLeft1" role="tab" aria-selected="true">Category</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="baseVerticalLeft-tab2" data-toggle="tab" aria-controls="tabVerticalLeft2" href="#tabVerticalLeft2" role="tab" aria-selected="false">Expertise</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="baseVerticalLeft-tab3" data-toggle="tab" aria-controls="tabVerticalLeft3" href="#tabVerticalLeft3" role="tab" aria-selected="false">Education</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="baseVerticalLeft-tab4" data-toggle="tab" aria-controls="tabVerticalLeft4" href="#tabVerticalLeft4" role="tab" aria-selected="false">Employment</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="baseVerticalLeft-tab5" data-toggle="tab" aria-controls="tabVerticalLeft5" href="#tabVerticalLeft5" role="tab" aria-selected="false">languages</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="baseVerticalLeft-tab6" data-toggle="tab" aria-controls="tabVerticalLeft6" href="#tabVerticalLeft6" role="tab" aria-selected="false">Overview</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="baseVerticalLeft-tab7" data-toggle="tab" aria-controls="tabVerticalLeft7" href="#tabVerticalLeft7" role="tab" aria-selected="false">Address</a>
								</li>
							</ul>
							<div class="tab-content">
								<!-- category -->
								<div class="tab-pane active" id="tabVerticalLeft1" role="tabpanel" aria-labelledby="baseVerticalLeft-tab1">
									<div class="card">
										<div class="card-body">
											<h3><a href="javascript:;" class="editCategory"><span data-feather="edit"></span></a>Tell us about the work you do! </h3>
											<br>
											<div id="categories_wrapper">
												@if ($categories == null)
													<span>No data</span>
												@else
													@foreach ($categories->pluck('category') as $category)
														<li>{{ $category }}</li>
													@endforeach
												@endif
											</div>

											<!-- Modal Category-->
											<div class="modal fade bd-example-modal-lg" id="modalEditCategory" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg " role="document">
													<div class="modal-content">
														<div class="modal-header" style="background-color: #DCD9FF;">
															<h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form id="categories_edit_form">
																<h5 class="text-left">Select Category</h5>
																<div class="text-left">
																	@foreach ($main_categories = $all_categories->take(7) as $category)
																		<label for="primary{{$loop->iteration}}" class="btn btn-outline-dark text-left">
																			{{$category->category}}
																			@if ($categories == null)
																				<input name="categories[]" type="checkbox" id="primary{{$loop->iteration}}" class="badgebox" value="{{$category->id}}">
																			@else
																				<input name="categories[]" type="checkbox" id="primary{{$loop->iteration}}" class="badgebox" value="{{$category->id}}" @if($categories->pluck('id')->contains($category->id)) checked @endif>
																			@endif
																			<span class="badge" id="checked{{$loop->iteration}}">&check;</span>
																		</label>
																	@endforeach
																</div>
																<br>
																<div class="form-group text-left">
																	<label class="form-label" for="register-username">Others</label>
																	<select class="category-select form-control @error('category') is-invalid @enderror"
																	name="categories[]" multiple>
																		@foreach ($all_categories->whereNotIn('id', $main_categories->pluck('id')) as $category)
																			@if ($categories == null)
																				<option value="{{ $category->id }}">{{ $category->category }}</option>
																			@else
																				<option value="{{ $category->id }}" @if($categories->pluck('id')->contains($category->id)) selected @endif>{{ $category->category }}</option>
																			@endif
																		@endforeach
																	</select>
																	@error('category')
																		<span class="invalid-feedback" role="alert">
																			<strong>{{ $message }}</strong>
																		</span>
																	@enderror
																</div>
															</form>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary" id="saveCategoriesBtn">Save Changes</button>
														</div>
													</div>
												</div>
											</div>
											<!-- /modal Category-->
										</div>
									</div>
								</div>

								<!-- expertise -->
								<div class="tab-pane" id="tabVerticalLeft2" role="tabpanel" aria-labelledby="baseVerticalLeft-tab2">
									<div class="card">
										<div class="card-body">
											<h3><a href="javascript:;" class="editExpertise"><span data-feather="edit"></span></a>What is your skill?</h3>
											<br>
											<h5>Skill</h5>
											<div id="skills_wrapper">
												@if ($skills == null)
													<span>No data</span>
												@else
													@foreach ($skills->pluck('skill_name') as $skill)
														<li>{{ $skill }}</li>
													@endforeach
												@endif
											</div>

											<!-- Modal expertise-->
											<div class="modal fade bd-example-modal-lg" id="modalEditExpertise" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg " role="document">
													<div class="modal-content">
														<div class="modal-header" style="background-color: #DCD9FF;">
															<h5 class="modal-title" id="exampleModalLongTitle">Edit Expertise</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form id="skills_edit_form">
																<h5>Select skill</h5>
																<div class="form-group">
																	<select id="skill-select" class="form-control @error('category') is-invalid @enderror" name="skill[]" multiple>
																		@foreach ($all_skills as $skill)
																			@if ($skills == null)
																				<option id="skill-{{$skill->id}}" value="{{ $skill->id }}">{{ $skill->skill_name }}</option>
																			@else
																				<option id="skill-{{$skill->id}}" value="{{ $skill->id }}" @if($skills->pluck('id')->contains($skill->id)) selected @endif>{{ $skill->skill_name }}</option>
																			@endif
																		@endforeach
																	</select>
																</div>
															</form>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary" id="saveSkillsBtn">Save Changes</button>
														</div>
													</div>
												</div>
											</div>
											<!-- /modal expertise-->

										</div>
									</div>
								</div>

								<!-- education -->
								<div class="tab-pane" id="tabVerticalLeft3" role="tabpanel" aria-labelledby="baseVerticalLeft-tab3">
									<div class="card">
										<div class="card-body">
											<h3><a href="javascript:;" class="editEducation"><span data-feather="edit"></span></a>The schools you attended, areas of study, and degrees earned!</h3>
											<br>
											<div id="educations_wrapper">
												@forelse ($educations as $education)
													<h5>University</h5>
													<span>{{ $education->university ?? '-' }}</span>
													<br><br>
													<h5>Field of study</h5>
													<span>{{ $education->field_of_study ?? '-' }}</span>
													<br><br>
													<h5>Degree</h5>
													<span>{{ $education->degree ?? '-' }}</span>
													<br><br>
													<h5>Year</h5>
													<span>{{ $education->start_year ?? '-' }} - {{ $education->end_year ?? '-' }}</span>
													<br><br>
													@unless ($loop->last)
														<hr class="mt-0">
													@endunless
												@empty
													<span>No data</span>
												@endforelse
											</div>

											<!-- Modal Education-->
											<div class="modal fade bd-example-modal-lg" id="modalEditEducation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg " role="document">
													<div class="modal-content">
														<div class="modal-header" style="background-color: #DCD9FF;">
															<h5 class="modal-title" id="exampleModalLongTitle">Edit Education</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form id="educations_edit_form">
																<h2 class="fs-title">Add the schools you attended, areas of study, and degrees earned!</h2>
																<br>
																<div class="educations_form_wrapper">
																	@foreach ($educations as $education)
																		<div class="singe_education_wrapper">
																			<div class="form-group">
																				<h5>University</h5>
																				<input class="form-control" type="text" name="education[{{ $loop->index }}][university]" placeholder="ex. Oxford University" value="{{ $education->university }}"/>
																			</div>
																			<div class="form-group">
																				<h5>Field of study</h5>
																				<input class="form-control" type="text" name="education[{{ $loop->index }}][field_of_study]" placeholder="ex. Information System" value="{{ $education->field_of_study }}" />
																			</div>
																			<div class="form-group">
																				<h5>Degree</h5>
																				<input class="form-control" type="text" name="education[{{ $loop->index }}][degree]" placeholder="ex. Bachelor Degree" value="{{ $education->degree }}"/>
																			</div>
																			<div class="row">
																				<div class="col-6">
																					<h5>Start Year</h5>
																					<div class="form-group">
																						<select class="form-control" name="education[{{ $loop->index }}][start_year]">
																							<option disabled selected> Pilih </option>
																								@for ($i=1950; $i < date('Y')+1; $i++)
																									@if (isset($education->year))
																										<option value="{{ $i }}" @if ($education->start_year == $i) selected @endif>{{ $i }}</option>
																									@else
																										<option value="{{ $i }}">{{ $i }}</option>
																									@endif
																								@endfor
																							</select>
																						</div>
																					</div>
																					<div class="col-6">
																						<h5>End Year(or expected)</h5>
																						<div class="form-group">
																							<select class="form-control" name="education[{{ $loop->index }}][end_year]">
																								<option disabled selected> Pilih </option>
																									@for ($i=1950; $i < date('Y')+5; $i++)
																										@if (isset($education->year))
																											<option value="{{ $i }}" @if ($education->end_year == $i) selected @endif>{{ $i }}</option>
																										@else
																											<option value="{{ $i }}">{{ $i }}</option>
																										@endif
																									@endfor
																								</select>
																							</div>
																						</div>
																					</div>
																				</div>
																				@unless ($loop->last)
																					<hr class="mt-0">
																				@endunless
																			@endforeach
																		</div>
															</form>
															<div class="text-left">
																<hr class="mt-0">
																<input type="button" id="addOthersEducationBtn" class="btn btn-primary" value="+ Add Others Education">
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary" id="saveEducationBtn">Save Changes</button>
														</div>
													</div>
												</div>
											</div>
											<!-- /modal Education-->
										</div>
									</div>
								</div>

								<!-- employment -->
								<div class="tab-pane" id="tabVerticalLeft4" role="tabpanel" aria-labelledby="baseVerticalLeft-tab4">
									<div class="card">
										<div class="card-body">
											<h3><a href="javascript:;" class="editEmployment"><span data-feather="edit"></span></a>My work experience </h3>
											<br>
											<h5>Beginner</h5>
											@if ($beginner_status == 1)
												<span id="beginner_status">Yes</span>
											@else
												<span id="beginner_status">No</span>
											@endif
											<hr>
											<div id="work_experiences_wrapper">
												@forelse ($work_experiences as $work_experience)
													<h5>Company</h5>
													<span>{{ $work_experience->company }}</span>
													<br><br>
													<h5>Location</h5>
													<span>{{ $work_experience->location }}</span>
													<br><br>
													<h5>Position</h5>
													<span>{{ $work_experience->position }}</span>
													<br><br>
													<h5>Work Period</h5>
													@if (isset($work_experience->is_currently_work))
														<span>{{ $work_experience->entry_month.', '.$work_experience->entry_year }} - Now</span>
													@else
														<span>{{ $work_experience->entry_month.', '.$work_experience->entry_year }} - {{ $work_experience->out_month.', '.$work_experience->out_year }}</span>
													@endif
													<br><br>
													<h5>Description</h5>
													<div class="text-justify">
														<span>{{ $work_experience->description }}</span>
													</div>
													@unless ($loop->last)
														<hr>
													@endunless
												@empty
													<span>No data</span>
												@endforelse
											</div>

											<!-- Modal Employment-->
											<div class="modal fade bd-example-modal-lg" id="modalEditEmployment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg " role="document">
													<div class="modal-content">
														<div class="modal-header" style="background-color: #DCD9FF;">
															<h5 class="modal-title" id="exampleModalLongTitle">Edit Employment</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form id="employment_edit_form">
																<div class="form-group text-left">
																	<h5>Are you beginner?</h5>

																	<input type="radio" name="beginner" id="beginner_yes" value="1" @if ($beginner_status == 1) checked @endif>
																	<label class="form-check-label" for="beginner_yes">Yes</label>

																	<input type="radio" name="beginner" id="beginner_no" value="0" @if ($beginner_status == 0) checked @endif>
																	<label class="form-check-label" for="beginner_no">No</label>
																</div>

																<h5>Add Employment</h5>
																<hr>
																<div class="work_experiences_form_wrapper">
																	@foreach ($work_experiences as $work_experience)
																		<div class="single_work_experiences_wrapper">
																			<div class="form-group">
																				<h5>Company</h5>
																				<input class="form-control" type="text" name="work_experiences[{{ $loop->index }}][company]" placeholder="ex. PT. Wahana Integra Nusantara" value="{{ $work_experience->company }}"/>
																			</div>
																			<div class="form-group">
																				<h5>Location</h5>
																				<input class="form-control" type="text" name="work_experiences[{{ $loop->index }}][location]" placeholder="ex. Street name, City, Province, Nation" value="{{ $work_experience->location }}"/>
																			</div>
																			<div class="form-group">
																				<h5>Current Position</h5>
																				<input class="form-control" type="text" name="work_experiences[{{ $loop->index }}][position]" placeholder="ex. Manager" value="{{ $work_experience->position }}"/>
																			</div>
																			<div class="row">
																				<div class="col-3">
																					<h5>Entry</h5>
																					<div class="form-group">
																						<select class="form-control" name="work_experiences[{{ $loop->index }}][entry_month]">
																							<option disabled selected> Select month </option>
																							<option value='January' @if ($work_experience->entry_month == 'January') selected @endif>January</option>
																							<option value='February' @if ($work_experience->entry_month == 'February') selected @endif>February</option>
																							<option value='March' @if ($work_experience->entry_month == 'March') selected @endif>March</option>
																							<option value='April' @if ($work_experience->entry_month == 'April') selected @endif>April</option>
																							<option value='May' @if ($work_experience->entry_month == 'May') selected @endif>May</option>
																							<option value='June' @if ($work_experience->entry_month == 'June') selected @endif>June</option>
																							<option value='July' @if ($work_experience->entry_month == 'July') selected @endif>July</option>
																							<option value='August' @if ($work_experience->entry_month == 'August') selected @endif>August</option>
																							<option value='September' @if ($work_experience->entry_month == 'September') selected @endif>September</option>
																							<option value='October' @if ($work_experience->entry_month == 'October') selected @endif>October</option>
																							<option value='November' @if ($work_experience->entry_month == 'November') selected @endif>November</option>
																							<option value='December' @if ($work_experience->entry_month == 'December') selected @endif>December</option>
																						</select>
																					</div>
																				</div>
																				<div class="col-3">
																					<h5>&nbsp;</h5>
																					<div class="form-group">
																						<select class="form-control" name="work_experiences[{{ $loop->index }}][entry_year]">
																							<option disabled selected> Select year </option>
																							@for ($i=1950; $i < date('Y'); $i++)
																								<option value="{{ $i }}" @if ($work_experience->entry_year == $i) selected @endif>{{ $i }}</option>
																							@endfor
																						</select>
																					</div>
																				</div>
																				<div class="col-3">
																					<h5>Out</h5>
																					<div class="form-group">
																						<select class="form-control work_experience_out_{{ $loop->index }}" name="work_experiences[{{ $loop->index }}][out_month]" @if (isset($work_experience->is_currently_work)) disabled @endif>
																							<option disabled selected> Select month </option>
																							<option value='January' @if (isset($work_experience->out_month) && $work_experience->out_month == 'January') selected @endif>January</option>
																							<option value='February' @if (isset($work_experience->out_month) && $work_experience->out_month == 'February') selected @endif>February</option>
																							<option value='March' @if (isset($work_experience->out_month) && $work_experience->out_month == 'March') selected @endif>March</option>
																							<option value='April' @if (isset($work_experience->out_month) && $work_experience->out_month == 'April') selected @endif>April</option>
																							<option value='May' @if (isset($work_experience->out_month) && $work_experience->out_month == 'May') selected @endif>May</option>
																							<option value='June' @if (isset($work_experience->out_month) && $work_experience->out_month == 'June') selected @endif>June</option>
																							<option value='July' @if (isset($work_experience->out_month) && $work_experience->out_month == 'July') selected @endif>July</option>
																							<option value='August' @if (isset($work_experience->out_month) && $work_experience->out_month == 'August') selected @endif>August</option>
																							<option value='September' @if (isset($work_experience->out_month) && $work_experience->out_month == 'September') selected @endif>September</option>
																							<option value='October' @if (isset($work_experience->out_month) && $work_experience->out_month == 'October') selected @endif>October</option>
																							<option value='November' @if (isset($work_experience->out_month) && $work_experience->out_month == 'November') selected @endif>November</option>
																							<option value='December' @if (isset($work_experience->out_month) && $work_experience->out_month == 'December') selected @endif>December</option>
																						</select>
																					</div>
																					<div class="form-group">
																						<input class="form-check-input" id="is_currently_work_{{ $loop->index }}" data-id={{ $loop->index }} type="checkbox" name="work_experiences[{{ $loop->index }}][is_currently_work]" value="1" @isset ($work_experience->is_currently_work) checked @endif>
																						<label class="form-check-label" for="is_currently_work_{{ $loop->index }}">
																							No, I currently work here
																						</label>
																					</div>
																				</div>
																				<div class="col-3">
																					<h5>&nbsp;</h5>
																					<div class="form-group">
																						<select class="form-control work_experience_out_{{ $loop->index }}" name="work_experiences[{{ $loop->index }}][out_year]" @if (isset($work_experience->is_currently_work)) disabled @endif>
																							<option disabled selected> Select year </option>
																							@for ($i=1950; $i < date('Y'); $i++)
																								@if (isset($work_experience->out_year))
																									<option value="{{ $i }}" @if ($work_experience->out_year == $i) selected @endif>{{ $i }}</option>
																								@else
																									<option value="{{ $i }}">{{ $i }}</option>
																								@endif
																							@endfor
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="form-group">
																				<h5>Description (Optional)</h5>
																				<textarea class="form-control" type="text" name="work_experiences[{{ $loop->index }}][description]">{{ $work_experience->description }}</textarea>
																			</div>
																		</div>
																		@unless ($loop->last)
																			<hr>
																		@endunless
																	@endforeach
																</div>
															</form>

															<div class="text-left">
																<hr class="mt-0">
																<input type="button" id="addOthersWorkExperienceBtn" class="btn btn-primary" value="+ Add Others Work Experience">
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary" id="saveWorkExperienceBtn">Save Changes</button>
														</div>
													</div>
												</div>
											</div>
											<!-- /modal Employment-->

										</div>
									</div>
								</div>

								<!-- languages -->
								<div class="tab-pane" id="tabVerticalLeft5" role="tabpanel" aria-labelledby="baseVerticalLeft-tab5">
									<div class="card">
										<div class="card-body">
											<h3><a href="javascript:;" class="editLanguages"><span data-feather="edit"></span></a>Add the language you are good at</h3>
											<br>
											<div id="languages_wrapper">
												@forelse ($languages as $language)
													<h5>{{ $language->language ?? '-' }}</h5>
													<span>{{ $language->proficiency ?? '-' }}</span>
													<br><br>
												@empty
													<span>No data</span>
												@endforelse
											</div>


											<!-- Modal Languages-->
											<div class="modal fade bd-example-modal-lg" id="modalEditLanguages" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg " role="document">
													<div class="modal-content">
														<div class="modal-header" style="background-color: #DCD9FF;">
															<h5 class="modal-title" id="exampleModalLongTitle">Edit Languages</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form id="languages_edit_form">
																<div class="form-group text-left">
									                <h5>What is your English proficiency?</h5>
									                <input type="hidden" name="languages[0][language]" value="English">
																	@if (isset($languages->first()->proficiency))
																		<input type="radio" name="languages[0][proficiency]" id="englist_basic" value="Basic" @if ($languages->first()->proficiency == 'Basic') checked @endif>
																	@else
																		<input type="radio" name="languages[0][proficiency]" id="englist_basic" value="Basic">
																	@endif
									                <label class="form-check-label" for="englist_basic">Basic</label>

																	@if (isset($languages->first()->proficiency))
																		<input type="radio" name="languages[0][proficiency]" id="english_good" value="Good" @if ($languages->first()->proficiency == 'Good') checked @endif>
																	@else
																		<input type="radio" name="languages[0][proficiency]" id="english_good" value="Good">
																	@endif
									                <label class="form-check-label" for="english_good">Good</label>

																	@if (isset($languages->first()->proficiency))
																		<input type="radio" name="languages[0][proficiency]" id="english_fluent" value="Fluent" @if ($languages->first()->proficiency == 'Fluent') checked @endif>
																	@else
																		<input type="radio" name="languages[0][proficiency]" id="english_fluent" value="Fluent">
																	@endif
									                <label class="form-check-label" for="english_fluent">Fluent</label>

																	@if (isset($languages->first()->proficiency))
																		<input type="radio" name="languages[0][proficiency]" id="english_native" value="Native" @if ($languages->first()->proficiency == 'Native') checked @endif>
																	@else
																		<input type="radio" name="languages[0][proficiency]" id="english_native" value="Native">
																	@endif
									                <label class="form-check-label" for="english_native">Native</label>
									              </div>

									              <h5>What other languages do you speak?</h5>
									              <div class="others_languange_wrapper">
																	@foreach ($languages as $language)
																		@unless ($loop->first)
																			<div class="single_others_language_wrapper">
																				<div class="form-group">
																					<h5>Language</h5>
																					<input class="form-control" id="other_language" type="text" name="languages[{{ $loop->index }}][language]"
																					placeholder="ex. Arabian" value="{{ $language->language }}" />
																				</div>
																				<div class="form-group text-left">
																					<h5>Proficiency</h5>
																					@if (isset($language->proficiency))
																						<input type="radio" name="languages[{{ $loop->index }}][proficiency]" id="others_{{ $loop->index }}_basic" value="Basic" @if ($language->proficiency == 'Basic') checked @endif>
																					@else
																						<input type="radio" name="languages[{{ $loop->index }}][proficiency]" id="others_{{ $loop->index }}_basic" value="Basic">
																					@endif
																					<label class="form-check-label" for="others_{{ $loop->index }}_basic">Basic</label>

																					@if (isset($language->proficiency))
																						<input type="radio" name="languages[{{ $loop->index }}][proficiency]" id="others_{{ $loop->index }}_good" value="Good" @if ($language->proficiency == 'Good') checked @endif>
																					@else
																						<input type="radio" name="languages[{{ $loop->index }}][proficiency]" id="others_{{ $loop->index }}_basic" value="Basic">
																					@endif
																					<label class="form-check-label" for="others_{{ $loop->index }}_good">Good</label>

																					@if (isset($language->proficiency))
																						<input type="radio" name="languages[{{ $loop->index }}][proficiency]" id="others_{{ $loop->index }}_fluent" value="Fluent" @if ($language->proficiency == 'Fluent') checked @endif>
																					@else
																						<input type="radio" name="languages[{{ $loop->index }}][proficiency]" id="others_{{ $loop->index }}_basic" value="Basic">
																					@endif
																					<label class="form-check-label" for="others_{{ $loop->index }}_fluent">Fluent</label>

																					@if (isset($language->proficiency))
																						<input type="radio" name="languages[{{ $loop->index }}][proficiency]" id="others_{{ $loop->index }}_native" value="Native" @if ($language->proficiency == 'Native') checked @endif>
																					@else
																						<input type="radio" name="languages[{{ $loop->index }}][proficiency]" id="others_{{ $loop->index }}_basic" value="Basic">
																					@endif
																					<label class="form-check-label" for="others_{{ $loop->index }}_native">Native</label>
																				</div>
																			</div>
																			<hr>
																		@endunless
																	@endforeach
									              </div>
															</form>
								              <div class="text-left">
								                <input type="button" id="addOthersLanguangeBtn" class="btn btn-primary" value="+ Add Others Languange">
								              </div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary" id="saveLanguagesBtn">Save Changes</button>
														</div>
													</div>
												</div>
											</div>
											<!-- /modal Languages-->

										</div>
									</div>
								</div>

								<!-- overview -->
								<div class="tab-pane" id="tabVerticalLeft6" role="tabpanel" aria-labelledby="baseVerticalLeft-tab6">
									<div class="card">
										<div class="card-body">
											<h3><a href="javascript:;" class="editOverview"><span data-feather="edit"></span></a>Write a great profile or description about your skills in your category!</h3>
											<br>
											<h5>Tittle</h5>
											<span id="description_title">{{ $description_title ?? '-' }}</span>
											<br><br>
											<h5>Overview</h5>
											<div class="text-justify">
												<span id="description_overview">{{ $description_overview ?? '-' }}</span>
											</div>

											<!-- Modal Overview-->
											<div class="modal fade bd-example-modal-lg" id="modalEditOverview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg " role="document">
													<div class="modal-content">
														<div class="modal-header" style="background-color: #DCD9FF;">
															<h5 class="modal-title" id="exampleModalLongTitle">Edit Overview</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form id="skills_description_edit_form">
																<div class="form-group">
																	<h5>Title</h5>
																	<input class="form-control" type="text" name="description_title" placeholder="Enter tittle" value="{{ $description_title ?? '' }}"/>
																</div>
																<div class="form-group">
																	<h5>Overview</h5>
																	<textarea class="form-control" type="text" name="description_overview">{{ $description_overview ?? '' }}</textarea>
																</div>
															</form>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary" id="saveSkillsDescriptionBtn">Save Changes</button>
														</div>
													</div>
												</div>
											</div>
											<!-- /modal Overview-->
										</div>
									</div>
								</div>

								<!-- address -->
								<div class="tab-pane" id="tabVerticalLeft7" role="tabpanel" aria-labelledby="baseVerticalLeft-tab7">
									<div class="card">
										<div class="card-body">
											<h3><a href="javascript:;" class="editAddress"><span data-feather="edit"></span></a>My Address</h3>
											<br>
											<h5>Street</h5>
											<span id="location_street">{{ $location->street ?? '-' }}</span>
											<br><br>
											<h5>City</h5>
											<span id="location_city">{{ $location->city ?? '-' }}</span>
											<br><br>
											<h5>Country</h5>
											<span id="location_country">{{ $location->country ?? '-' }}</span>
											<br><br>
											<h5>Postal Code</h5>
											<span id="location_postal_code">{{ $location->postal_code ?? '-' }}</span>

											<!-- Modal Address-->
											<div class="modal fade bd-example-modal-lg" id="modalEditAddress" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg " role="document">
													<div class="modal-content">
														<div class="modal-header" style="background-color: #DCD9FF;">
															<h5 class="modal-title" id="exampleModalLongTitle">Edit Address</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form id="location_edit_form">
																<div class="form-group">
																	<h5>Street</h5>
																	<input class="form-control" type="text" name="location[street]" placeholder="ex. 1234 Main Street, Apartment 101" value="{{ $location->street ?? '' }}"/>
																</div>
																<div class="form-group">
																	<h5>City</h5>
																	<input class="form-control" type="text" name="location[city]" placeholder="ex. Malang" value="{{ $location->city ?? '' }}"/>
																</div>
																<div class="form-group">
																	<h5>Country</h5>
																	<input class="form-control" type="text" name="location[country]" placeholder="ex. Indonesia" value="{{ $location->country ?? '' }}"/>
																</div>
																<div class="form-group">
																	<h5>Postal Code</h5>
																	<input class="form-control" type="text" name="location[postal_code]" placeholder="ex. 098811" value="{{ $location->postal_code ?? '' }}" />
																</div>
															</form>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary" id="saveAddressBtn">Save Changes</button>
														</div>
													</div>
												</div>
											</div>
											<!-- /modal Address-->

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endrole
			</div>
		</div>
	</div>

	<!-- END: Content-->
	@endsection

	@push('scripts')
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
	<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script src="//cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	<script src="{{ asset('assets/js/jquery.imgareaselect.min.js') }}"></script>
	<script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>
	<script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


	<script type="text/javascript">
		$('.category-select').select2({
				placeholder: 'Type category that match on you ...',
				tags: true
		});

		$("#skill-select").select2({
        placeholder: 'Type skill that match on you ...',
        tags: true
    });

		for (var i = 0; i < $('.single_work_experiences_wrapper').length; i++) {
			$('#is_currently_work_'+i).click(function() {
				// console.log($(this).data('id'));
				var id = $(this).data('id');
				if ($(this).is(":checked")) {
        	// $('#pizza_kind').prop('disabled', false);
					$('.work_experience_out_'+id).prop('disabled', 'disabled');
		    }
		    else {
					$('.work_experience_out_'+id).prop('disabled', false);
		    	// $('#pizza_kind').prop('disabled', 'disabled');
		    }
			})
		};

		// Modal for edit profile detail
		// Category
		$('body').on('click', '.editCategory', function() {
			$('#modalHeading').html("Edit Category");
			$('#modalEditCategory').modal('show');
		});

		// Expertise
		$('body').on('click', '.editExpertise', function() {
			$('#modalHeading').html("Edit Expertise");
			$('#modalEditExpertise').modal('show');
		});

		// Education
		$('body').on('click', '.editEducation', function() {
			$('#modalHeading').html("Edit Education");
			$('#modalEditEducation').modal('show');
		});

		// Employment
		$('body').on('click', '.editEmployment', function() {
			$('#modalHeading').html("Edit Employment");
			$('#modalEditEmployment').modal('show');
		});

		// Languages
		$('body').on('click', '.editLanguages', function() {
			$('#modalHeading').html("Edit Languages");
			$('#modalEditLanguages').modal('show');
		});

		// Overview
		$('body').on('click', '.editOverview', function() {
			$('#modalHeading').html("Edit Overview");
			$('#modalEditOverview').modal('show');
		});

		// Address
		$('body').on('click', '.editAddress', function() {
			$('#modalHeading').html("Edit Address");
			$('#modalEditAddress').modal('show');
		});

		$.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

		//submit categories fieldset
    $("#saveCategoriesBtn").click(function() {
      var data = $('#categories_edit_form').serialize();
      console.log(data);

      $.ajax({
        data: data,
        url: "{{ route('profile.save_categories', auth()->user()->id) }}",
        type: "POST",
        dataType: 'json',
        success: function(data) {
          // console.log(data.categories.length);
					$('#categories_wrapper').empty();

					for (let i = 0; i < (data.categories.length); i++) {
						$('#categories_wrapper').append('<li>'+data.categories[i]+'</li>');
					}

					$('#modalEditCategory').modal('hide');
        },
        error: function(reject) {
          // if (reject.status === 422) {
          //   var errors = JSON.parse(reject.responseText);
          //   if (errors.client) {
          //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
          //   }
          //   if (errors.group_code) {
          //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
          //   }
          //   if (errors.date) {
          //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
          //   }
          //   if (errors.objective) {
          //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
          //   }
          //   if (errors.success_indicator) {
          //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
          //   }
          //   if (errors.development_areas) {
          //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
          //   }
          //   if (errors.support) {
          //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
          //   }
          // }
        }
      });
    });

		//submit skills fieldset
    $("#saveSkillsBtn").click(function() {
      var data = $('#skills_edit_form').serialize();
      console.log(data);

      $.ajax({
        data: data,
        url: "{{ route('profile.save_skills', auth()->user()->id) }}",
        type: "POST",
        dataType: 'json',
        success: function(data) {
          console.log(data);
					$('#skills_wrapper').empty();

					for (let i = 0; i < (data.skills.length); i++) {
						$('#skills_wrapper').append('<li>'+data.skills[i]+'</li>');
					}

					$('#modalEditExpertise').modal('hide');
        },
        error: function(reject) {
          // if (reject.status === 422) {
          //   var errors = JSON.parse(reject.responseText);
          //   if (errors.client) {
          //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
          //   }
          //   if (errors.group_code) {
          //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
          //   }
          //   if (errors.date) {
          //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
          //   }
          //   if (errors.objective) {
          //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
          //   }
          //   if (errors.success_indicator) {
          //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
          //   }
          //   if (errors.development_areas) {
          //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
          //   }
          //   if (errors.support) {
          //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
          //   }
          // }
        }
      });
    });

		$("#saveEducationBtn").click(function() {
      var data = $('#educations_edit_form').serialize();
      console.log(data);

      $.ajax({
        data: data,
        url: "{{ route('profile.save_educations', auth()->user()->id) }}",
        type: "POST",
        dataType: 'json',
        success: function(data) {
					console.log(data.education);
					$('#educations_wrapper').empty();

					for (let i = 0; i < (data.educations.length); i++) {
						if (i != 0) {
							$('#educations_wrapper').append('<hr class="mt-0">');
						}
						$('#educations_wrapper').append(
							`<h5>University</h5>
							<span>`+data.educations[i].university+`</span>
							<br><br>
							<h5>Field of study</h5>
							<span>`+data.educations[i].field_of_study+`</span>
							<br><br>
							<h5>Degree</h5>
							<span>`+data.educations[i].degree+`</span>
							<br><br>
							<h5>Year</h5>
							<span>`+data.educations[i].start_year+` - `+data.educations[i].end_year+`</span>
							<br><br>`
						);
					}

					$('#modalEditEducation').modal('hide');
        },
        error: function(reject) {
          // if (reject.status === 422) {
          //   var errors = JSON.parse(reject.responseText);
          //   if (errors.client) {
          //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
          //   }
          //   if (errors.group_code) {
          //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
          //   }
          //   if (errors.date) {
          //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
          //   }
          //   if (errors.objective) {
          //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
          //   }
          //   if (errors.success_indicator) {
          //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
          //   }
          //   if (errors.development_areas) {
          //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
          //   }
          //   if (errors.support) {
          //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
          //   }
          // }
        }
      });
    });

		//submit work experience fieldset
    $("#saveWorkExperienceBtn").click(function() {
      var data = $('#employment_edit_form').serialize();
      console.log(data);

      $.ajax({
        data: data,
        url: "{{ route('profile.save_employments', auth()->user()->id) }}",
        type: "POST",
        dataType: 'json',
        success: function(data) {
					console.log(data.employments);
					$('#beginner_status').empty();
					$('#work_experiences_wrapper').empty();

					if (data.beginner_status == 1) {
						$('#beginner_status').text('Yes');
					} else {
						$('#beginner_status').text('No');
					}

					for (let i = 0; i < (data.employments.length); i++) {
						if (i != 0) {
							$('#work_experiences_wrapper').append('<hr>');
						}

						if (data.employments[i].is_currently_work) {
							var work_period_html = `<span>`+data.employments[i].entry_month+`, `+data.employments[i].entry_year+` - Now</span>`;
						} else {
							var work_period_html = `<span>`+data.employments[i].entry_month+`, `+data.employments[i].entry_year+` - `+data.employments[i].out_month+`, `+data.employments[i].out_year+`</span>`;
						}

						$('#work_experiences_wrapper').append(
							`<h5>Company</h5>
							<span>`+data.employments[i].company+`</span>
							<br><br>
							<h5>Location</h5>
							<span>`+data.employments[i].location+`</span>
							<br><br>
							<h5>Position</h5>
							<span>`+data.employments[i].position+`</span>
							<br><br>
							<h5>Work Period</h5>
							`+work_period_html+`
							<br><br>
							<h5>Description</h5>
							<div class="text-justify">
								<span>`+data.employments[i].description+`</span>
							</div>`
						);
					}

					$('#modalEditEmployment').modal('hide');
        },
        error: function(reject) {
          // if (reject.status === 422) {
          //   var errors = JSON.parse(reject.responseText);
          //   if (errors.client) {
          //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
          //   }
          //   if (errors.group_code) {
          //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
          //   }
          //   if (errors.date) {
          //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
          //   }
          //   if (errors.objective) {
          //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
          //   }
          //   if (errors.success_indicator) {
          //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
          //   }
          //   if (errors.development_areas) {
          //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
          //   }
          //   if (errors.support) {
          //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
          //   }
          // }
        }
      });
    });

		//submit languages fieldset
    $("#saveLanguagesBtn").click(function() {
      var data = $('#languages_edit_form').serialize();
      console.log(data);

      $.ajax({
        data: data,
        url: "{{ route('profile.save_languages', auth()->user()->id) }}",
        type: "POST",
        dataType: 'json',
        success: function(data) {
          console.log(data);

					$('#languages_wrapper').empty();

					for (let i = 0; i < (data.languages.length); i++) {
						$('#languages_wrapper').append(
							`<h5>`+data.languages[i].language+`</h5>
							<span>`+data.languages[i].proficiency+`</span>
							<br><br>`
						);
					}

					$('#modalEditLanguages').modal('hide');
        },
        error: function(reject) {
          // if (reject.status === 422) {
          //   var errors = JSON.parse(reject.responseText);
          //   if (errors.client) {
          //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
          //   }
          //   if (errors.group_code) {
          //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
          //   }
          //   if (errors.date) {
          //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
          //   }
          //   if (errors.objective) {
          //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
          //   }
          //   if (errors.success_indicator) {
          //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
          //   }
          //   if (errors.development_areas) {
          //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
          //   }
          //   if (errors.support) {
          //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
          //   }
          // }
        }
      });
    });

		//submit skills description fieldset
    $("#saveSkillsDescriptionBtn").click(function() {
      var data = $('#skills_description_edit_form').serialize();
      console.log(data);

      $.ajax({
        data: data,
        url: "{{ route('profile.save_overview', auth()->user()->id) }}",
        type: "POST",
        dataType: 'json',
        success: function(data) {
          console.log(data);

					$('#description_title').text(data.description_title);
					$('#description_overview').text(data.description_overview);

					$('#modalEditOverview').modal('hide');
        },
        error: function(reject) {
          // if (reject.status === 422) {
          //   var errors = JSON.parse(reject.responseText);
          //   if (errors.client) {
          //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
          //   }
          //   if (errors.group_code) {
          //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
          //   }
          //   if (errors.date) {
          //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
          //   }
          //   if (errors.objective) {
          //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
          //   }
          //   if (errors.success_indicator) {
          //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
          //   }
          //   if (errors.development_areas) {
          //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
          //   }
          //   if (errors.support) {
          //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
          //   }
          // }
        }
      });
    });

    //submit address fieldset
    $("#saveAddressBtn").click(function() {
      var data = $('#location_edit_form').serialize();
      console.log(data);

      $.ajax({
        data: data,
        url: "{{ route('profile.save_address', auth()->user()->id) }}",
        type: "POST",
        dataType: 'json',
        success: function(data) {
					console.log(data);

					$('#location_street').text(data.location.street);
					$('#location_city').text(data.location.city);
					$('#location_country').text(data.location.country);
					$('#location_postal_code').text(data.location.postal_code);

					$('#modalEditAddress').modal('hide');
        },
        error: function(reject) {
          // if (reject.status === 422) {
          //   var errors = JSON.parse(reject.responseText);
          //   if (errors.client) {
          //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
          //   }
          //   if (errors.group_code) {
          //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
          //   }
          //   if (errors.date) {
          //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
          //   }
          //   if (errors.objective) {
          //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
          //   }
          //   if (errors.success_indicator) {
          //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
          //   }
          //   if (errors.development_areas) {
          //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
          //   }
          //   if (errors.support) {
          //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
          //   }
          // }
        }
      });
    });

		// addEmployment
		$('#addOthersWorkExperienceBtn').click(function() {
			append_work_experience();
		});

		//method to append new work experiences
		index_work_experience = $('div.single_work_experiences_wrapper').length;
		function append_work_experience() {
			index = index_work_experience++;

			var others_work_experience_html =
				`<hr class="mt-0">
				<div class="form-group">
          <h5>Company</h5>
          <input class="form-control" id="company" type="text" name="work_experiences[` + index + `][company]" placeholder="ex. PT. Wahana Integra Nusantara"/>
        </div>
        <div class="form-group">
          <h5>Location</h5>
          <input class="form-control" id="location" type="text" name="work_experiences[` + index + `][location]" placeholder="ex. Street name, City, Province, Nation" />
        </div>
        <div class="form-group">
          <h5>Current Position</h5>
          <input class="form-control" id="current_position" type="text" name="work_experiences[` + index + `][position]" placeholder="ex. Manager"/>
        </div>
        <div class="row">
          <div class="col-3">
            <h5>Entry</h5>
            <div class="form-group">
              <select class="form-control" name="work_experiences[` + index + `][entry_month]" id="entry_month">
                <option disabled selected> Select month </option>
                <option value='January'>January</option>
                <option value='February'>February</option>
                <option value='March'>March</option>
                <option value='April'>April</option>
                <option value='May'>May</option>
                <option value='June'>June</option>
                <option value='July'>July</option>
                <option value='August'>August</option>
                <option value='September'>September</option>
                <option value='October'>October</option>
                <option value='November'>November</option>
                <option value='December'>December</option>
              </select>
            </div>
          </div>
          <div class="col-3">
            <h5>&nbsp;</h5>
            <div class="form-group">
              <select class="form-control" name="work_experiences[` + index + `][entry_year]" id="entry_year">
                <option disabled selected> Select year </option>
                @for ($i=1950; $i < date('Y'); $i++)
                  <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>
          </div>
          <div class="col-3">
            <h5>Out</h5>
            <div class="form-group">
              <select class="form-control" name="work_experiences[` + index + `][out_month]" id="out_month">
                <option disabled selected> Select month </option>
                <option value='January'>January</option>
                <option value='February'>February</option>
                <option value='March'>March</option>
                <option value='April'>April</option>
                <option value='May'>May</option>
                <option value='June'>June</option>
                <option value='July'>July</option>
                <option value='August'>August</option>
                <option value='September'>September</option>
                <option value='October'>October</option>
                <option value='November'>November</option>
                <option value='December'>December</option>
              </select>
            </div>
            <div class="form-group" id="n_form">
              <input class="form-check-input" type="checkbox" name="work_experiences[` + index + `][is_currently_work]"
              id="is_currently_work" value="1">
              <label class="form-check-label" for="is_currently_work">
                No, I currently work here
              </label>
            </div>
          </div>
          <div class="col-3">
            <h5>&nbsp;</h5>
            <div class="form-group">
              <select class="form-control" name="work_experiences[` + index + `][out_year]" id="out_year">
                <option disabled selected> Select year </option>
                @for ($i=1950; $i < date('Y'); $i++)
                  <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <h5>Description (Optional)</h5>
          <textarea class="form-control" id="description" type="text" name="work_experiences[` + index + `][description]"></textarea>
        </div>`;

			$('.work_experiences_form_wrapper').append(others_work_experience_html);
		}

		// AddEducation
		$('#addOthersEducationBtn').click(function() {
			append_education();
		});
		var date_now = new Date();
		var year = date_now.getFullYear();
		index_education = $('div.singe_education_wrapper').length;
		console.log(index_education);

		// method to append new education
		function append_education() {
			index = index_education++;
			console.log(index);
			var others_education_html = '<hr class="mt-0">';
			others_education_html += '<div class="form-group"><h5>University</h5><input class="form-control" id="university" type="text" name="education[' + index + '][university]" placeholder="ex. Oxford University"/></div>';
			others_education_html += '<div class="form-group"><h5>Field of study</h5><input class="form-control" id="field_of_study" type="text" name="education[' + index + '][field_of_study]" placeholder="ex. Information System"/></div>';
			others_education_html += '<div class="form-group"><h5>Degree</h5><input class="form-control" id="degree" type="text" name="education[' + index + '][degree]" placeholder="ex. Bachelor Degree"/></div>';
			others_education_html += '<div class="row">';
			others_education_html += '<div class="col-6"><h5>Start Year</h5><div class="form-group"><select class="form-control" name="education[' + index + '][start_year]" id="start_year"><option disabled selected>Pilih</option>';
			for (var i = 1950; i < year; i++) {
				others_education_html += '<option value="' + i + '">' + i + '</option>';
			}
			others_education_html += '</select></div></div>';
			others_education_html += '<div class="col-6"><h5>End Year(or expected)</h5><div class="form-group"><select class="form-control" name="education[' + index + '][end_year]" id="end_year"><option disabled selected> Pilih </option>';
			for (var i = 1950; i < year + 5; i++) {
				others_education_html += '<option value="' + i + '">' + i + '</option>';
			}
			others_education_html += '</select></div></div>';
			others_education_html += '</div>';

			$('.educations_form_wrapper').append(others_education_html);
		}

		// addLanguages
		$('#addOthersLanguangeBtn').click(function() {
			append_language();
		});
		var index_language = $('div.single_others_language_wrapper').length;
		// method to append new language
		function append_language() {
			index_language++;
			var others_language_html = '<div class="form-group"><h5>Language</h5><input class="form-control" type="text" name="languages[' + index_language + '][language]" placeholder="ex. Arabian"/></div>';
			others_language_html += '<div class="form-group text-left">';
			others_language_html += '<h5>Proficiency</h5>';
			others_language_html += '<input type="radio" name="languages[' + index_language + '][proficiency]" id="others_' + index_language + '_basic" value="Basic"> <label class="form-check-label" for="others_' + index_language + '_basic">Basic</label> ';
			others_language_html += '<input type="radio" name="languages[' + index_language + '][proficiency]" id="others_' + index_language + '_good" value="Good"> <label class="form-check-label" for="others_' + index_language + '_good">Good</label> ';
			others_language_html += '<input type="radio" name="languages[' + index_language + '][proficiency]" id="others_' + index_language + '_fluent" value="Fluent"> <label class="form-check-label" for="others_' + index_language + '_fluent">Fluent</label> ';
			others_language_html += '<input type="radio" name="languages[' + index_language + '][proficiency]" id="others_' + index_language + '_native" value="Native"> <label class="form-check-label" for="others_' + index_language + '_native">Native</label> ';
			others_language_html += '</div>';
			others_language_html += '<hr class="mt-0">';

			$('.others_languange_wrapper').append(others_language_html);
		}



		$(function() {
			// Cropping Image For Profil Picture
			$('.profil_picture').ijaboCropTool({
				preview: '#profil',
				processUrl: '{{route("update_profil",Auth::user()->id)}}',
				withCSRF: ['_token', '{{csrf_token()}}'],
				onSuccess: function(message, element, status) {
					Swal.fire({
						icon: 'success',
						title: message,
					});
					$('#modal_edit_profil').modal('hide');
				},
				onError: function(message, element, status) {
					Swal.fire({
						icon: 'warning',
						title: message,
					});
				}
			});

			// popover
			$('[data-toggle="popover"]').popover({
				html: true,
				trigger: 'hover',
				placement: 'top',
				content: function() {
					return '<img src="' + $(this).data('img') + '" />';
				}
			});
			$(document).on('click', '#btn_edit_profil', function() {
				$('#modals_profil').modal('hide');
			})
			$(document).on('click', '#btn_edit_picture', function() {
				$('#modals_profil').modal('hide');
			})
			$(document).on('click', '#btn_edit_background', function() {
				$('#modals_profil').modal('hide');
			})

			//script for coachee role
			@role('coachee')
			//datatable for feedbacks table
			var table = $('.yajra-datatable-feedback').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{route('clients.show_feedbacks', $user->id)}}",
				columns: [{
						data: 'DT_RowIndex',
						name: 'DT_RowIndex'
					},
					{
						data: 'coach.name',
						name: 'coach.name',
						defaultContent: '<i>-</i>'
					},
					{
						data: 'agenda_detail.session_name',
						name: 'agenda_detail.session_name',
						defaultContent: '<i>-</i>'
					},
					{
						data: 'agenda_detail.topic',
						name: 'agenda_detail.topic',
						defaultContent: '<i>-</i>'
					},
					{
						data: 'action',
						name: 'action',
						orderable: true,
						searchable: true
					},
				],
				dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
				language: {
					paginate: {
						// remove previous & next text from pagination
						previous: '&nbsp;',
						next: '&nbsp;'
					},
					search: "<i data-feather='search'></i>",
					searchPlaceholder: "Search records"
				}
			});
			// show_feedback
			$(document).on("click", "#detailFeedback", function() {
				console.log('masuk');
				let detail_agenda_id = $(this).data('id');
				$.get("" + '/clients/' + detail_agenda_id + '/show_detail_feedbacks', function(data) {
					$('#modalHeading').html("Detail Feedbacks");
					$('.session_feedback').html(data.session.session_name);
					$('.coach_name_feedback').html(data.coach.name);
					$('.topic_feedback').html(data.session.topic);
					$('.feedback').html(data.feedback.feedback);
					$('#show_feedback').modal('show');
					if (data.feedback.attachment == null) {
						$('.download_button_feedback').css("display", "none");
						$('.span_none_feedback').html('Tidak ada file');
					} else {
						$('.span_none_feedback').html(data.feedback.attachment);
						$('.download_button_feedback').removeAttr('style');
						$('.download_button_feedback').css("display", "relative");
					}
					$('.download_button_feedback').on('click', function() {
						window.location.href = ("" + '/agendas/' + detail_agenda_id + '/feedback_download');
					});
				});
			});
			@endrole
		});

		//method for validating phone number
		$.validator.addMethod("phoneNumber", function(value, element) {
			return this.optional(element) || /^[1-9][0-9]/.test(value);
		}, '<strong class="text-danger">Please enter a valid phone number!</strong>');
		$.validator.addMethod('filesize', function(value, element, param) {
			return this.optional(element) || (element.files[0].size <= param * 1000000)
		}, '<strong class="text-danger">File must be less than {0}MB!</strong>');

		//submit edit profile and validation
		$('#saveBtn1').click(function(e) {
			console.log('masuk');
			$('#ClientForm').validate({
				rules: {
					'phone': {
						required: true,
						'phoneNumber': true,
						minlength: 9,
						maxlength: 12
					},
					'name': {
						required: true
					}
				},
				messages: {
					'phone': {
						required: '<strong class="text-danger">Phone is required!</strong>',
						minlength: '<strong class="text-danger">Phone number at least contains 9 digits!</strong>',
						maxlength: '<strong class="text-danger">Phone number maximum contains 13 digits!</strong>'
					},
					'name': {
						required: '<strong class="text-danger">Name is required!</strong>'
					}
				},
				errorPlacement: function(error, element) {
					if (element.attr("name") == "phone") {
						error.appendTo("#phone-error");
					} else if (element.attr("name") == "name") {
						error.appendTo("#name-error");
					}
				},
				//submit Handler
				submitHandler: function(form) {
					form.submit();
					Swal.fire({
						icon: 'success',
						title: 'Updated succesfully!',
						showConfirmButton: false,
						timer: 1500
					});
				}
			});
			$('#modals_profil').modal('hide');
		});

		$('#saveProfileCoacheeBtn').click(function(e) {
			console.log('masuk');
			$('#formEditProfileCoachee').validate({
				rules: {
					'phone': {
						required: true,
						'phoneNumber': true,
						minlength: 9,
						maxlength: 12
					},
					'name': {
						required: true
					}
				},
				messages: {
					'phone': {
						required: '<strong class="text-danger">Phone is required!</strong>',
						minlength: '<strong class="text-danger">Phone number at least contains 9 digits!</strong>',
						maxlength: '<strong class="text-danger">Phone number maximum contains 13 digits!</strong>'
					},
					'name': {
						required: '<strong class="text-danger">Name is required!</strong>'
					}
				},
				errorPlacement: function(error, element) {
					if (element.attr("name") == "phone") {
						error.appendTo("#phone-error");
					} else if (element.attr("name") == "name") {
						error.appendTo("#name-error");
					}
				},
				//submit Handler
				submitHandler: function(form) {
					form.submit();
					Swal.fire({
						icon: 'success',
						title: 'Updated succesfully!',
						showConfirmButton: false,
						timer: 1500
					});
				}
			});
			$('#modals_profil').modal('hide');
		});

		//submit edit profile picture and validation
		$('#saveProfilePictureBtn').click(function(e) {
			console.log('masuk');
			$('#formProfilePicture').validate({
				rules: {
					'profil_picture': {
						required: true,
						accept: 'image/*',
						filesize: 2
					}
				},
				messages: {
					'profil_picture': {
						required: '<strong class="text-danger">Profile Picture is required!</strong>',
						accept: '<strong class="text-danger">Profile Picture must be an image file!</strong>',
					}
				},
				errorPlacement: function(error, element) {
					if (element.attr("name") == "profil_picture") {
						error.appendTo("#profil_picture-error");
					}
				},
				//submit Handler
				submitHandler: function(form) {
					form.submit();
					Swal.fire({
						icon: 'success',
						title: 'Updated succesfully!',
						showConfirmButton: false,
						timer: 1500
					});
				}
			});
		});

		//submit edit background picture and validation
		$('#saveBackgroundPictureBtn').click(function(e) {
			console.log('masuk');
			$('#formBackgroundPicture').validate({
				rules: {
					'background_picture': {
						required: true,
						accept: 'image/*',
						filesize: 2
					}
				},
				messages: {
					'background_picture': {
						required: '<strong class="text-danger">Background Picture is required!</strong>',
						accept: '<strong class="text-danger">Background Picture must be an image file!</strong>',
					}
				},
				errorPlacement: function(error, element) {
					if (element.attr("name") == "background_picture") {
						error.appendTo("#background_picture-error");
					}
				},
				//submit Handler
				submitHandler: function(form) {
					form.submit();
					Swal.fire({
						icon: 'success',
						title: 'Updated succesfully!',
						showConfirmButton: false,
						timer: 1500
					});
				}
			});
		});

		// modal edit
		$('body').on('click', '#edit_profil', function() {
			console.log('edit');
		});
	</script>
	@endpush
