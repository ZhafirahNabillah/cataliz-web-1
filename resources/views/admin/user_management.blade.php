@extends('layouts.layoutVerticalMenu')

@section('title','Agendas')

@push('styles')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

@include('panels.navbar')

@include('panels.sidemenu_admin')

<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">User Management</h2>
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
          <a href="{{ url('/agendas/create') }}" class="create-new btn btn-primary">Add New</a>
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
                    <th>Access</th>
                    <th>Admin</th>
                    <th>Coach</th>
                    <th>Coachee</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Access 1</td>
                    <td>
                      <div class="input-group mb-3">
                        <div class="input-group-text">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="input-group mb-3">
                        <div class="input-group-text">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="input-group mb-3">
                        <div class="input-group-text">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Access 2</td>
                    <td>
                      <div class="input-group mb-3">
                        <div class="input-group-text">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="input-group mb-3">
                        <div class="input-group-text">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="input-group mb-3">
                        <div class="input-group-text">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Access 3</td>
                    <td>
                      <div class="input-group mb-3">
                        <div class="input-group-text">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="input-group mb-3">
                        <div class="input-group-text">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="input-group mb-3">
                        <div class="input-group-text">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                      </div>
                    </td>
                  </tr>
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

{{-- @push('scripts')
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
@endpush --}}