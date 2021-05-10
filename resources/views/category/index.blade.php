@extends('layouts.layoutVerticalMenu')

@section('title','Category')

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
						<h2 class="content-header-title float-left mb-0">Category List
							<img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan kategori yang anda tersedia dan dapat digunakan untuk mengelompokkan topik" />
						</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
								</li>
								<li class="breadcrumb-item active">Category
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
					<a href="javascript:;" class="create-new btn btn-primary createNewCategory">Add New</a>
				</div>

			</div>
			<!-- Basic table -->
			<section id="basic-datatable">
				<div class="row">
					<div class="col-12">
						<div class="card style=" border-radius: 15px;>
							<table class="datatables-basic table yajra-datatable-category">
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
						<form class="add-new-record modal-content pt-0" id="CategoryForm" name="CategoryForm">

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
							<div class="modal-header mb-1" style="background-color: #CDC8FF;">
								<h5 class="modal-title" id="modalHeading"></h5>
							</div>
							<input type="hidden" name="category_id" id="category_id">
							<div class="modal-body flex-grow-1">
								<div class="form-group">
									<label class="form-label" for="basic-icon-default-fullname">Category Name</label>
									<input id="category" name="category" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Type here .." aria-label="John Doe" />
									<div id="category-error"></div>
								</div>
								<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="">Submit</button>
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
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<style>
	label.error.fail-alert {
		color: red;
	}
</style>
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

		var table = $('.yajra-datatable-category').DataTable({
			processing: true,
			serverSide: true,
			ajax: "",
			columns: [{
					data: 'DT_RowIndex',
					name: 'DT_RowIndex'
				},
				{
					data: 'category',
					name: 'category'
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
		$('body').on('click', '.createNewCategory', function() {
			$('#saveBtn').val("create-category");
			$('#permission_id').val('');
			$('#CategoryForm').trigger("reset");
			$('#modalHeading').html("Create New Category");
			$('#name-error').empty();
			$('#modals-slide-in').modal('show');
		});

		// edit
		$('body').on('click', '#editCategory', function() {
			console.log('tes');
			var category_id = $(this).data('id');
			$.get("" + '/category/' + category_id + '/edit', function(data) {
				$('#modalHeading').html("Edit Category");
				$('#saveBtn').val("edit-category");
				$('#category_id').val(data.id);
				$('#category').val(data.category);
				$('#category-error').empty();
				$('#modals-slide-in').modal('show');
			})
		});

		// save data
		$('#saveBtn').click(function() {
			$('#CategoryForm').validate({
				debug: false,
				errorClass: "error fail-alert",
				validClass: "valid success-alert",
				rules: {
					category: {
						required: true
					}
				},
				messages: {
					category: {
						required: "Category is required!"
					}
				},
				errorPlacement: function(error, element) {
					if (element.attr("category") == "category") {
						error.appendTo($("#category-error"));
					}
				},
				submitHandler: function(form) {
					$(this).html('Sending..');
					var data = $('#CategoryForm').serialize();
					console.log(data);

					$.ajax({
						data: data,
						url: "",
						type: "POST",
						dataType: 'json',
						success: function(data) {

							$('#CategoryForm').trigger("reset");
							$('#saveBtn').html('Submit');
							$('#modals-slide-in').modal('hide');
							if ($('#saveBtn').val() == 'create-category') {
								Swal.fire({
									icon: 'success',
									title: 'Category created successfully!',
								});
							} else if ($('#saveBtn').val() == 'edit-category') {
								Swal.fire({
									icon: 'success',
									title: 'Category updated successfully!',
								});
							}
							table.draw();

						},
						error: function(data) {
							console.log('Error:', data);
							$('#saveBtn').html('Submit');
						}
					});
					return false;
				}
			});
		});

		// delete
		$('body').on('click', '#deleteCategory', function(e) {

			var category_id = $(this).data("id");
			console.log(category_id);

			Swal.fire({
				title: "Are you sure?",
				text: "You'll delete this category",
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
						url: "" + '/category/' + category_id,
						success: function(data) {
							Swal.fire({
								icon: 'success',
								title: 'Deleted Successfully!',
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
