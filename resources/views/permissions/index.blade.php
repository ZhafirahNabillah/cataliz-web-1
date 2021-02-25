@extends('layouts.layoutVerticalMenu')

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
						<h2 class="content-header-title float-left mb-0">Permission List
							<img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar permission yang dapat diakses di dalam website." />
						</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/">dashboard</a>
								</li>
								<li class="breadcrumb-item active">Permission
								</li>

							</ol>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="content-body">
			@if ($message = Session::get('success'))
			<div class="alert alert-success alert-dissmisable">
				<h4 class="alert-heading">Success</h4>
				<div class="alert-body">{{ $message }}</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			@endif
			<div class="row">

				<div class="col-12 mb-1">
					<a href="javascript:;" class="create-new btn btn-primary createNewPermission">Add New</a>
				</div>

			</div>
			<!-- Basic table -->
			<section id="basic-datatable">
				<div class="row">
					<div class="col-12">
						<div class="card style=" border-radius: 15px;>
							<table class="datatables-basic table yajra-datatable-permission">
								<thead>
									<tr>
										<th>No</th>
										<th>Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!-- Modal to add new record -->
				<div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
					<div class="modal-dialog sidebar-sm">
						<form class="add-new-record modal-content pt-0" id="PermissionForm" name="PermissionForm">

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
							<div class="modal-header mb-1">
								<h5 class="modal-title" id="modalHeading"></h5>
							</div>
							<input type="hidden" name="permission_id" id="permission_id">
							<div class="modal-body flex-grow-1">
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-fullname">Permission Name</label>
									<input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
								</div>
								<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">Submit</button>
								<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
							</div>
							<!-- </form>-->

					</div>
				</div>
				<!-- End Modal -->
			</section>
			<!--/ Basic table -->



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
		$('[data-toggle="popover"]').popover()
	})
	$(function() {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var table = $('.yajra-datatable-permission').DataTable({
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

		// create
		$('body').on('click', '.createNewPermission', function() {
			$('#saveBtn').val("create-Client");
			$('#permission_id').val('');
			$('#PermissionForm').trigger("reset");
			$('#modalHeading').html("Create New Permission");
			$('#modals-slide-in').modal('show');
		});

		// edit
		$('body').on('click', '#editPermission', function() {
			console.log('tes');
			var permission_id = $(this).data('id');
			$.get("" + '/permissions/' + permission_id + '/edit', function(data) {
				$('#modalHeading').html("Edit Permission");
				$('#saveBtn').val("edit-permission");
				$('#modals-slide-in').modal('show');
				$('#permission_id').val(data.id);
				$('#name').val(data.name);
			})
		});

		// save data
		$('#saveBtn').click(function(e) {
			e.preventDefault();
			$(this).html('Sending..');
			var data = $('#PermissionForm').serialize();
			console.log(data);

			$.ajax({
				data: data,
				url: "",
				type: "POST",
				dataType: 'json',
				success: function(data) {

					$('#PermissionForm').trigger("reset");
					$('#saveBtn').html('Submit');
					$('#modals-slide-in').modal('hide');
					table.draw();

				},
				error: function(data) {
					console.log('Error:', data);
					$('#saveBtn').html('Submit');
				}
			});
		});

		// delete
		$('body').on('click', '#deletePermission', function(e) {

			var permission_id = $(this).data("id");
			console.log(permission_id);

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
						url: "" + '/permissions/' + permission_id,
						success: function(data) {
							Swal.fire({
								icon: 'success',
								title: 'Saved Successfully!',
							});
							table.draw();
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