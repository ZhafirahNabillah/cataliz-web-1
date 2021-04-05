@extends('layouts.layoutVerticalMenu')

@section('title','Agenda')

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
						<h2 class="content-header-title float-left mb-0">Agendas
							<img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Pada bagian ini ditampilkan daftar seluruh agenda yang ada dalam sistem." />
						</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
								</li>
								<li class="breadcrumb-item active">Agendas
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<div class="alert alert-danger alert-dissmisable fade show p-1" style="display:none" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			@if ($message = Session::get('success'))
			<div class="alert alert-success alert-dissmisable">
				<h4 class="alert-heading">Success</h4>
				<div class="alert-body">{{ $message }}</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			@endif
			<section id="card-demo-example ">
				<div class="container">
					<div class="row match-height align-item-start">
						<div class="col">
							<div class="card">
								<div class="card-title" style="margin-top: 12px; margin-right: 12px;">
									<img class=" rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah sesi yang belum terjadwal" />
								</div>
								<div class="card-body" style="padding-top: 1px;margin-top: -25px;">
									<img class="img-fluid rounded float-center mx-auto d-block center width=" 120px" height="120px"" src=" {{ url('assets\images\icons\agenda\US.png') }}" alt="Card image cap" />
									<small class="card text-center  mb-1" style="word-spacing: 11em; margin-top: 5px;">
										Unscheduled Sessions
									</small>
								</div>
								<h2 class="font-weight-bolder text-center " style="font-size: 72px;margin-top: -40px;">
									{{ $total_unscheduled_sessions }}
								</h2>
							</div>
						</div>

						<div class="col">
							<div class="card">
								<div class="card-title" style="margin-top: 12px; margin-right: 12px;">
									<img class=" rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah sesi yang sudah terjadwal" />
								</div>
								<div class="card-body" style="padding-top: 1px;margin-top: -25px;">
									<img class="img-fluid rounded float-center mx-auto d-block center width=" 120px" height="120px"" src=" {{ url('assets\images\icons\agenda\SS.png') }}" alt="Card image cap" />
									<small class="card text-center  mb-1" style="word-spacing: 11em;margin-top: 1em;">
										Scheduled Sessions
									</small>
								</div>
								<h2 class="font-weight-bolder text-center" style="font-size: 72px;margin-top: -40px;">
									{{ $total_scheduled_sessions }}
								</h2>
							</div>
						</div>

						<div class="col">
							<div class="card">
								<div class="card-title" style="margin-top: 12px; margin-right: 12px;">
									<img class=" rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah sesi yang dijadwal ulang" />
								</div>
								<div class="card-body" style="padding-top: 1px;margin-top: -25px;">
									<img class="img-fluid rounded float-center mx-auto d-block center width=" 120px" height="120px"" src=" {{ url('assets\images\icons\agenda\RS.png') }}" alt="Card image cap" />
									<small class="card text-center  mb-1" style="word-spacing: 11em;margin-top: 1em;">
										Reschedule Sessions
									</small>
								</div>
								<h2 class="font-weight-bolder text-center" style="font-size: 72px;margin-top: -40px;">
									{{ $total_rescheduled_sessions }}
								</h2>
							</div>
						</div>

						<div class="col">
							<div class="card">
								<div class="card-title" style="margin-top: 12px; margin-right: 12px;">
									<img class=" rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah sesi yang dibatalkan" />
								</div>
								<div class="card-body" style="padding-top: 1px;margin-top: -25px;">
									<img class="img-fluid rounded float-center mx-auto d-block center width=" 120px" height="120px"" src=" {{ url('assets\images\icons\agenda\CS.png') }}" alt="Card image cap" />
									<small class="card text-center  mb-1" style="word-spacing: 11em;margin-top: 1em;">
										Canceled Sessions
									</small>
								</div>
								<h2 class="font-weight-bolder text-center" style="font-size: 72px;margin-top: -40px;">
									{{ $total_canceled_sessions }}
								</h2>
							</div>
						</div>

						<div class="col">
							<div class="card">
								<div class="card-title" style="margin-top: 12px; margin-right: 12px;">
									<img class=" rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah sesi yang sudah dilaksanakan" />
								</div>
								<div class="card-body" style="padding-top: 1px;margin-top: -25px;">
									<img class="img-fluid rounded float-center mx-auto d-block center width=" 120px" height="120px"" src=" {{ url('assets\images\icons\agenda\FS.png') }}" alt="Card image cap" />
									<small class="card text-center  mb-1" style="word-spacing: 11em; margin-top: 1em;">
										Finished Sessions
									</small>
								</div>
								<h2 class="font-weight-bolder text-center" style="font-size: 72px;margin-top: -40px;">
									{{ $total_finished_sessions }}
								</h2>
							</div>
						</div>
					</div>
				</div>
		</div>

		<div class="card">
			<div class="card-body">
				<ul class="nav nav-tabs justify-content-center" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="coach-tab" data-toggle="tab" href="#coach" aria-controls="coach" role="tab" aria-selected="true">Individual</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachee" aria-controls="profile" role="tab" aria-selected="false">Group</a>
					</li>
				</ul>

				<div class="tab-content">
					<!-- Panel Individu -->
					<div class="tab-pane active" id="coach" aria-labelledby="coach-tab" role="tabpanel">
						<div class="row mb-1 no-gutters">
							<div class="col-md-12">
								@can('create-agenda')
								<a href="{{ url('/agendas/create') }}" class="create-new btn btn-primary">Add New</a>
								@endcan
							</div>
						</div>
						<!-- Basic table -->
						<section id="basic-datatable">
							<div class="row">
								<div class="col-12">
									<div class="card">
										<table class="datatables-basic table-striped table sessions-datatable-individual">
											<thead>
												<tr>
													<th>No</th>
													<th>Name</th>
													<th>Session</th>
													<th>Date</th>
													<th>Duration</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</section>
						<!--/ Basic table -->
					</div>
					<!-- /panel individu -->


					<!-- Panel Grup -->
					<div class="tab-pane" id="coachee" aria-labelledby="coachee-tab" role="tabpanel">
						<div class="row mb-1 no-gutters">
							<div class="col-md-12">
								@can('create-agenda')
								<a href="{{ url('/agendas/create') }}" class="create-new btn btn-primary">Add New</a>
								@endcan
							</div>
						</div>
						<!-- Basic table -->
						<section id="basic-datatable">
							<div class="row">
								<div class="col-12">
									<div class="card">
										<table class="datatables-basic table-striped table sessions-datatable-group">
											<thead>
												<tr>
													<th>No</th>
													<th>Group ID</th>
													<th>Session</th>
													<th>Date</th>
													<th>Duration</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</section>
						<!--/ Basic table -->
					</div>
					<!-- /coachee list admin -->
				</div>
			</div>
		</div>
	</div>

	<!-- END: Content-->
	@endsection

	@push('scripts')
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
	<script type="text/javascript">
		// popover
		$(function() {
			$('[data-toggle="popover"]').popover({
				html: true,
				trigger: 'hover',
				placement: 'top',
				content: function() {
					return '<img src="' + $(this).data('img') + '" />';
				}
			})
		})

		$(function() {
			var table_sessions_individual = $('.sessions-datatable-individual').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('agendas.sessions_individual') }}",
				columns: [{
						data: 'DT_RowIndex',
						name: 'DT_RowIndex'
					},
					{
						data: 'name',
						name: 'name'
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
						data: 'duration',
						name: 'duration',
						defaultContent: '<i>-</i>'
					},
					{
						data: 'status_colored',
						name: 'status_colored'
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
					// render: '<i data-feather="search"></i>',
					// search: '<i data-feather="search"/>',
					searchPlaceholder: "Search records"
				}
			});

			var table_sessions_group = $('.sessions-datatable-group').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('agendas.sessions_group') }}",
				columns: [{
						data: 'DT_RowIndex',
						name: 'DT_RowIndex'
					},
					{
						data: 'group',
						name: 'group'
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
						data: 'duration',
						name: 'duration',
						defaultContent: '<i>-</i>'
					},
					{
						data: 'status_colored',
						name: 'status_colored'
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
					// render: '<i data-feather="search"></i>',
					// search: '<i data-feather="search"/>',
					searchPlaceholder: "Search records"
				}
			});

			$('body').on('click', '.deleteAgenda', function(e) {

				var agenda_id = $(this).data("id");
				console.log(agenda_id);

				Swal.fire({
					title: "Are you sure?",
					text: "You'll delete your agenda",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, Sure",
					cancelButtonText: "Cancel"
				}).then((result) => {
					if (result.isConfirmed) {

						$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});

						$.ajax({
							type: "DELETE",
							url: "" + '/agendas/' + agenda_id,
							success: function(data) {
								Swal.fire({
									icon: 'success',
									title: 'Delete Successfully!',
								});
								table_sessions_group.draw();
								table_sessions_individual.draw();
							},
							error: function(data) {
								console.log('Error:', data);
							}
						});
					}
				})
			});
		});
	</script>
	@endpush