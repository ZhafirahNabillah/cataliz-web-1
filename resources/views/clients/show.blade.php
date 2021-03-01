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
						<h2 class="content-header-title float-left mb-0">Profile
							<img class="rounded float-right width=" 15" height="15"" src="
								{{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
								data-placement="top" data-content="Halaman ini menampilkan detail profile dari client yang dipilih" />
						</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/">Home</a>
								</li>
								<li class="breadcrumb-item"><a href="{{route('clients.index')}}">Client</a>
								</li>
								<li class="breadcrumb-item active">{{$client->name}}
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
							<img class="card-img-top"
								src="https://image.freepik.com/free-photo/cyborg-hand-holding-bulb-lamp-idea-concept-with-start-up-icon-connected-3d-rendering_110893-1792.jpg"
								alt="User Profile Image" />
							<!--/ profile cover photo -->

							<div class="position-relative">
								<!-- profile picture -->
								<div class="profile-img-container d-flex align-items-center">
									<div class="profile-img">
										<img src="{{asset('assets/images/avatars/cataliz.jpg') }}" class="rounded img-fluid"
											alt="Card image" />
									</div>
									<!-- profile title -->
									<div class="profile-title ml-3">
										<h2 class="text-white client_name">{{$client->name}}</h2>
										<p class="text-white">{{$client->occupation}} {{$client->company}}</p>
									</div>
								</div>
							</div>

							<!-- tabs pill -->
							<div class="profile-header-nav">
								<!-- navbar -->
								<nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
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
												<li class="nav-item">
													<a class="nav-link" id="profile-tab" data-toggle="tab" href="#session" aria-controls="profile"
														role="tab" aria-selected="false">Sessions</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachingPlan"
														aria-controls="profile" role="tab" aria-selected="false">Coaching Plans</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachingNotes"
														aria-controls="profile" role="tab" aria-selected="false">Coaching Notes</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab" data-toggle="tab" href="#feedback"
														aria-controls="profile" role="tab" aria-selected="false">Feedbacks</a>
												</li>

											</ul>

											{{-- <!-- edit button -->
											<button type="button" href="javascript:;" class="btn btn-primary editClient"
												data-id="{{$client->id}}">
											Edit
											</button> --}}
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
											<p class="card-text">{{\Carbon\Carbon::parse($client->created_at)->format('F d, Y')}}</p>

											<div class="mt-2">
												<h5 class="mb-75">Phone:</h5>
												<p class="card-text">+62{{$client->phone}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-75">Email:</h5>
												<p class="card-text">{{$client->email}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-75">Organization:</h5>
												<p class="card-text">{{$client->organization}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-75">Company:</h5>
												<p class="card-text">{{$client->company}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-50">Occupation:</h5>
												<p class="card-text mb-0">{{$client->occupation}}</p>
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

												<div class=" card-header">
												<div>
													<img class=" rounded float-left" width="15px" height="15px"
														src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap"
														data-toggle="popover" data-placement="top"
														data-content="Bagian ini menampilkan banyaknya sesi yang dimiliki oleh client yang dipilih." />
												</div>
												<div class="card-body flex-column align-items-start pb-0">
													<img class="rounded float-right width=" 60" height="60"" src="
														{{asset('assets\images\icons\Group 149.png') }}" alt="Card image cap" />
												</div>

											</div>
											<div class="card-body">
												<h1 class="display-1 text-primary card text-center">{{$total_agenda->count}}</h1>
												<h3 class="font-weight-bolder text-center">Number of Coaching</h3>
											</div>
										</div>
									</div>
									<!-- Number of Coaching ends -->

									<!-- Number of Agenda -->
									<div class="col-lg-4 col-sm-4 col-6">
										<div class="card style=" width: 18rem;" style="border-radius: 11px"">
									<div class=" card-header mb-0">
											<div>
												<img class=" rounded float-left" width="15px" height="15px"
													src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap"
													data-toggle="popover" data-placement="top"
													data-content="Bagian ini menampilkan banyaknya agenda yang dimiliki oleh client yang dipilih." />
											</div>
											<div class="card-body flex-column align-items-start pb-0">
												<img class="rounded float-right width=" 55" height="55"" src="
													{{asset('assets\images\icons\Group 141.jpg') }}" alt="Card image cap" />
											</div>
										</div>
										<div class="card-body">
											<h1 class="display-1 text-primary card text-center">{{$total_session->sum}}</h1>
											<h3 class="font-weight-bolder text-center">Agenda</h3>
										</div>
									</div>
								</div>
								<!-- Number of Agenda End -->


								<!-- Number of Event -->
								<div class="col-lg-4 col-sm-4 col-6">
									<div class="card style=" width: 18rem;" style="border-radius: 11px"">
										<div class=" card-header">
										<div>
											<img class=" rounded float-left" width="15px" height="15px"
												src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
												data-placement="top"
												data-content="Bagian ini menampilkan banyaknya sesi dengan status scheduled yang dimiliki oleh client yang dipilih." />
										</div>
										<div class="card-body flex-column align-items-start pb-0">
											<img class="rounded float-right width=" 60" height="60"" src="
												{{asset('assets\images\icons\Group 142.jpg') }}" alt="Card image cap" />
										</div>
									</div>
									<div class="card-body">
										<h1 class="display-1 text-primary card text-center">{{$total_event}}</h1>
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
										<img class="align-text width=" 15px" height="15px"" src="
											{{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
											data-placement="top"
											data-content="Bgaian ini menampilkan sesi dengan status scheduled yang dijadwalkan terlaksana dalam waktu dekat" />
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
										<img class="align-text width=" 15px" height="15px"" src="
											{{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
											data-placement="top"
											data-content="Bagian ini menampilkan daftar seluruh sesi yang dimiliki oleh client yang dipilih." />
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
								<img class="align-text width=" 15" height="15"" src=" {{asset('assets\images\icons\popovers.png')}}"
									alt="Card image cap" data-toggle="popover" data-placement="top"
									data-content="Halaman ini menampilkan detail profile dari client yang dipilih" />
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
								<img class="align-text width=" 15" height="15"" src=" {{asset('assets\images\icons\popovers.png')}}"
									alt="Card image cap" data-toggle="popover" data-placement="top"
									data-content="Halaman ini menampilkan daftar coaching plans yang dimiliki oleh client yang dipilih." />
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
								<img class="align-text width=" 15" height="15"" src=" {{asset('assets\images\icons\popovers.png')}}"
									alt="Card image cap" data-toggle="popover" data-placement="top"
									data-content="Halaman ini menampilkan daftar coaching notes berdasarkan session  yang dimiliki oleh client yang dipilih." />
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
			<div class="modal fade" id="show_note" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
				aria-hidden="true">
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
			<!-- /tab coaching Notes-->
		</div>


		<!-- Tab Feedback -->
		<div class="tab-pane" id="feedback" aria-labelledby="about-tab" role="tabpanel">
			<div class="content-header row">
				<div class="content-header-left col-md-9 col-12 mb-2">
					<div class="row breadcrumbs-top">
						<div class="col-12">
							<h4 class="breadcrumb-item active tes">Feedback
								<img class="rounded float-right width=" 15" height="15"" src="
									{{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
									data-placement="top"
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
			<div class="modal fade" id="show_feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
				aria-hidden="true">
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
	</div>
	<!---End Content Body -->

	<!-- Modal to add new record -->
	<div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
		<div class="modal-dialog sidebar-sm">
			<form class="add-new-record modal-content pt-0" id="ClientForm" name="ClientForm">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
				<div class="modal-header mb-1">
					<h5 class="modal-title" id="modalHeading"></h5>
				</div>
				<input type="hidden" name="Client_id" id="Client_id">
				<div class="modal-body flex-grow-1">
					<div class="form-group">
						<label class="form-label" for="basic-icon-default-fullname">Full Name</label>
						<input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname"
							placeholder="John Doe" aria-label="John Doe" />
					</div>
					<label class="form-label" for="basic-icon-default-post">Phone</label>
					<div class="input-group input-group-merge mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon5">+62</span>
						</div>
						<input id="phone" name="phone" type="text" class="form-control" placeholder="81xxxxxxx" aria-label="Phone">
					</div>
					<div class="form-group">
						<label class="form-label" for="basic-icon-default-email">Email</label>
						<input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email"
							placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
						<small class="form-text text-muted"> You can use letters, numbers & periods </small>
					</div>
					<div class="form-group">
						<label class="form-label" for="basic-icon-default-fullname">Organization</label>
						<input id="organization" name="organization" type="text" class="form-control dt-full-name"
							id="basic-icon-default-fullname" placeholder="Inbis Sample" aria-label="John Doe" />
					</div>
					<div class="form-group">
						<label class="form-label" for="basic-icon-default-fullname">Company</label>
						<input id="company" name="company" type="text" class="form-control dt-full-name"
							id="basic-icon-default-fullname" placeholder="Startup Name" aria-label="John Doe" />
					</div>
					<div class="form-group">
						<label class="form-label" for="basic-icon-default-fullname">Occupation</label>
						<input id="occupation" name="occupation" type="text" class="form-control dt-full-name"
							id="basic-icon-default-fullname" placeholder="CEO" aria-label="John Doe" />
					</div>

					<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">Submit</button>
					<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
				</div>

				<!-- </form>-->
		</div>
	</div>
	<!-- End Modal -->

</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script type="text/javascript">
	$(function() {

		//ajax declaration with csrf
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		// datatable for upcoming table
		var table = $('.yajra-datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "",
			columns: [{
					data: 'DT_RowIndex',
					name: 'DT_RowIndex'
				},
				{
					data: 'name',
					name: 'name'
				},
				{
					data: 'date',
					name: 'date',
					defaultContent: '<i>-</i>'
				},
				{
					data: 'time',
					name: 'time',
					defaultContent: '<i>-</i>'
				},
				{
					data: 'session_name',
					name: 'session_name',
					defaultContent: '<i>-</i>'
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

		// datatable for event table
		var table = $('.yajra-datatable1').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{route('clients.show_agendas_list', $client->id)}}",
			columns: [{
					data: 'DT_RowIndex',
					name: 'DT_RowIndex'
				},
				{
					data: 'name',
					name: 'name'
				},
				{
					data: 'date',
					name: 'date',
					defaultContent: '<i>-</i>'
				},
				{
					data: 'time',
					name: 'time',
					defaultContent: '<i>-</i>'
				},
				{
					data: 'duration',
					name: 'duration',
					defaultContent: '<i>-</i>'
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

		//datatable for sessions table
		var table = $('.yajra-datatable-1').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{route('clients.show_sessions', $client->id)}}",
			columns: [{
					data: 'DT_RowIndex',
					name: 'DT_RowIndex'
				},
				{
					data: 'topic',
					name: 'topic',
					defaultContent: '<i>-</i>'
				},
				{
					data: 'session_name',
					name: 'session_name'
				},
				{
					data: 'date',
					name: 'date',
					defaultContent: '<i>-</i>'
				},
				{
					data: 'time',
					name: 'time',
					defaultContent: '<i>-</i>'
				},
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

		//datatable for plans table
		var table = $('.yajra-datatable-2').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{route('clients.show_plans', $client->id)}}",
			columns: [{
					data: 'DT_RowIndex',
					name: 'DT_RowIndex'
				},
				{
					data: 'objective',
					name: 'objective',
					defaultContent: '<i>-</i>'
				},
				{
					data: 'date',
					name: 'date'
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

		//datatable for feedbacks table
		var table = $('.yajra-datatable-feedback').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{route('clients.show_feedbacks', $client->id)}}",
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

		//datatable for notes table
		var table = $('.yajra-datatable-notes').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{route('clients.show_notes', $client->id)}}",
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
					data: 'subject',
					name: 'subject',
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
		// popover
		$(function() {
			$('[data-toggle="popover"]').popover()
		})

		// show coaching notes
		$(document).on("click", "#detailNote", function() {
			console.log('masuk');
			let detail_agenda_id_note = $(this).data('id');
			console.log(detail_agenda_id_note);

			$.get("" + '/clients/' + detail_agenda_id_note + '/show_detail_notes', function(data) {
				$('#modalHeading').html("Detail Notes");
				$('#name').text(data.name);
				$('.session_note').html(data.session_name);
				$('.coach_name_note').html(data.name);
				$('.topic_note').html(data.topic);
				$('.subject_note').html(data.subject);
				$('.note').html(data.summary);
				$('#show_note').modal('show');

				if (data.attachment == null) {
					$('.download_button_note').css("display", "none");
					$('.span_none_note').html('Tidak ada file');
				} else {
					$('.span_none_note').html('Unduh file di atas');
					$('.download_button_note').removeAttr('style');
					$('.download_button_note').css("display", "relative");
				}

				$('.download_button_note').on('click', function() {
					window.location.href = ("" + '/agendas/' + detail_agenda_id_note + '/note_download');
				});
			});
		})

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
					$('.span_none_feedback').html('Unduh file di atas');
					$('.download_button_feedback').removeAttr('style');
					$('.download_button_feedback').css("display", "relative");
				}

				$('.download_button_feedback').on('click', function() {
					window.location.href = ("" + '/agendas/' + detail_agenda_id + '/feedback_download');
				});

			});
		});

		// edit
		$('body').on('click', '.editClient', function() {
			var Client_id = $(this).data('id');
			$.get("" + '/clients/' + Client_id + '/edit', function(data) {
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


				// save data
				$('#saveBtn').click(function(e) {
					// e.preventDefault();
					$(this).html('Sending..');

					$.ajax({
						data: $('#ClientForm').serialize(),
						url: ("" + '/clients/' + Client_id + '/update'),
						type: "POST",
						dataType: 'json',
						success: function(data) {

							$('#ClientForm').trigger("reset");
							$('#saveBtn').html('Submit');
							// console.log(names);
							$('#modals-slide-in').modal('hide');
						},
						error: function(data) {
							console.log('Error:', data);
							$('#saveBtn').html('Submit');
						}
					})
				})

			})
		});
	});
</script>
@endpush