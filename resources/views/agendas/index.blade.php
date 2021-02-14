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
						<h2 class="content-header-title float-left mb-0">Agendas</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Agendas</a>
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
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">×</span></button>
			</div>
			@endif

			<div class="row mb-1 no-gutters">
				<div class="col-md-12">
					@can('create-agendas')
					<a href="{{ url('/agendas/create') }}" class="create-new btn btn-primary">Add New</a>
					@endcan
				</div>
			</div>

			<!-- Basic table -->
			<section id="basic-datatable">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<table class="datatables-basic table yajra-datatable">
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
	</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script type="text/javascript">
	$(function () {


	var table = $('.yajra-datatable').DataTable({
		processing: true,
		serverSide: true,
		ajax: "",
		columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'name', name: 'name'},
			{data: 'session_name', name: 'session_name'},
			{data: 'date', name: 'date', defaultContent: '<i>-</i>'},
			{data: 'duration', name: 'duration', defaultContent: '<i>-</i>'},
			{
				data: 'status',
				name: 'status'
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

	$('body').on('click', '.deleteAgenda', function (e) {

		var agenda_id = $(this).data("id");
		console.log(agenda_id);
		if(confirm("Are You sure want to delete !")){

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type: "DELETE",
				url: ""+'/agendas/'+agenda_id,
				success: function (data) {
					table.draw();
					$(".alert-danger").css("display", "block");
					$(".alert-danger").append("<P>Data berhasil dihapus!");
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		} else {
			e.preventDefault();
		}
	});
});
</script>
@endpush
