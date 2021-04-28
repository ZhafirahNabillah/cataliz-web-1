@extends('layouts.layoutVerticalMenu')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">
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
							<img class="align-text  width=" 15" height="15"" src="
								{{asset('assets\images\icons\popovers.png')}}" alt="Card image cap"
								data-toggle="popover" data-placement="top"
								data-content="Pada halaman ini, ditampilkan detail profile dari pemilik akun. Pada halaman ini pula, pengguna dapat mengubah kata sandi dan detail informasi akunnya." />
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

		<div class="content-body">
			{{-- @role('mentor')
			<div class="card-body">
				<div class="nav-vertical">
					<ul class="nav nav-tabs nav-left flex-column" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="baseVerticalLeft-tab1" data-toggle="tab"
								aria-controls="tabVerticalLeft1" href="#tabVerticalLeft1" role="tab"
								aria-selected="true">Category</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="baseVerticalLeft-tab2" data-toggle="tab"
								aria-controls="tabVerticalLeft2" href="#tabVerticalLeft2" role="tab"
								aria-selected="false">Expertise</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="baseVerticalLeft-tab3" data-toggle="tab"
								aria-controls="tabVerticalLeft3" href="#tabVerticalLeft3" role="tab"
								aria-selected="false">Education</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="baseVerticalLeft-tab4" data-toggle="tab"
								aria-controls="tabVerticalLeft4" href="#tabVerticalLeft4" role="tab"
								aria-selected="false">Employment</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="baseVerticalLeft-tab5" data-toggle="tab"
								aria-controls="tabVerticalLeft5" href="#tabVerticalLeft5" role="tab"
								aria-selected="false">languages</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="baseVerticalLeft-tab6" data-toggle="tab"
								aria-controls="tabVerticalLeft6" href="#tabVerticalLeft6" role="tab"
								aria-selected="false">Overview</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="baseVerticalLeft-tab7" data-toggle="tab"
								aria-controls="tabVerticalLeft7" href="#tabVerticalLeft7" role="tab"
								aria-selected="false">Address</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tabVerticalLeft1" role="tabpanel"
							aria-labelledby="baseVerticalLeft-tab1">
							<div class="card">
								<div class="card-body">
									<h3>Tell us about the work you do!</h3>
									<br>
									<h5>Select Category</h5>
									<div class="form-group">
										<label class="form-label" for="register-username">Others</label>
										<input class="form-control" id="" type="text" name=""
											placeholder="Type category that match on you ..." aria-describedby=""
											value="" autocomplete="" autofocus tabindex="1" />
									</div>

									<h5>Select Sub Category</h5>
									<div class="form-group">
										<select class="form-select form-control" aria-label="Default select example">
											<option selected disabled>Open this select menu</option>
											<option value="1">Sub One</option>
											<option value="2">Sub Two</option>
											<option value="3">Sub Three</option>
										</select>
									</div>
									<div class="text-left ">
										<a class="card-text" href="#"><small class="text-muted">Skip this
												step</small></a>
									</div>

									<div class="text-right">
										<button class="btn btn-primary ">Next: Expertise</button>
										<button class="btn btn-outline-dark">Review & Save</button>
									</div>

								</div>
							</div>
						</div>
						<div class="tab-pane" id="tabVerticalLeft2" role="tabpanel"
							aria-labelledby="baseVerticalLeft-tab2">
							<div class="card">
								<div class="card-body">
									<h3>What is your skill?</h3>
									<br>
									<h5>Select skill</h5>
									<div class="form-group">
										<select id="state" class="livesearch-plans form-control " name="#"
											placeholder="Type skill that match on you ..." multiple></select>
										@error('')
										<strong class="text-danger">{{ $message }}</strong>
										@enderror
									</div>
									<div class="text-left ">
										<a class="card-text" href="#"><small class="text-muted">Skip this
												step</small></a>
									</div>

									<div class="text-right">
										<button class="btn btn-primary ">Next: Expertise</button>
										<button class="btn btn-outline-dark">Review & Save</button>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tabVerticalLeft3" role="tabpanel"
							aria-labelledby="baseVerticalLeft-tab3">
							<div class="card">
								<div class="card-body">
									<h3>Add the schools you attended, areas of study, and degrees earned!</h3>
									<br>
									<h5>School</h5>
									<div class="form-group">
										<input class="form-control" id="" type="text" name=""
											placeholder="ex. Oxford University" aria-describedby="" value=""
											autocomplete="" autofocus tabindex="1" />
									</div>
									<h5>Field of study</h5>
									<div class="form-group">
										<input class="form-control" id="" type="text" name=""
											placeholder="ex. Information System" aria-describedby="" value=""
											autocomplete="" autofocus tabindex="1" />
									</div>
									<h5>Degree</h5>
									<div class="form-group">
										<input class="form-control" id="" type="text" name=""
											placeholder="ex. Bachelor Degree" aria-describedby="" value=""
											autocomplete="" autofocus tabindex="1" />
									</div>
									<div class="row">
										<div class="col-6">
											<h5>Start Year</h5>
											<div class="input-append date form-control" id="datepicker" data-date="2012"
												data-date-format="yyyy">

												<input type="text" name="date">
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="tab-pane" id="tabVerticalLeft4" role="tabpanel"
							aria-labelledby="baseVerticalLeft-tab4">
							<div class="card">
								<div class="card-body">
									<p>
										Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry cotton candy
										oat cake fruitcake
										jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy. Cookie
										powder marshmallow donut.
										Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o pie cupcake.
									</p>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tabVerticalLeft5" role="tabpanel"
							aria-labelledby="baseVerticalLeft-tab5">
							<div class="card">
								<div class="card-body">
									<p>
										Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry cotton candy
										oat cake fruitcake
										jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy. Cookie
										powder marshmallow donut.
										Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o pie cupcake.
									</p>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tabVerticalLeft6" role="tabpanel"
							aria-labelledby="baseVerticalLeft-tab6">
							<div class="card">
								<div class="card-body">
									<p>
										Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry cotton candy
										oat cake fruitcake
										jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy. Cookie
										powder marshmallow donut.
										Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o pie cupcake.
									</p>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tabVerticalLeft7" role="tabpanel"
							aria-labelledby="baseVerticalLeft-tab7">
							<div class="card">
								<div class="card-body">
									<p>
										Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry cotton candy
										oat cake fruitcake
										jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy. Cookie
										powder marshmallow donut.
										Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o pie cupcake.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endrole --}}




			<div id="user-profile">
				<!-- profile header -->
				<div class="row">
					<div class="col-sm-12 ">
						<div class="card profile-header mb-2 position-relative ">

							<!-- profile cover photo -->
							@if ($user->background_picture == 'background_default.jpg')
							<img class="card-img-top" style="height: 569px;"
								src="{{ asset('assets/images/avatars/'.$user->background_picture) }}"
								alt="User Profile Image" />
							@else
							<img class="card-img-top" style="height: 569px;" src="{{ $contents_bg }}"
								alt="User Profile Image" />
							@endif
							<!--/ profile cover photo -->

							<div class="position-relative">
								<!-- profile picture -->
								<div class="profile-img-container d-flex align-items-center">
									<div class="profile-img">
										@if ($user->profil_picture == 'cataliz.jpg')
										<img src="{{ asset('assets/images/avatars/'.$user->profil_picture) }}"
											class="rounded img-fluid" alt="Card image" id="profil" />
										@else
										<img src="{{ $contents }}" class="rounded img-fluid" alt="Card image"
											id="profil"
											style="width: 115px; height: 115px; background-position: center;" />
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
								<nav
									class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100 position-relative">
									<button class="btn btn-icon navbar-toggler" type="button" data-toggle="collapse"
										data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
										aria-expanded="false" aria-label="Toggle navigation">
										<i data-feather="align-justify" class="font-medium-5"></i>
									</button>

									<!-- collapse  -->
									<div class="collapse navbar-collapse" id="navbarSupportedContent">
										<div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
											<ul class="nav nav-tabs" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" id="home-tab" data-toggle="tab"
														href="#home" aria-controls="home" role="tab"
														aria-selected="true">Home</a>
												</li>
												@role('coachee')
												<li class="nav-item">
													<a class="nav-link " id="profile-tab" data-toggle="tab"
														href="#feedback" aria-controls="feedback" role="tab"
														aria-selected="true">Feedback</a>
												</li>
												@endrole
											</ul>
										</div>

										<!-- edit button -->
										<div class="position-relative">
											<button type="button" class="btn btn-primary" data-toggle="modal"
												data-target="#modals_profil" aria-expanded="false" id="edit_profil">
												Edit
											</button>
										</div>

										<!-- Modal Profil Picture-->
										<div class="modal fade" id="modal_edit_profil" tabindex="-1"
											aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Update Foto
															Profil</h5>
														<button type="button" class="close" data-dismiss="modal"
															aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form action="{{route('update_profil', Auth::user()->id)}}"
														method="POST" enctype="multipart/form-data"
														id="formProfilePicture">
														<div class="modal-body">
															@csrf
															<input type="file" name="profil_picture" id="profil_picture"
																class="profil_picture">
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary"
																id="saveProfilePictureBtn">Simpan</button>
															<button type="button" class="btn btn-secondary"
																data-dismiss="modal">Batal</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										<!--/ Modal Profil Picture-->

										<!-- Modal Background picture -->
										<div class="modal fade" id="modal_edit_background" tabindex="-1"
											aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Update Background
														</h5>
														<button type="button" class="close" data-dismiss="modal"
															aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form action="{{route('update_background', Auth::user()->id)}}"
															method="POST" enctype="multipart/form-data"
															id="formBackgroundPicture">
															@csrf
															<input type="file" name="background_picture"
																id="background_picture">
															<div id="background_picture-error"></div>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary"
															id="saveBackgroundPictureBtn">Simpan</button>
														</form>
														<button type="button" class="btn btn-secondary"
															data-dismiss="modal">Batal</button>
													</div>
												</div>
											</div>
										</div>
										<!--/ Modal Background picture -->

										<!-- modal edit profile-->
										<div class="modal fade" id="modals_profil" tabindex="-1" role="dialog"
											aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"
															aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<div class="container">
															<div class="col-auto ">
																<div class="card">
																	<img class=" width=" 120px" height="120px"" src="
																		{{asset('assets\images\icons\profile\profile.png')}}"
																		alt="Card image cap" />
																	<button type="button" class="btn btn-primary"
																		aria-haspopup="true" id="btn_edit_profil"
																		aria-expanded="false" data-toggle="modal"
																		data-target="#modals-slide-in">
																		Edit Profile
																	</button>
																</div>
															</div>
															<div class="col-auto">
																<div class="card">
																	<img class="width=" 120px" height="120px"" src="
																		{{asset('assets\images\icons\profile\picture.png')}}"
																		alt="Card image cap" />
																	<button type="button" class="btn btn-primary"
																		aria-haspopup="true" id="btn_edit_picture"
																		aria-expanded="false" data-toggle="modal"
																		data-target="#modal_edit_profil">
																		Edit Picture
																	</button>
																</div>
															</div>
															<div class="col-auto">
																<div class="card">
																	<img class="width=" 120px" height="120px"" src="
																		{{asset('assets\images\icons\profile\cover.png')}}"
																		alt="Card image cap" />
																	<button type="button" class="btn btn-primary"
																		aria-haspopup="true" id="btn_edit_background"
																		aria-expanded="false" data-toggle="modal"
																		data-target="#modal_edit_background">
																		Edit Cover
																	</button>
																</div>
															</div>
															@role('mentor')
															<div class="col-auto">
																<div class="card">
																	<img class="width=" 120px" height="120px"" src="
																		{{asset('assets\images\icons\profile\cover.png')}}"
																		alt="Card image cap" />
																	<a href="{{route('profil.detail', Auth::user()->id)}}"
																		class="btn btn-primary"
																		id="btn_edit_background">Full Profile</a>
																</div>
															</div>
															@endrole
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
												<form class="add-new-record modal-content pt-0"
													id="formEditProfileCoachee" name="formEditProfileCoachee"
													method="POST" action="{{route('store_data', Auth::user()->id)}}">
													@csrf
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">×</button>
													<div class="modal-header mb-1">
														<h5 class="modal-title" id="modalHeading"></h5>
													</div>
													<input type="hidden" name="Client_id" id="Client_id">
													<div class="modal-body flex-grow-1">
														<div class="form-group">
															<label class="form-label"
																for="basic-icon-default-fullname">Full
																Name</label>
															<input id="name" name="name" type="text"
																class="form-control dt-full-name"
																id="basic-icon-default-fullname"
																value="{{$user->name}}" />
															<div id="name-error"></div>
														</div>
														<label class="form-label"
															for="basic-icon-default-post">Phone</label>
														<div class="form-group">
															<div class="input-group input-group-merge">
																<div class="input-group-prepend">
																	<span class="input-group-text"
																		id="basic-addon5">+62</span>
																</div>
																<input id="phone" name="phone" type="text"
																	class="form-control" value="{{$user->phone}}">
															</div>
															<div id="phone-error"></div>
														</div>
														<div class="form-group">
															<label class="form-label"
																for="basic-icon-default-email">Email</label>
															<input id="email" name="email" type="text"
																id="basic-icon-default-email"
																class="form-control dt-email" value="{{$user->email}}"
																readonly />
															<small class="form-text text-muted"> You can use letters,
																numbers & periods </small>
														</div>
														<div class="form-group">
															<label class="form-label"
																for="basic-icon-default-fullname">Organization</label>
															<input id="organization" name="organization" type="text"
																class="form-control dt-full-name"
																id="basic-icon-default-fullname"
																value="{{$user->organization}}" readonly />
														</div>
														<div class="form-group">
															<label class="form-label"
																for="basic-icon-default-fullname">Company</label>
															<input id="company" name="company" type="text"
																class="form-control dt-full-name"
																id="basic-icon-default-fullname"
																value="{{$user->company}}" readonly />
														</div>
														<div class="form-group">
															<label class="form-label"
																for="basic-icon-default-fullname">Occupation</label>
															<input id="occupation" name="occupation" type="text"
																class="form-control dt-full-name"
																id="basic-icon-default-fullname"
																value="{{$user->occupation}}" readonly />
														</div>
														<button type="submit" class="btn btn-primary data-submit mr-1"
															id="saveProfileCoacheeBtn">Submit</button>
														<button type="reset" class="btn btn-outline-secondary"
															data-dismiss="modal">Cancel</button>
													</div>
												</form>
											</div>
										</div>
										@else
										<div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
											<div class="modal-dialog sidebar-sm">
												<form class="add-new-record modal-content pt-0" id="ClientForm"
													name="ClientForm" method="POST"
													action="{{route('store_data', Auth::user()->id)}}">
													@csrf
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">×</button>
													<div class="modal-header mb-1">
														<h5 class="modal-title" id="modalHeading"></h5>
													</div>
													<input type="hidden" name="Client_id" id="Client_id">
													<div class="modal-body flex-grow-1">
														<div class="form-group">
															<label class="form-label"
																for="basic-icon-default-fullname">Full
																Name</label>
															<input id="name" name="name" type="text"
																class="form-control dt-full-name"
																id="basic-icon-default-fullname"
																value="{{$user->name}}" />
															<div id="name-error"></div>
														</div>
														<div class="form-group">
															<label class="form-label"
																for="basic-icon-default-post">Phone</label>
															<div class="input-group input-group-merge">
																<div class="input-group-prepend">
																	<span class="input-group-text"
																		id="basic-addon5">+62</span>
																</div>
																<input id="phone" name="phone" type="text"
																	class="form-control" value="{{$user->phone}}">
															</div>
															<div id="phone-error"></div>
														</div>
														<div class="form-group">
															<label class="form-label"
																for="basic-icon-default-email">Email</label>
															<input id="email" name="email" type="text"
																id="basic-icon-default-email"
																class="form-control dt-email" value="{{$user->email}}"
																readonly />
															<small class="form-text text-muted"> You can use letters,
																numbers & periods </small>
														</div>
														<button type="submit" class="btn btn-primary data-submit mr-1"
															id="saveBtn1" value="create">Submit</button>
														<button type="reset" class="btn btn-outline-secondary"
															data-dismiss="modal">Cancel</button>
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
														<img class="text-align width=" 15" height="15"" src="
															{{asset('assets\images\icons\popovers.png')}}"
															alt="Card image cap" data-toggle="popover"
															data-placement="top"
															data-content="Pada bagian ini, Anda dapat melakukan perubahan kata sandi akun Anda. Kata sandi baru sebaiknya berbeda dari kata sandi sebelumnya." />
													</h4>
												</div>


												<div class="col-md-12 form-group">
													<label for="fp-default">Old password</label>
													<input
														class="form-control @error('old_password') is-invalid @enderror"
														type="password" name="old_password"
														placeholder="Type old password here...">
													@error('old_password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>

												<div class="col-md-12 form-group">
													<label for="fp-default">New Password</label>
													<input
														class="form-control @error('new_password') is-invalid @enderror"
														type="password" name="new_password"
														placeholder="Type new password here...">
													@error('new_password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>

												<div class="col-md-12 form-group">
													<label for="fp-default">Confirm New Password</label>
													<input
														class="form-control @error('new_confirm_password') is-invalid @enderror"
														type="password" name="new_confirm_password"
														placeholder="New password confirmation">
													@error('new_confirm_password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>

												<div class="col-md-12 form-group">
													<button type="submit" class="btn btn-primary data-submit mr-1"
														id="saveBtn" value="create">Save Change</button>
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
										<img class="rounded float-right width=" 15" height="15"" src="
											{{asset('assets\images\icons\popovers.png')}}" alt="Card image cap"
											data-toggle="popover" data-placement="top"
											data-content="Halaman ini menampilkan daftar feedbacks dari session yang telah diikuti oleh client yang dipilih." />
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
					<div class="modal fade" id="show_feedback" tabindex="-1" role="dialog"
						aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
			</div>
		</div>
	</div>

	<!-- END: Content-->
	@endsection

	@push('scripts')
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	<script src="{{ asset('assets/js/jquery.imgareaselect.min.js') }}"></script>
	<script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>


	<script type="text/javascript">
		$(function() {
			// jQuery(function($) {
			// 	var p = $("#previewimage");

			// 	$(document).on("change", ".pp", function() {
			// 		console.log('ok');
			// 		var imageReader = new FileReader();
			// 		imageReader.readAsDataURL(document.querySelector(".pp").files[0]);

			// 		imageReader.onload = function(oFREvent) {
			// 			p.attr('src', oFREvent.target.result).fadeIn();
			// 		};
			// 	});

			// 	$('#previewimage').imgAreaSelect({
			// 		onSelectEnd: function(img, selection) {
			// 			$('input[name="x1"]').val(selection.x1);
			// 			$('input[name="y1"]').val(selection.y1);
			// 			$('input[name="w"]').val(selection.width);
			// 			$('input[name="h"]').val(selection.height);
			// 		}
			// 	});
			// });

			$('.profil_picture').ijaboCropTool({
				preview: '#profil',
				processUrl: '{{route("update_profil",Auth::user()->id)}}',
				withCSRF: ['_token','{{csrf_token()}}'],
				onSuccess:function(message, element, status){
             		alert(message);
					$('#modal_edit_profil').modal('hide');
          		},
          		onError:function(message, element, status){
            		alert(message);
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
						data: 'name',
						name: 'name',
						defaultContent: '<i>-</i>'
					},
					{
						data: 'session_name',
						name: 'session_name',
						defaultContent: '<i>-</i>'
					},
					{
						data: 'topic',
						name: 'topic',
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
					$('#name').text(data.name);
					$('.session_feedback').html(data.session_name);
					$('.coach_name_feedback').html(data.name);
					$('.topic_feedback').html(data.topic);
					$('.feedback').html(data.feedback_from_coach);
					$('#show_feedback').modal('show');
					if (data.attachment_from_coach == null) {
						$('.download_button_feedback').css("display", "none");
						$('.span_none_feedback').html('Tidak ada file');
					} else {
						$('.span_none_feedback').html(data.attachment_from_coach);
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
		$('#datepicker').datepicker({
			minViewMode: 'years',
			autoclose: true,
			format: 'yyyy'
		});
		// modal edit
		$('body').on('click', '#edit_profil', function() {
			console.log('edit');
		});
	</script>
	@endpush