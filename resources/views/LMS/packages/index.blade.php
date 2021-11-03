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
            <h2 class="content-header-title float-left mb-0">Packages
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}"
                alt="Card image cap" data-toggle="popover" data-placement="top"
                data-content="Halaman ini menampilkan daftar client yang terdaftar dalam website." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="/">Packages</a>
                </li>
                <li class="breadcrumb-item active">Add New Packages
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

      <img class="img-fluid" src=" {{asset('assets\images\icons\user\banner.png')}}" alt="Card image cap" />
      <div class="">
        <button style="margin-top: 10px;margin-bottom: 10px;" type="submit"
          class="btn btn-primary data-submit mr-1 createNewUser">Add New Packages</button>
      </div>
      <div class="card">
        <div class="card-body">
              <section id="basic-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card style=" border-radius: 15px;>
                      <table class="datatables-basic table-striped table yajra-datatable-package">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Packages Name</th>
                            <!-- <th>What's In It?</th> -->
                            <th>Actions</th>
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
      <!-- /panel  -->

      <!-- Modal Detail Trainer -->
      <div class="modal modal-slide-in fade" id="modal-trainer-detail" role="dialog" aria-hidden="true">
        <div class="modal-dialog sidebar-sm" role="document">
          <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header">
              <h5 class="modal-title" id="modalHeadingTrainer"></h5>
            </div>

            <div class="modal-body flex-grow-1">
              <div class="card-body">
                <dl class="row">
                  <dt class="col-sm-6">Full Name</dt>
                </dl>
                <dl class="row">
                  <small class="col-sm-12 name"></small>
                </dl>
                <dl class="row">
                  <dt class="col-sm-6">Program Name</dt>
                </dl>
              </div>
              <!-- </Card modal>-->
            </div>
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

		var table = $('.yajra-datatable-package').DataTable({
			processing: true,
			serverSide: true,
			ajax: "",
			columns: [{
					data: 'DT_RowIndex',
					name: 'DT_RowIndex'
				},
				{
					data: 'package_name',
					name: 'package_name'
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
		$('body').on('click', '.createNewProgram', function() {
			$('#saveProgramBtn').val("create-program");
			$('#program_id').val('');
			$('#ProgramForm').trigger("reset");
			$('#modalHeading').html("Create New Program");
			$('#program-error').empty();
			$('#add_modal_program').modal('show');
		});

		// edit
		$('body').on('click', '#editProgram', function() {
			var program_id = $(this).data('id');
			$.get("" + '/program/' + program_id + '/edit', function(data) {
				console.log(data);
				$('#modalHeading').html("Edit Program");
				$('#saveProgramBtn').val("edit-program");
				$('#program_id').val(data.id);
				$('#program').val(data.program_name);
				$('#program-error').empty();
				$('#add_modal_program').modal('show');
			})
		});

		// save data
		$('#saveProgramBtn').click(function() {
			$('#ProgramForm').validate({
				debug: false,
				errorClass: "error fail-alert",
				validClass: "valid success-alert",
				rules: {
					program: {
						required: true
					}
				},
				messages: {
					program: {
						required: "Program is required!"
					}
				},
				errorPlacement: function(error, element) {
					if (element.attr("program") == "program") {
						error.appendTo($("#program-error"));
					}
				},
				submitHandler: function(form) {
					$(this).html('Sending..');
					var data = $('#ProgramForm').serialize();
					console.log(data);

					$.ajax({
						data: data,
						url: "",
						type: "POST",
						dataType: 'json',
						success: function(data) {

							$('#ProgramForm').trigger("reset");
							$('#saveProgramBtn').html('Submit');
							$('#add_modal_program').modal('hide');
							if ($('#saveProgramBtn').val() == 'create-program') {
								Swal.fire({
									icon: 'success',
									title: 'Program created successfully!',
								});
							} else if ($('#saveProgramBtn').val() == 'edit-program') {
								Swal.fire({
									icon: 'success',
									title: 'Program updated successfully!',
								});
							}
							table.draw();

						},
						error: function(data) {
							console.log('Error:', data);
							$('#saveProgramBtn').html('Submit');
						}
					});
					return false;
				}
			});
		});

		// delete
		$('body').on('click', '#deleteProgram', function(e) {

			var program_id = $(this).data("id");
			console.log(program_id);

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
						url: "" + '/program/' + program_id,
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
      