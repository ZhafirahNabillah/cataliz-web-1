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
						<h2 class="content-header-title float-left mb-0">Users List</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/">dashboard</a>
								</li>
								<li class="breadcrumb-item active">Users
								</li>

							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
				<div class="form-group breadcrumb-right">
					<div class="dropdown">
						<button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
						data-feather="grid"></i></button>
						<div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i
							class="mr-1" data-feather="check-square"></i><span
							class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i
								class="mr-1" data-feather="message-square"></i><span
								class="align-middle">Chat</span></a><a class="dropdown-item"
								href="app-email.html"><i class="mr-1" data-feather="mail"></i><span
								class="align-middle">Email</span></a><a class="dropdown-item"
								href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span
								class="align-middle">Calendar</span></a></div>
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

					<!-- <div class="col-12 mb-1">
						<a href="javascript:;" class="create-new btn btn-primary createNewRole">Add New</a>
					</div> -->

			</div>
			<!-- Basic table -->
			<section id="basic-datatable">
				<div class="row">
					<div class="col-12">
						<div class="card style="border-radius: 15px;>
							<table class="datatables-basic table yajra-datatable-role">
								<thead>
									<tr>
										<th>No</th>
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
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
						<form class="add-new-record modal-content pt-0" id="userForm" name="userForm">

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
							<div class="modal-header mb-1">
								<h5 class="modal-title" id="modalHeading"></h5>
							</div>
							<input type="hidden" name="user_id" id="user_id">
							<div class="modal-body flex-grow-1">
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-fullname">Full Name</label>
									<input id="name" name="name" type="text" class="form-control dt-full-name"
									id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
								</div>
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-email">Email</label>
									<input id="email" name="email" type="text" class="form-control dt-full-name"
									id="basic-icon-default-email" placeholder="John Doe" aria-label="John Doe" />
								</div>
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-phone">Phone</label>
									<input id="phone" name="phone" type="text" class="form-control dt-full-name"
									id="basic-icon-default-phone" placeholder="John Doe" aria-label="John Doe" />
								</div>
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-fullname">Role</label>
									<select class="form-control" id="role" name="role">
										<option value="admin">Admin</option>
										<option value="coach">Coach</option>
										<option value="coachee">Coachee</option>
									</select>
								</div>

								<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn"
								value="create">Submit</button>
								<button type="reset" class="btn btn-outline-secondary"
								data-dismiss="modal">Cancel</button>
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
	<script type="text/javascript">
	$(function () {

	$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
	});

	var table = $('.yajra-datatable-role').DataTable({
		processing: true,
		serverSide: true,
		ajax: "",
		columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'name', name: 'name'},
			{data: 'email', name: 'email'},
			{data: 'roles[0].name', name: 'roles.name'},
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

		// create
		$('body').on('click', '.createNewRole', function () {
			$('#saveBtn').val("create-Client");
			$('#user_id').val('');
			$('#userForm').trigger("reset");
			$('#modalHeading').html("Create New User");
			$('#modals-slide-in').modal('show');
		});

		// edit
		$('body').on('click', '#editUser', function () {
			console.log('tes');
			var user_id = $(this).data('id');
			$.get("" +'/users/' + user_id +'/edit', function (data) {
				$('#modalHeading').html("Edit User");
				$('#saveBtn').val("edit-user");
				$('#modals-slide-in').modal('show');
				$('#user_id').val(data.id);
				$('#name').val(data.name);
				$('#email').val(data.email);
				$('#phone').val(data.phone);
				$('#role option[value='+ data.roles[0].name +']').attr('selected','selected');
			})
		});

		// save data
		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Sending..');
			var data = $('#userForm').serialize();
			console.log(data);

			$.ajax({
				data: data,
				url: "{{ route('users.store') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {

					$('#userForm').trigger("reset");
					$('#saveBtn').html('Submit');
					$('#modals-slide-in').modal('hide');
					table.draw();

				},
				error: function (data) {
					console.log('Error:', data);
					$('#saveBtn').html('Submit');
				}
			});
		});

		// delete
		$('body').on('click', '#deleteUser', function (e) {

			var user_id = $(this).data("id");
			if(confirm("Are You sure want to delete !")){

				$.ajax({
					type: "DELETE",
					url: ""+'/users/'+user_id,
					success: function (data) {
						table.draw();
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
