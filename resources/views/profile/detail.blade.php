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
                        </div>
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
                                                        placeholder="Type category that match on you ..."
                                                        aria-describedby="" value="" autocomplete="" autofocus
                                                        tabindex="1" />
                                                </div>

                                                <h5>Select Sub Category</h5>
                                                <div class="form-group">
                                                    <select class="form-select form-control"
                                                        aria-label="Default select example">
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
                                                        placeholder="Type skill that match on you ..."
                                                        multiple></select>
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
                                                <h3>Add the schools you attended, areas of study, and degrees earned!
                                                </h3>
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
                                                        placeholder="ex. Information System" aria-describedby=""
                                                        value="" autocomplete="" autofocus tabindex="1" />
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
                                                        <div class="input-append date form-control" id="datepicker"
                                                            data-date="2012" data-date-format="yyyy">

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
                                                    Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry
                                                    cotton candy
                                                    oat cake fruitcake
                                                    jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy.
                                                    Cookie
                                                    powder marshmallow donut.
                                                    Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o
                                                    pie cupcake.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabVerticalLeft5" role="tabpanel"
                                        aria-labelledby="baseVerticalLeft-tab5">
                                        <div class="card">
                                            <div class="card-body">
                                                <p>
                                                    Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry
                                                    cotton candy
                                                    oat cake fruitcake
                                                    jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy.
                                                    Cookie
                                                    powder marshmallow donut.
                                                    Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o
                                                    pie cupcake.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabVerticalLeft6" role="tabpanel"
                                        aria-labelledby="baseVerticalLeft-tab6">
                                        <div class="card">
                                            <div class="card-body">
                                                <p>
                                                    Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry
                                                    cotton candy
                                                    oat cake fruitcake
                                                    jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy.
                                                    Cookie
                                                    powder marshmallow donut.
                                                    Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o
                                                    pie cupcake.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabVerticalLeft7" role="tabpanel"
                                        aria-labelledby="baseVerticalLeft-tab7">
                                        <div class="card">
                                            <div class="card-body">
                                                <p>
                                                    Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry
                                                    cotton candy
                                                    oat cake fruitcake
                                                    jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy.
                                                    Cookie
                                                    powder marshmallow donut.
                                                    Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o
                                                    pie cupcake.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Content-->
    @endsection

    @push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>


    <script type="text/javascript">
        $(function() {
			
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