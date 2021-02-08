@extends('layouts.layoutVerticalMenu')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-profile.css') }}">
@endpush

@section('title','Client')

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
								<li class="breadcrumb-item active">Coach Name
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
					<div class="col-12">
						<div class="card profile-header mb-2">
							<!-- profile cover photo -->
							<img class="card-img-top" src="https://image.freepik.com/free-photo/cyborg-hand-holding-bulb-lamp-idea-concept-with-start-up-icon-connected-3d-rendering_110893-1792.jpg" alt="User Profile Image" />
							<!--/ profile cover photo -->

							<div class="position-relative">
								<!-- profile picture -->
								<div class="profile-img-container d-flex align-items-center">
									<div class="profile-img">
										<img src="{{asset('assets/images/avatars/cataliz.jpg') }}" class="rounded img-fluid" alt="Card image" />
									</div>
									<!-- profile title -->
									<div class="profile-title ml-3">
										<h2 class="text-white">#coachName</h2>
										<p class="text-white">Coach occupation coach company</p>
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
											<p class="card-text">coach created_at</p>

											<div class="mt-2">
												<h5 class="mb-75">Phone:</h5>
												<p class="card-text">coach phone</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-75">Email:</h5>
												<p class="card-text">coach email</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-75">Company:</h5>
												<p class="card-text">coach company</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-50">Occupation:</h5>
												<p class="card-text mb-0">coach occupation</p>
											</div>
                    </div>
									</div>
									<!--/ about -->
								</div>
								<!--/ left profile info section -->

								<!-- center profile info section -->

								<div class="col-lg-8 col-`4` order-1 order-lg-2">
                  <form action="#" method="">
                    @csrf
									<div class="row match-height">
                     <div class="col-sm-12 col-md-6">
            					<div class="card">
            						<div class="card-header">
            							<h4 class="card-title">Change Password</h4>
            						</div>
                        <div class="col-md-6 form-group">
                          <label for="fp-default">Old password</label>
                          <input class="form-control" value="#">
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="fp-default">New Password</label>
                          <input class="form-control" value="#">
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="fp-default">Confirm New Password</label>
                          <input class="form-control" value="#">
                        </div>
                        <div class="col-md-6 form-group">
                        <button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn"
                          value="create">Save Change</button>
                          </div>
            						</div>
            					</div>
            				</div>
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

				//ajax declaration with csrf
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});

				//datatable for sessions table
				var table = $('.yajra-datatable-1').DataTable({
					processing: true,
					serverSide: true,
					ajax: "{{route('clients.show_agendas', $client->id)}}",
					columns: [
						{data: 'DT_RowIndex', name: 'DT_RowIndex'},
						{data: 'topic', name: 'topic', defaultContent: '<i>-</i>'},
						{data: 'session_name', name: 'session_name'},
						{data: 'date', name: 'date', defaultContent: '<i>-</i>'},
						{data: 'time', name: 'time', defaultContent: '<i>-</i>'},
						{
							data: 'duration',
							name: 'duration'
						},
						{
							data: 'action',
							name: 'action',
							orderable: true,
							searchable: true
						},
					],
					dom:
			        '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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

				//datatable for plans table
				var table = $('.yajra-datatable-2').DataTable({
					processing: true,
					serverSide: true,
					ajax: "{{route('clients.show_plans', $client->id)}}",
					columns: [
						{data: 'DT_RowIndex', name: 'DT_RowIndex'},
						{data: 'objective', name: 'objective', defaultContent: '<i>-</i>'},
						{data: 'date', name: 'date'},
						{
							data: 'action',
							name: 'action',
							orderable: true,
							searchable: true
						},
					],
					dom:
			        '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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

				// edit
				$('.editClient').click(function () {
					var Client_id = $(this).data('id');
					$.get("" +'/clients/' + Client_id +'/edit', function (data) {
						$('#modalHeading').html("Edit Client");
						$('#saveBtn').val("edit-user");
						$('#modals-slide-in').modal('show');
						$('#Client_id').val(data.id);
						$('#name').val(data.name);
						$('#phone').val(data.phone);
						$('#email').val(data.email);
						$('#company').val(data.company);
						$('#organization').val(data.organization);
						$('#occupation').val(data.occupation);
					})
				});
			});
			</script>
			@endpush
